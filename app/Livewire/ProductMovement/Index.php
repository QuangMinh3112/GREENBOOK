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
    public function render()
    {
        return view('livewire.product-movement.index', [
            "product_movements" => ProductMovement::paginate($this->page)
        ]);
    }
}
