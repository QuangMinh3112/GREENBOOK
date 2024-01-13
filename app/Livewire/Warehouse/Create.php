<?php

namespace App\Livewire\Warehouse;

use App\Models\Book;
use App\Models\Category;
use App\Models\Warehouse;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\WithPagination;
use Livewire\Attributes\Validate;


#[Layout('Layout.app')]
#[Title('Thêm mới sản phẩm kho')]
class Create extends Component
{
    use WithPagination;
    // BOOK
    public $page = 5;
    public $name;
    public $author;
    public $category_id;
    public $sortOrder = "";
    public $isActivate = 1;
    public $isOpen = 0;
    // WAREHOUSE
    #[Validate()]
    public $product_id;
    public $import_price;
    public $retail_price;
    public $wholesale_price;
    public function render()
    {
        return view('livewire.warehouse.create', [
            'products' => Book::nameSearch($this->name)
                ->authorSearch($this->author)
                ->where('status', $this->isActivate)
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
    public function addNew()
    {
        $validated = $this->validate();
        Warehouse::create([
            "book_id" => $validated["product_id"],
            "import_price" => $validated["import_price"],
            "retail_price" => $validated["retail_price"],
            "wholesale_price" => $validated["wholesale_price"],
        ]);
        request()->session()->flash('success', 'Thêm mới thành công');
        $this->reset();
    }
    public function rules()
    {
        return [
            'product_id' => 'required',
            'import_price' => 'required|numeric|min:0',
            'wholesale_price' => 'required|numeric|min:' . ($this->import_price ?? 0),
            'retail_price' => 'required|numeric|min:' . ($this->wholesale_price ?? 0),
        ];
    }

    public function messages()
    {
        return [
            'product_id.required' => 'Vui lòng chọn sản phẩm.',
            'import_price.required' => 'Vui lòng nhập giá nhập.',
            'import_price.numeric' => 'Giá nhập phải là một số.',
            'import_price.min' => 'Giá nhập phải lớn hơn hoặc bằng 0.',
            'wholesale_price.required' => 'Vui lòng nhập giá sỉ.',
            'wholesale_price.numeric' => 'Giá sỉ phải là một số.',
            'wholesale_price.min' => 'Giá sỉ phải lớn hơn hoặc bằng giá nhập.',
            'retail_price.required' => 'Vui lòng nhập giá bán lẻ.',
            'retail_price.numeric' => 'Giá bán lẻ phải là một số.',
            'retail_price.min' => 'Giá bán lẻ phải lớn hơn hoặc bằng giá sỉ.',
        ];
    }
}
