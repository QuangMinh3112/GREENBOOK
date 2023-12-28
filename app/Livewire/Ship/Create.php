<?php

namespace App\Livewire\Ship;

use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('Layout.app')]
#[Title('Thêm phí ship')]
class Create extends Component
{
    public function render()
    {
        return view('livewire.ship.create');
    }
}
