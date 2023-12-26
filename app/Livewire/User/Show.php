<?php

namespace App\Livewire\User;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Layout('Layout.app')]
#[Title('Thêm sản phẩm')]
class Show extends Component
{
    public function render()
    {
        return view('livewire.user.show');
    }
}
