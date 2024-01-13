<?php

namespace App\Livewire\Product;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use App\Models\Book;
use Livewire\WithFileUploads;
use App\Models\Category;
use Livewire\Attributes\Validate;
use Illuminate\Support\Str;

#[Layout('Layout.app')]
#[Title('Sửa sản phẩm')]
class Edit extends Component
{
    use WithFileUploads;

    #[Validate()]
    public $product;
    public $name;
    public $category_id;
    public $status;
    public $price;
    public $quantity;
    public $author;
    public $published_company;
    public $published_year;
    public $width;
    public $length;
    public $number_of_pages;
    public $short_description;
    public $description;
    public $image;

    public function mount($id)
    {
        $this->product = Book::find($id);
        if ($this->product) {
            $this->name = $this->product->name;
            $this->category_id = $this->product->category_id;
            $this->status = $this->product->status;
            $this->price = $this->product->price;
            $this->quantity = $this->product->quantity;
            $this->author = $this->product->author;
            $this->published_company = $this->product->published_company;
            $this->published_year = $this->product->published_year;
            $this->width = $this->product->width;
            $this->length = $this->product->length;
            $this->number_of_pages = $this->product->number_of_pages;
            $this->short_description = $this->product->short_description;
            $this->description = $this->product->description;
        }
    }

    public function render()
    {
        return view('livewire.product.edit', [
            'categories' => Category::tree(),
            'product' => $this->product,
            'oldImage' =>  $this->product->image
        ]);
    }
    public function update()
    {
        $validated = $this->validate();
        if ($this->image != null) {
            $image =  $this->image->store('books', 'public');
            $this->product->update([
                "name" => $validated['name'],
                "slug" => Str::slug($validated['name']),
                "category_id" => $validated["category_id"],
                "price" => $validated["price"],
                "status" => $this->status,
                "quantity" => $validated["quantity"],
                "author" => $validated["author"],
                "width" => $validated["width"],
                "number_of_pages" => $validated["number_of_pages"],
                "length" => $validated["length"],
                "published_company" => $validated["published_company"],
                "published_year" => $validated["published_year"],
                "short_description" => $validated["short_description"],
                "description" => $validated["description"],
                "image" => $image,
            ]);
        } else {
            $this->product->update([
                "name" => $validated['name'],
                "slug" => Str::slug($validated['name']),
                "category_id" => $validated["category_id"],
                "price" => $validated["price"],
                "status" => $this->status,
                "quantity" => $validated["quantity"],
                "author" => $validated["author"],
                "width" => $validated["width"],
                "number_of_pages" => $validated["number_of_pages"],
                "length" => $validated["length"],
                "published_company" => $validated["published_company"],
                "published_year" => $validated["published_year"],
                "short_description" => $validated["short_description"],
                "description" => $validated["description"],
            ]);
        }

        $this->reset('image');
        request()->session()->flash('success', 'Cập nhật thành công');
    }
    public function rules()
    {
        return [
            'name' => 'required|min:5|max:255',
            'category_id' => 'required',
            'price' => 'required|numeric|min:1',
            'quantity' => 'required|numeric|min:1',
            'author' => 'required|min:5|max:255',
            'published_company' => 'required|min:5|max:255',
            'published_year' => 'required|date_format:Y',
            'width' => 'required|numeric|min:10',
            'length' => 'required|numeric|min:10',
            'number_of_pages' => 'required|numeric|min:1',
            'short_description' => 'required|min:5|max:255',
            'description' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Vui lòng nhập tên sách',
            'name.min' => 'Tên bắt buộc lớn hơn 5 kí tự',
            'name.max' => 'Tên bắt buộc nhỏ hơn 255 kí tự',
            'category_id.required' => 'Vui lòng chọn danh mục',
            'price.required' => 'Vui lòng nhập giá sách',
            'price.numeric' => 'Giá tiền phải là số',
            'price.min' => 'Giá tiền phải lớn hơn 0',
            'quantity.required' => 'Vui lòng nhập số lượng',
            'quantity.numeric' => 'Số lượng phải là số',
            'quantity.min' => 'Số lượng phải lớn hơn 0',
            'author.required' => 'Vui lòng nhập tên tác giả',
            'author.min' => 'Tên tác giả bắt buộc lớn hơn 5 kí tự',
            'author.max' => 'Tên tác giả bắt buộc nhỏ hơn 255 kí tự',
            'published_company.required' => 'Vui lòng nhập tên nhà xuất bản',
            'published_company.min' => 'Tên nhà xuất bản bắt buộc lớn hơn 5 kí tự',
            'published_company.max' => 'Tên nhà xuất bản bắt buộc nhỏ hơn 255 kí tự',
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
            'image.mimes' => 'Tập tin ảnh phải có định dạng: jpeg, png, jpg, gif.',
            'image.max' => 'Kích thước hình ảnh không được vượt quá 2048KB.',
        ];
    }
}
