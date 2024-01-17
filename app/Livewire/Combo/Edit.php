<?php

namespace App\Livewire\Combo;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\WithPagination;

#[Layout('Layout.app')]
#[Title('Combo sản phẩm')]
class Edit extends Component
{
    public function render()
    {
        return view('livewire.combo.edit');
    }
}
