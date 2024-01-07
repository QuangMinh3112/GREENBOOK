<?php

namespace App\Livewire\Coupon;

use App\Models\Coupon;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;



#[Layout('Layout.app')]
#[Title('Danh sách mã giảm giá')]
class Index extends Component
{
    use WithPagination;
    public $page = 5;
    public $status = "public";
    public $type;
    public $is_activate = 1;
    public function render()
    {
        return view('livewire.coupon.index', [
            "coupons" => Coupon::where('status', 'like', '%' . $this->status . '%')
                ->where('type', 'like', '%' . $this->type . '%')
                ->where('is_activate', $this->is_activate)
                ->paginate($this->page)
        ]);
    }
    public function public($id)
    {
        $coupon = Coupon::find($id);
        if ($coupon) {
            $coupon->update([
                "status" => "public"
            ]);
        }
    }
    public function private($id)
    {
        $coupon = Coupon::find($id);
        if ($coupon) {
            $coupon->update([
                "status" => "private"
            ]);
        }
    }
    public function activate($id)
    {
        $coupon = Coupon::find($id);
        if ($coupon) {
            $coupon->update([
                "is_activate" => 1
            ]);
        }
    }
    public function deActivate($id)
    {
        $coupon = Coupon::find($id);
        if ($coupon) {
            $coupon->update([
                "is_activate" => 0
            ]);
        }
    }
}
