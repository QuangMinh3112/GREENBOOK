<?php

namespace App\Livewire\ProductMovement;

use App\Models\ProductMovement;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\WithPagination;

#[Layout('Layout.app')]
#[Title('Dữ liệu nhập')]
class Index extends Component
{
    use WithPagination;
    public $page = 5;
    public $code;
    public $date;
    public $creator;
    public function render()
    {

        return view('livewire.product-movement.index', [
            "product_movements" => ProductMovement::when($this->code != "", function ($query) {
                $query->where('code', 'like', '%' . $this->code . '%');
            })->when($this->date != "", function ($query) {
                $query->whereDate('updated_at', $this->date);
            })->when($this->creator != "", function ($query) {
                $query->where('creator', 'like', '%' . $this->creator . '%');
            })->paginate($this->page),
        ]);
    }
}
