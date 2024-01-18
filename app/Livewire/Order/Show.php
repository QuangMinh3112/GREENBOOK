<?php

namespace App\Livewire\Order;

use App\Models\Order;
use App\Models\OrderDetail;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Illuminate\Support\Facades\Mail;
use App\Mail\ApproveOrder;
use App\Models\Coupon;
use App\Models\User;
use App\Models\UserCoupon;
use App\Models\Warehouse;
use Illuminate\Support\Facades\Auth;

#[Layout('Layout.app')]
#[Title('Danh sách đơn hàng')]
class Show extends Component
{
    public $order;
    public $orderDetail;
    public $quantity = [];
    public $usingCoupon;
    public $userCoupon;
    public $coupon_id;
    public $otherCouponId;

    public function mount($id)
    {
        $this->order = Order::find($id);
        $this->orderDetail = OrderDetail::where('order_id', $id)
            ->with(['book', 'warehouse'])
            ->get();
        foreach ($this->orderDetail as $detail) {
            $this->quantity[$detail->id] = $detail->quantity;
        }
        if ($this->order->user_id != null && $this->order->coupon) {
            $coupon = Coupon::where('code', $this->order->coupon)->first();
            $this->usingCoupon = UserCoupon::where('user_id', $this->order->user_id)->where('coupon_id', $coupon->id)->with('coupon')->first();
        }
    }
    public function render()
    {
        return view('livewire.order.show');
    }
    public function approve()
    {
        $i = 0;
        foreach ($this->orderDetail as $data) {
            if ($data->quantity > $data->warehouse->quantity) {
                $i++;
            }
        }
        if ($this->order->payment === 'Đang chờ thanh toán') {
            request()->session()->flash('fail', 'Đơn hàng chưa được thanh toán');
        } elseif ($this->order->total_product_amount < $this->usingCoupon->coupon->price_required) {
            request()->session()->flash('fail', 'Số tiền tối thiểu không đủ để sử dụng phiếu giảm giá');
        } else {
            if ($i == 0) {
                $trangThai = '';
                Mail::to($this->order->email)->send(new ApproveOrder($this->order, $this->orderDetail, $trangThai));
                $this->order->update([
                    "status" => "confirmed",
                ]);
                request()->session()->flash('success', 'Đã xác nhận đơn hàng');
            } else {
                request()->session()->flash('fail', 'Vui lòng kiểm tra lại số lượng sản phẩm');
            }
        }
    }
    public function update()
    {
        $total = 0;
        foreach ($this->orderDetail as $detail) {
            $detailId = $detail->id;
            $newQuantity = $this->quantity[$detailId] ?? $detail->quantity;
            $total += $newQuantity * $detail->book_price;
            OrderDetail::where('id', $detailId)->update(['quantity' => $newQuantity]);
        }
        if ($this->usingCoupon != null) {
            if ($this->usingCoupon->coupon->type === "number") {
                $total = $total - $this->usingCoupon->coupon->value;
            }
            if ($this->usingCoupon->coupon->type === "percent") {
                $total = $total - ($total * ($this->usingCoupon->coupon->value / 100));
            }
            $this->order->update([
                "total_product_amount" => $total,
                "total" => $total + $this->order->ship_fee,
            ]);
        } else {
            $this->order->update([
                "total_product_amount" => $total,
                "total" => $total + $this->order->ship_fee,
            ]);
        }

        request()->session()->flash('success', 'Cập nhật số lượng thành công!');
    }
    public function shipping()
    {
        foreach ($this->orderDetail as $detail) {
            $warehouse = Warehouse::where('book_id', $detail->book_id)->first();
            if ($warehouse) {
                $warehouse->quantity -= $detail->quantity;
                $warehouse->delivery_quantity += $detail->quantity;
                $warehouse->save();
            }
        }
        $this->order->update([
            'status' => 'shipping',
        ]);
        request()->session()->flash('success', 'Cập nhật trạng thái thành công!');
    }
    public function delete($id)
    {
        $orderDetailToDelete = OrderDetail::find($id);
        if ($orderDetailToDelete) {
            $oldTotalProductAmount = $this->order->total_product_amount;
            $total_product_amount = $oldTotalProductAmount - ($orderDetailToDelete->book_price * $orderDetailToDelete->quantity);
            $orderDetailToDelete->delete();
            $this->order->update([
                "total_product_amount" => $total_product_amount,
                "total" => $total_product_amount + $this->order->ship_fee,
            ]);
            request()->session()->flash('success', 'Xoá thành công sản phẩm');
        } else {
            request()->session()->flash('fail', 'Không tìm thấy chi tiết đơn hàng để xoá');
        }
    }
    public function completed()
    {
        $this->order->update([
            "status" => "completed",
        ]);
        $point = 5;
        $count = 0;
        foreach ($this->orderDetail as $data) {
            $count += $data->quantity;
        }
        $user = User::find($this->order->user_id);
        if ($user) {
            $newPoint = $user->point + ($point * $count);
            $user->point = $newPoint;
            $user->save();
            request()->session()->flash('success', 'Cập nhật thành công');
        } else {
            request()->session()->flash('success', 'Cập nhật thành công');
        }
    }
    public function noRecive()
    {
        $this->order->update([
            "status" => "failed",
        ]);
        $point = 10;
        $count = 0;
        foreach ($this->orderDetail as $data) {
            $count += $data->quantity;
        }
        $user = User::find($this->order->user_id);
        if ($user) {
            $newPoint = $user->point - ($point * $count);
            if ($user) {
                $user->point = $newPoint;
                $user->save();
            }
        }
        request()->session()->flash('success', 'Cập nhật thành công');
    }
    public function defective()
    {
        foreach ($this->orderDetail as $detail) {
            $warehouse = Warehouse::where('book_id', $detail->book_id)->first();
            $warehouse->update([
                "delivery_quantity" => $warehouse->defective_quantity - $detail->quantity,
                "defective_quantity" => $warehouse->defective_quantity + $detail->quantity,
            ]);
        }
        $this->order->update([
            "status" => "failed",
        ]);
    }
    public function returned()
    {
        foreach ($this->orderDetail as $detail) {
            $warehouse = Warehouse::where('book_id', $detail->book_id)->first();
            $warehouse->update([
                "delivery_quantity" => $warehouse->returned_quantity - $detail->quantity,
                "returned_quantity" => $warehouse->returned_quantity + $detail->quantity,
            ]);
        }
        $this->order->update([
            "status" => "refund",
        ]);
    }
    public function cancel()
    {
        if ($this->usingCoupon->is_used) {
            $this->usingCoupon->update([
                "is_used" => 0,
            ]);
        }
        $this->order->update([
            "status" => "cancel",
        ]);
        request()->session()->flash('success', 'Đã huỷ đơn hàng');
    }
}
