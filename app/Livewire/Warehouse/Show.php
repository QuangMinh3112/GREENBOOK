<?php

namespace App\Livewire\Warehouse;

use App\Models\Warehouse;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

class Show extends Component
{
    public $warehouse;
    public function mount($id)
    {
        $this->warehouse = Warehouse::find($id);
    }
    public function render()
    {
        return view('livewire.warehouse.show');
    }
}
