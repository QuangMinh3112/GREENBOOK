<?php

namespace App\Livewire\Product;

use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Category;
use App\Models\Book;

#[Layout('Layout.app')]
#[Title('Sản phẩm')]
class Index extends Component
{
    use WithPagination;
    public $page = 5;
    public $name;
    public $author;
    public $category_id;
    public $sortOrder = "";
    public $isActivate = 1;
    public $isOpen = 0;
    public function render()
    {
        return view('livewire.product.index', [
            'products' => Book::nameSearch($this->name)
                ->authorSearch($this->author)
                ->where('status', $this->isActivate)
                ->when($this->category_id != "", function ($query) {
                    $query->where('category_id', $this->category_id);
                })
                ->paginate($this->page),
            'categories' => Category::tree(),
        ]);
    }
    public function deActivate($id)
    {
        Book::find($id)->update([
            'status' => 0,
        ]);
        request()->session()->flash('success', 'Cập nhật thành công');
    }
    public function activate($id)
    {
        Book::find($id)->update([
            'status' => 1,
        ]);
        request()->session()->flash('success', 'Cập nhật thành công');
    }
}
