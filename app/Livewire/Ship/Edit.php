<?php

namespace App\Livewire\Ship;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('Layout.app')]
#[Title('Chỉnh sửa phí ship')]
class Edit extends Component
{
    public function render()
    {
        return view('livewire.ship.edit');
    }
}
