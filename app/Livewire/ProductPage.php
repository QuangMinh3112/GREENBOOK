<?php

namespace App\Livewire;

use App\Models\Book;
use App\Models\Category;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;


#[Layout('Layout.app')]
#[Title('Sản phẩm')]
class ProductPage extends Component
{
    use WithPagination;
    public $page = 5;
    public $name;
    public $author;
    public $category_id;
    public $sortOrder = "";
    public $is_activate = 1;

    public function render()
    {
        sleep(1);
        return view('livewire.product-page', [
            'products' => Book::nameSearch($this->name)
                ->authorSearch($this->author)
                ->where('status', $this->is_activate)
                ->when($this->sortOrder !== "", function ($query) {
                    $query->orderBy('price', $this->sortOrder);
                })
                ->when($this->category_id != "", function ($query) {
                    $query->where('category_id', $this->category_id);
                })
                ->paginate($this->page),
            'categories' => Category::tree(),
        ]);
    }
}
