<?php

namespace App\Livewire\CategoryPost;

use App\Models\CategoryPost;
use App\Models\Post;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('Layout.app')]
#[Title('Danh mục bài đăng')]
class Index extends Component
{
    use WithPagination;
    public $page = 5;
    public function render()
    {
        return view('livewire.category-post.index', [
            'categories' => CategoryPost::where('parent_id', null)->with('children')->paginate($this->page)

        ]);
    }
    public function delete($id)
    {
        $category = CategoryPost::find($id);
        if ($category) {
            $child = $category->children()->count();
            $product = Post::where('category_id', $id)->where('status', 'like', 'Công bố')->count();
        }
        if ($child > 0 || $product > 0) {
            session()->flash('warn', 'Vui lòng xoá danh mục con và chuyển trạng thái bài đăng thành bản nháp');
        } else {
            $category->delete();
            session()->flash('success', 'Xoá danh mục thành công');
        }
    }
}
