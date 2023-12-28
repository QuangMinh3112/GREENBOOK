<?php

namespace App\Livewire\Ship;

use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('Layout.app')]
#[Title('Thêm sản phẩm')]
class Index extends Component
{
    public function render()
    {
        return view('livewire.ship.index');
    }
}
