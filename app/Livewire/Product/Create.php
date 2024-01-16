<?php

namespace App\Livewire\Product;

use App\Models\Book;
use App\Models\Category;
use App\Models\Supplier;
use App\Models\Warehouse;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;

#[Layout('Layout.app')]
#[Title('Thêm sản phẩm')]
class Create extends Component
{
    use WithFileUploads;

    #[Validate()]
    public $name;
    public $category_id;
    public $status;
    public $author;
    public $published_year;
    public $width;
    public $length;
    public $number_of_pages;
    public $short_description;
    public $description;
    public $image;
    public $supplier_id;
    public $import_price;
    public $retail_price;
    public $wholesale_price;

    public function render()
    {
        return view('livewire.product.create', [
            'categories' => Category::tree(),
            'suppliers' => Supplier::all(),
        ]);
    }
    public function addNew()
    {
        $validated = $this->validate();
        if ($this->image) {
            $image =  $this->image->store('books', 'public');
        }
        $book = Book::create([
            "name" => $validated['name'],
            "slug" => Str::slug($validated['name']),
            "category_id" => $validated["category_id"],
            "status" => $this->status,
            "author" => $validated["author"],
            "width" => $validated["width"],
            "length" => $validated["length"],
            "published_year" => $validated["published_year"],
            "short_description" => $validated["short_description"],
            "description" => $validated["description"],
            "number_of_pages" => $validated["number_of_pages"],
            "image" => $image,
        ]);
        if ($book) {
            Warehouse::create([
                "supplier_id" => $validated["supplier_id"],
                "book_id" => $book->id,
                "import_price" => $validated["import_price"],
                "retail_price" => $validated["retail_price"],
                "wholesale_price" => $validated["wholesale_price"],
            ]);
        }
        $this->reset();
        request()->session()->flash('success', 'Thêm mới thành công');
    }
    public function rules()
    {
        return [
            'name' => 'required|min:5|max:255',
            'category_id' => 'required',
            'author' => 'required|min:5|max:255',
            'published_year' => 'required|date_format:Y',
            'width' => 'required|numeric|min:0',
            'length' => 'required|numeric|min:' . ($this->width ?? 0),
            'number_of_pages' => 'required|numeric|min:1',
            'short_description' => 'required|min:5|max:255',
            'description' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'import_price' => 'required|numeric|min:0',
            'wholesale_price' => 'required|numeric|min:' . ($this->import_price ?? 0),
            'retail_price' => 'required|numeric|min:' . ($this->wholesale_price ?? 0),
            'supplier_id' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Vui lòng nhập tên sách',
            'name.min' => 'Tên bắt buộc lớn hơn 5 kí tự',
            'name.max' => 'Tên bắt buộc nhỏ hơn 255 kí tự',
            'category_id.required' => 'Vui lòng chọn danh mục',
            'author.required' => 'Vui lòng nhập tên tác giả',
            'author.min' => 'Tên tác giả bắt buộc lớn hơn 5 kí tự',
            'author.max' => 'Tên tác giả bắt buộc nhỏ hơn 255 kí tự',
            'published_year.required' => 'Vui lòng nhập năm xuất bản',
            'published_year.date_format' => 'Năm xuất bản không hợp lệ',
            'width.required' => 'Vui lòng nhập chiều rộng sách',
            'width.numeric' => 'Chiều rộng phải là số',
            'width.min' => 'Chiều rộng tối thiểu là 10cm',
            'length.required' => 'Vui lòng nhập chiều cao sách',
            'length.numeric' => 'Chiều dài phải là số',
            'length.min' => 'Chiều dài tối thiểu là 10cm và phải lớn hơn chiều rộng',
            'number_of_pages.required' => 'Vui lòng nhập số trang sách',
            'number_of_pages.numeric' => 'Số trang phải là số',
            'number_of_pages.min' => 'Số trang sách phải lớn hơn 50',
            'short_description.required' => 'Vui lòng nhập mô tả ngắn',
            'short_description.min' => 'Mô tả ngắn bắt buộc lớn hơn 5 kí tự',
            'short_description.max' => 'Mô tả ngắn bắt buộc nhỏ hơn 1500 kí tự',
            'description.required' => 'Vui lòng nhập mô tả',
            'description.min' => 'Mô tả bắt buộc lớn hơn 5 kí tự',
            'description.max' => 'Mô tả bắt buộc nhỏ hơn 6000 kí tự',
            'image.required' => 'Vui lòng tải lên ảnh sản phẩm',
            'image.image' => 'Tập tin tải lên phải là hình ảnh.',
            'image.mimes' => 'Tập tin ảnh phải có định dạng: jpeg, png, jpg, gif.',
            'image.max' => 'Kích thước hình ảnh không được vượt quá 2MB.',
            'import_price.required' => 'Vui lòng nhập giá nhập.',
            'import_price.numeric' => 'Giá nhập phải là một số.',
            'import_price.min' => 'Giá nhập phải lớn hơn hoặc bằng 0.',
            'wholesale_price.required' => 'Vui lòng nhập giá sỉ.',
            'wholesale_price.numeric' => 'Giá sỉ phải là một số.',
            'wholesale_price.min' => 'Giá sỉ phải lớn hơn hoặc bằng giá nhập.',
            'retail_price.required' => 'Vui lòng nhập giá bán lẻ.',
            'retail_price.numeric' => 'Giá bán lẻ phải là một số.',
            'retail_price.min' => 'Giá bán lẻ phải lớn hơn hoặc bằng giá sỉ.',
            'supplier_id' => 'Không bỏ trống nhà cung cấp'
        ];
    }
}
