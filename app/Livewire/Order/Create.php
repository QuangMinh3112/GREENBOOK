<?php

namespace App\Livewire\Order;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use App\Models\Book;
use App\Models\Category;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Warehouse;
use Livewire\Attributes\Validate;


#[Layout('Layout.app')]
#[Title('Tạo đơn hàng')]
class Create extends Component
{
    use WithPagination;
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
    public $email;
    public $phone_number;
    public $payment;
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
        return view('livewire.order.create', [
            'books' => $books,
            'categories' => Category::tree(),
            'total' => $this->total,
        ]);
    }
    public function addBook()
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
                    'wholesale_price' => $book->warehouse->wholesale_price,
                    'quantity' => 1,
                    'quantity_old' => $book->warehouse->quantity,
                ];
                $this->selectedBookIds[] = $book->id;
                $this->total += ($book->warehouse->retail_price);
            }
            $this->reset('book_id');
        }
    }
    public function updateTotal()
    {
        $this->total = 0;
        $invalidQuantityCount = 0;

        foreach ($this->selectedBook as $data) {
            $quantity = $data['quantity'];
            if ($quantity > 0) {
                if ($quantity >= 20) {
                    $this->total += ($data['wholesale_price'] * $quantity);
                } else {
                    $this->total += ($data['price'] * $quantity);
                }
            } else {
                $invalidQuantityCount++;
            }
        }
        if ($invalidQuantityCount === 0) {
            return $this->total;
        } else {
            request()->session()->flash('fail', 'Số lượng sách không phù hợp.');
            return -1;
        }
    }

    public function delete($id)
    {
        $index = array_search($id, $this->selectedBookIds);
        if ($index !== false) {
            $deletedBook = $this->selectedBook[$index];
            unset($this->selectedBookIds[$index]);
            unset($this->selectedBook[$index]);
            $this->total -= ($deletedBook['price'] * $deletedBook['quantity']);
        }
    }
    public function addNew()
    {
        if ($this->selectedBook == null) {
            request()->session()->flash('fail', 'Vui lòng chọn ít nhất một sản phẩm.');
        } else {
            $i = 0;
            foreach ($this->selectedBook as $data) {
                if ($data['quantity'] > $data['quantity_old'] || $data['quantity'] < 0) {
                    $i++;
                }
            }
            if ($i > 0) {
                request()->session()->flash('fail', 'Vui lòng kiểm tra lại số lượng sản phẩm.');
            } else {
                $validated = $this->validate();
                $order = Order::create([
                    "name" => $validated["name"],
                    "phone_number" => $validated["phone_number"],
                    "payment" => $validated["payment"],
                    "status" => "completed",
                    "email" => $validated["email"],
                    "address" => "Tại quầy",
                    "ship_fee" => 0,
                    "total_product_amount" => $this->total,
                    "total" => $this->total,
                ]);
                if ($order) {
                    $newTotal = 0;
                    foreach ($this->selectedBook as $data) {
                        if ($data['quantity'] >= 20) {
                            $newTotal += ($data['wholesale_price'] * $data['quantity']);
                            OrderDetail::create([
                                "order_id" => $order->id,
                                "book_name" => $data["name"],
                                "book_id" => $data["id"],
                                "quantity" => $data["quantity"],
                                "book_price" => $data["wholesale_price"],
                                "book_image" => $data["image"]
                            ]);
                            $warehouse = Warehouse::where('book_id', $data['id'])->first();
                            if ($warehouse) {
                                $warehouse->quantity -= $data['quantity'];
                                $warehouse->delivery_quantity += $data['quantity'];
                                $warehouse->save();
                            }
                        } else {
                            $newTotal += ($data['price'] * $data['quantity']);
                            OrderDetail::create([
                                "order_id" => $order->id,
                                "book_name" => $data["name"],
                                "book_id" => $data["id"],
                                "quantity" => $data["quantity"],
                                "book_price" => $data["price"],
                                "book_image" => $data["image"]
                            ]);
                            $warehouse = Warehouse::where('book_id', $data['id'])->first();
                            if ($warehouse) {
                                $warehouse->quantity -= $data['quantity'];
                                $warehouse->delivery_quantity += $data['quantity'];
                                $warehouse->save();
                            }
                        }
                    }
                    $this->selectedBook = [];
                    $this->reset();
                    request()->session()->flash('success', 'Tạo đơn thành công!');
                }
            }
        }
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone_number' => 'required|string|max:20',
            'payment' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Vui lòng nhập tên.',
            'name.max' => 'Tên không được vượt quá :max kí tự.',
            'email.required' => 'Vui lòng nhập địa chỉ email.',
            'email.email' => 'Địa chỉ email không hợp lệ.',
            'email.max' => 'Địa chỉ email không được vượt quá :max kí tự.',
            'phone_number.required' => 'Vui lòng nhập số điện thoại.',
            'phone_number.max' => 'Số điện thoại không được vượt quá :max kí tự.',
            'payment.required' => 'Vui lòng chọn phương thức thanh toán.',
            'payment.max' => 'Phương thức thanh toán không được vượt quá :max kí tự.',
        ];
    }
}
