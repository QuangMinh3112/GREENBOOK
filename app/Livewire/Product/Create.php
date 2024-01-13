<?php

namespace App\Livewire\Product;

use App\Models\Book;
use App\Models\Category;
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

    public function render()
    {
        return view('livewire.product.create', [
            'categories' => Category::tree()
        ]);
    }
    public function addNew()
    {
        $validated = $this->validate();
        if ($this->image) {
            $image =  $this->image->store('books', 'public');
        }
        Book::create([
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
            'width' => 'required|numeric|min:10',
            'length' => 'required|numeric|min:10',
            'number_of_pages' => 'required|numeric|min:1',
            'short_description' => 'required|min:5|max:255',
            'description' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
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
            'published_year.date_format:Y' => 'Vui lòng nhập năm',
            'width.required' => 'Vui lòng nhập chiều rộng sách',
            'width.numeric' => 'Chiều rộng phải là số',
            'width.min' => 'Chiều rộng tối thiểu là 10 cm',
            'length.required' => 'Vui lòng nhập chiều cao sách',
            'length.numeric' => 'Chiều cao phải là số',
            'length.min' => 'Chiều cao tối thiểu là 10 cm',
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
            'image.max' => 'Kích thước hình ảnh không được vượt quá 2048KB.',
        ];
    }
}
