<?php

namespace App\Livewire\Order;

use App\Models\Order;
use App\Models\OrderDetail;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Illuminate\Support\Facades\Mail;
use App\Mail\ApproveOrder;
use App\Models\User;

#[Layout('Layout.app')]
#[Title('Danh sách đơn hàng')]
class Show extends Component
{
    public $order;
    public $orderDetail;
    public $quantity = [];

    public function mount($id)
    {
        $this->order = Order::find($id);
        $this->orderDetail = OrderDetail::where('order_id', $id)->with('book')->get();
        foreach ($this->orderDetail as $detail) {
            $this->quantity[$detail->id] = $detail->quantity;
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
            if ($data->quantity > $data->book->quantity) {
                $i++;
            }
        }
        if ($i == 0) {
            $trangThai = '';
            $user = User::find($this->order->user_id);
            Mail::to($user->email)->send(new ApproveOrder($this->order, $this->orderDetail, $trangThai));
            $this->order->update([
                "status" => "shipping",
            ]);
            request()->session()->flash('success', 'Đã xác nhận đơn hàng');
        } else {
            request()->session()->flash('fail', 'Vui lòng kiểm tra lại số lượng sản phẩm');
        }
    }
    public function update()
    {
        foreach ($this->orderDetail as $detail) {
            $detailId = $detail->id;
            $newQuantity = $this->quantity[$detailId] ?? $detail->quantity;
            $total = 0;
            $total = $newQuantity * $detail->book_price;
            OrderDetail::where('id', $detailId)->update(['quantity' => $newQuantity]);
        }
        $this->order->update([
            "total_product_amount" => $total,
            "total" => $total + $this->order->ship_fee,
        ]);
        request()->session()->flash('success', 'Cập nhật số lượng thành công!');
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
        $point = 10;
        $count = 0;
        foreach ($this->orderDetail as $data) {
            $count += $data->quantity;
        }
        $user = User::find($this->order->user_id);
        $newPoint = $user->point + ($point * $count);
        if ($user) {
            $user->point = $newPoint;
            $user->save();
        }
        request()->session()->flash('success', 'Cập nhật thành công');
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
        $newPoint = $user->point - ($point * $count);
        if ($user) {
            $user->point = $newPoint;
            $user->save();
        }
        request()->session()->flash('success', 'Cập nhật thành công');
    }
}
