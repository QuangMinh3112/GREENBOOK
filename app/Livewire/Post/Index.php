<?php

namespace App\Livewire\Post;

use App\Models\CategoryPost;
use App\Models\Post;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\WithPagination;

#[Layout('Layout.app')]
#[Title('Danh sách bài đăng ')]
class Index extends Component
{
    use WithPagination;
    public $page = 5;
    public $title;
    public $status = "Công bố";
    public $category_id;
    public function render()
    {
        return view('livewire.post.index', [
            'posts' => Post::titleSearch($this->title)
                ->statusSearch($this->status)
                ->when($this->category_id != "", function ($query) {
                    $query->where('category_id', $this->category_id);
                })
                ->paginate($this->page),
            'categories' => CategoryPost::tree(),
        ]);
    }
    public function draft($id)
    {
        $post = Post::find($id);
        $post->update([
            "status" => "Bản nháp"
        ]);
        request()->session()->flash('success', 'Cập nhật thành công');
    }
    public function published($id)
    {
        $post = Post::find($id);
        $post->update([
            "status" => "Công bố"
        ]);
        request()->session()->flash('success', 'Cập nhật thành công');
    }
}
