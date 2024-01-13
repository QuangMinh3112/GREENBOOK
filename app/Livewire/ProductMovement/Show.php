<?php

namespace App\Livewire\ProductMovement;

use App\Models\ProductMovement;
use App\Models\ProductTransition;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\WithPagination;


#[Layout('Layout.app')]
#[Title('Xem chi tiết nhập')]
class Show extends Component
{
    use WithPagination;
    public function mount($id)
    {
        $product_movement = ProductMovement::find($id);
        $product_transition = ProductTransition::where('movement_id', $id)->get();
    }
    public function render()
    {
        return view('livewire.product-movement.show');
    }
}
