<?php

namespace App\Livewire\ProductMovement;

use App\Models\ProductMovement;
use App\Models\ProductTransition;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Str;

#[Layout('Layout.app')]
#[Title('Xem chi tiết nhập')]
class Show extends Component
{
    public $product_movement;
    public $product_transition;
    public function mount($id)
    {
        $this->product_movement = ProductMovement::find($id);
        $this->product_transition = ProductTransition::where('movement_id', $id)->with('book')->get();
    }
    public function render()
    {
        return view('livewire.product-movement.show');
    }
    public function convertArrayToUTF8($array)
    {
        array_walk_recursive($array, function (&$value) {
            if (is_string($value)) {
                $value = Str::encoding($value, 'UTF-8');
            }
        });
        return $array;
    }
}
