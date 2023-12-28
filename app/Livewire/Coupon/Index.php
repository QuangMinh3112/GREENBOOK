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
    public function render()
    {
        return view('livewire.coupon.index', [
            "coupons" => Coupon::where('status', 'like', '%' . $this->status . '%')
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
}
