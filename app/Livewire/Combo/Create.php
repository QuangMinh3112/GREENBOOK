<?php

namespace App\Livewire\Combo;

use App\Models\Book;
use App\Models\Category;
use App\Models\Combo;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Livewire\Attributes\Validate;

#[Layout('Layout.app')]
#[Title('Combo sản phẩm')]
class Create extends Component
{
    use WithPagination;
    use WithFileUploads;
    public $searchName = "";
    public $author = "";
    public $category_id;
    public $firstPage = 5;
    public $secondPage = 5;
    public $selectedBook = [];
    public $book_id = [];
    public $selectedBookIds;
    public $total = 0;


    #[Validate()]
    public $name;
    public $total_price;
    public $description;
    public $image;
    public function render()
    {
        $booksQuery = Book::nameSearch($this->searchName)
            ->authorSearch($this->author)
            ->where('status', 1)
            ->when($this->category_id != "", function ($query) {
                $query->where('category_id', $this->category_id);
            });
        if (!empty($this->selectedBookIds)) {
            $booksQuery->whereNotIn('id', $this->selectedBookIds);
        }
        $books = $booksQuery->with('warehouse')->paginate($this->firstPage);
        return view('livewire.combo.create', [
            'books' => $books,
            'categories' => Category::tree(),
            'total' => $this->total,
        ]);
    }
    public function addToCombo()
    {
        if (empty($this->book_id)) {
            request()->session()->flash('fail', 'Vui lòng chọn ít nhất một sản phẩm.');
        } else {
            foreach ($this->book_id as $bookId) {
                $book = Book::where('id', $bookId)->with('warehouse')->first();
                $this->selectedBook[] = [
                    'id' => $book->id,
                    'name' => $book->name,
                    'image' => $book->image,
                    'price' => $book->warehouse->retail_price,
                ];
                $this->selectedBookIds[] = $book->id;
                $this->total += $book->warehouse->retail_price;
            }
            $this->reset('book_id');
        }
    }
    public function delete($id)
    {
        $index = array_search($id, $this->selectedBookIds);
        if ($index !== false) {
            $deletedBook = $this->selectedBook[$index];
            unset($this->selectedBookIds[$index]);
            unset($this->selectedBook[$index]);
            $this->total -= $deletedBook['price'];
        }
    }
    public function addNew()
    {
        $validated = $this->validate();
        if ($this->total < $this->total_price) {
            request()->session()->flash('fail', 'Giá tiền combo nhỏ hơn tổng tiền các sản phẩm');
        } else if ($this->selectedBook = null) {
            request()->session()->flash('fail', 'Chưa có sản phẩm trong combo');
        } else {
            $newCombo = Combo::create([
                'name' => $validated["name"],
                'price' => $validated["total_price"],
            ]);
        }
    }
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'required|string',
            'total_price' => 'required|integer',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Tên combo là trường bắt buộc.',
            'name.max' => 'Tên combo không được vượt quá :max ký tự.',
            'image.required' => 'Hình ảnh combo là trường bắt buộc.',
            'image.image' => 'Hình ảnh phải là định dạng hình ảnh.',
            'image.mimes' => 'Hình ảnh phải có định dạng jpeg, png, jpg, gif.',
            'image.max' => 'Kích thước hình ảnh không được vượt quá :max KB.',
            'description.required' => 'Mô tả combo là trường bắt buộc.',
            'total_price.required' => 'Tổng giá tiền là trường bắt buộc.',
            'total_price.integer' => 'Tổng giá tiền phải là một số nguyên.',
        ];
    }
}
