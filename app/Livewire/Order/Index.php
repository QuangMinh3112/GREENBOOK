<?php

namespace App\Livewire\Order;

use App\Models\Order;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\WithPagination;


#[Layout('Layout.app')]
#[Title('Danh sách đơn hàng')]
class Index extends Component
{
    use WithPagination;
    public $page = 5;
    public $status = '';
    public $payment = '';
    public $sortDate = '';
    public $order_code = '';
    public function render()
    {
        return view('livewire.order.index', [
            "orders" => Order::when($this->status != '', function ($query) {
                $query->where('status', $this->status);
            })
                ->when($this->payment != '', function ($query) {
                    $query->where('payment', $this->payment);
                })
                ->when($this->sortDate != '', function ($query) {
                    $query->orderBy('created_at', $this->sortDate);
                })
                ->when($this->order_code != '', function ($query) {
                    $query->where('order_code', 'like', '%' . $this->order_code . '%');
                })
                ->paginate($this->page),
        ]);
    }
}
