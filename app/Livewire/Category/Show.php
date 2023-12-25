<?php

namespace App\Livewire\Category;

use App\Models\Category;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Layout('Layout.app')]
#[Title('Chi tiết danh mục')]
class Show extends Component
{
    public $category;

    public function mount($id)
    {
        $this->category = Category::find($id);
    }
    public function render()
    {
        return view('livewire.category.show');
    }
}
