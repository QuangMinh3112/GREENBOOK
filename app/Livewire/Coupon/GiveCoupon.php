<?php

namespace App\Livewire\Coupon;

use App\Models\Coupon;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Illuminate\Support\Str;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\CouponEmail;
use App\Models\UserCoupon;
use Livewire\WithPagination;

#[Layout('Layout.app')]
#[Title('Tặng mã giảm giá')]
class GiveCoupon extends Component
{
    use WithPagination;
    public $userList = [];
    public $page = 5;
    public $name = "";
    public $email = "";
    public $status = 1;
    public $coupon_id;
    public function render()
    {
        return view('livewire.coupon.give-coupon', [
            "coupon_privates" => Coupon::where('status', 'private')->where('is_activate', 1)->where('quantity', '>', 0)->get(),
            'users' => User::nameSearch($this->name)
                ->emailSearch($this->email)
                ->where('role', 0)
                ->where('status', $this->status)
                ->paginate($this->page),
        ]);
    }
    public function giveAway()
    {
        $coupon = Coupon::find($this->coupon_id);
        if (!$coupon) {
            request()->session()->flash('fail', 'Vui lòng chọn mã giảm giá');
        } else {
            $quantity = $coupon->quantity;
            $selectedUser = User::whereIn('id', $this->userList)->get();
            if ($quantity != count($selectedUser)) {
                request()->session()->flash('fail', 'Số lượng người tặng không đủ');
            } else {
                foreach ($selectedUser as $user) {
                    Mail::to($user->email)->send(new CouponEmail($coupon));
                    UserCoupon::create([
                        "user_id" => $user->id,
                        "coupon_id" => $coupon->id,
                        "is_used" => 0
                    ]);
                }
                $coupon->update([
                    "quantity" => 0,
                ]);
                request()->session()->flash('success', 'Đã gửi mã giảm giá');
                $this->reset();
            }
        }
    }
}
