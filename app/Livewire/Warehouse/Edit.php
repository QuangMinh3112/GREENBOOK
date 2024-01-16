<?php

namespace App\Livewire\Warehouse;

use App\Models\Book;
use App\Models\Supplier;
use App\Models\Warehouse;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;

#[Layout('Layout.app')]
#[Title('Chi tiết kho hàng')]
class Edit extends Component
{
    #[Validate()]
    public $warehouse;
    public $suppliers;
    public $book;
    public $import_price;
    public $retail_price;
    public $wholesale_price;
    public $quantity;
    public $stock;
    public $delivery_quantity;
    public $defective_quantity;
    public $returned_quantity;
    public $supplier_id;
    public function mount($id)
    {
        $this->warehouse = Warehouse::where('id', $id)->first();
        $this->book = Book::where('id', $this->warehouse->book_id)->first();
        $this->suppliers = Supplier::all();
        if ($this->warehouse) {
            $this->supplier_id = $this->warehouse->supplier_id;
            $this->import_price = $this->warehouse->import_price;
            $this->retail_price = $this->warehouse->retail_price;
            $this->wholesale_price = $this->warehouse->wholesale_price;
            $this->quantity = $this->warehouse->quantity;
            $this->stock = $this->warehouse->stock;
            $this->delivery_quantity = $this->warehouse->delivery_quantity;
            $this->defective_quantity = $this->warehouse->defective_quantity;
            $this->returned_quantity = $this->warehouse->returned_quantity;
        }
    }
    public function render()
    {
        return view('livewire.warehouse.edit');
    }
    public function update()
    {
        $validated = $this->validate();
        $this->warehouse->update([
            "supplier_id" => $validated["supplier_id"],
            "import_price" => $validated["import_price"],
            "retail_price" => $validated["retail_price"],
            "wholesale_price" => $validated["wholesale_price"],
            "quantity" => $validated["quantity"],
            "stock" => $validated["stock"],
            "delivery_quantity" => $validated["delivery_quantity"],
            "defective_quantity" => $validated["defective_quantity"],
            "returned_quantity" => $validated["returned_quantity"],
        ]);
        request()->session()->flash('success', 'Cập nhật thành công');
    }
    public function rules()
    {
        return [
            'suppliers' => 'required',
            'import_price' => 'required|numeric|min:0',
            'wholesale_price' => 'required|numeric|min:' . ($this->import_price ?? 0),
            'retail_price' => 'required|numeric|min:' . ($this->wholesale_price ?? 0),
            'quantity' => 'required|numeric|min:0',
            'stock' => 'required|numeric|min:0',
            'delivery_quantity' => 'required|numeric|min:0',
            'defective_quantity' => 'required|numeric|min:0',
            'returned_quantity' => 'required|numeric|min:0',
            'supplier_id' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'supplier_id' => 'Không bỏ trống nhà cung cấp',
            'import_price.required' => 'Vui lòng nhập giá nhập.',
            'import_price.numeric' => 'Giá nhập phải là một số.',
            'import_price.min' => 'Giá nhập phải lớn hơn hoặc bằng 0.',
            'wholesale_price.required' => 'Vui lòng nhập giá sỉ.',
            'wholesale_price.numeric' => 'Giá sỉ phải là một số.',
            'wholesale_price.min' => 'Giá sỉ phải lớn hơn hoặc bằng giá nhập.',
            'retail_price.required' => 'Vui lòng nhập giá bán lẻ.',
            'retail_price.numeric' => 'Giá bán lẻ phải là một số.',
            'retail_price.min' => 'Giá bán lẻ phải lớn hơn hoặc bằng giá sỉ.',
            'quantity.required' => 'Vui lòng nhập số lượng trong kho.',
            'quantity.numeric' => 'Số lượng trong kho không phù hợp.',
            'quantity.min' => 'Số lượng trong kho phải lớn hơn hoặc bằng 0.',
            'stock.required' => 'Vui lòng nhập số hàng tồn kho.',
            'stock.numeric' => 'Hàng tồn kho phải là một số.',
            'stock.min' => 'Hàng tồn kho phải lớn hơn hoặc bằng 0.',
            'delivery_quantity.required' => 'Vui lòng nhập số lượng đã xuất.',
            'delivery_quantity.numeric' => 'Số lượng đã xuất không phù hợp.',
            'delivery_quantity.min' => 'Số lượng đã xuất phải lớn hơn hoặc bằng 0.',
            'defective_quantity.required' => 'Vui lòng nhập số lượng lỗi.',
            'defective_quantity.numeric' => 'Số lượng lỗi không phù hợp.',
            'defective_quantity.min' => 'Số lượng lỗi phải lớn hơn hoặc bằng 0.',
            'returned_quantity.required' => 'Vui lòng nhập số lượng trả lại.',
            'returned_quantity.numeric' => 'Số lượng trả lại không phù hợp.',
            'returned_quantity.min' => 'Số lượng trả lại phải lớn hơn hoặc bằng 0.',
        ];
    }
}
