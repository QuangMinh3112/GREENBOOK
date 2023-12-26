<?php

namespace App\Livewire\Post;

use App\Models\Post;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;


#[Layout('Layout.app')]
#[Title('Chi tiết bài đăng ')]
class Show extends Component
{
    public $post;
    public function mount($id)
    {
        $this->post = Post::find($id);
    }

    public function render()
    {
        return view('livewire.post.show');
    }
}
