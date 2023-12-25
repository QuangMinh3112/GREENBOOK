<?php

namespace App\Livewire\Category;

use Livewire\Component;
use App\Models\Category;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\WithPagination;
use App\Models\Book;

#[Layout('Layout.app')]
#[Title('Danh mục sản phẩm')]
class Index extends Component
{
    use WithPagination;
    public $page = 5;
    public function render()
    {
        return view('livewire.category.index', [
            'categories' => Category::where('parent_id', null)->with('children')->paginate($this->page)
        ]);
    }
    public function delete($id)
    {
        $category = Category::find($id);
        if ($category) {
            $child = $category->children()->count();
            $product = Book::where('category_id', $id)->where('status', 1)->count();
        }
        if ($child > 0 || $product > 0) {
            session()->flash('warn', 'Vui lòng xoá danh mục con và ngừng hoạt động sản phẩm để xoá');
        } else {
            $category->delete();
            session()->flash('success', 'Xoá danh mục thành công');
        }
    }
}
