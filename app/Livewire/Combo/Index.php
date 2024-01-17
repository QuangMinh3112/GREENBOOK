<?php

namespace App\Livewire\Combo;

use App\Models\Combo;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\WithPagination;

#[Layout('Layout.app')]
#[Title('Combo sản phẩm')]
class Index extends Component
{
    use WithPagination;
    public $page = 5;
    public $combos;
    public function mount()
    {
        $combos = Combo::paginate($this->page);
    }
    public function render()
    {
        return view('livewire.combo.index');
    }
}
