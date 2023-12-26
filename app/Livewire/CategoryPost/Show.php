<?php

namespace App\Livewire\CategoryPost;

use App\Models\CategoryPost;
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
        $this->category = CategoryPost::find($id);
    }
    public function render()
    {
        return view('livewire.category-post.show');
    }
}
