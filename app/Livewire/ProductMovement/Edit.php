<?php

namespace App\Livewire\ProductMovement;

use App\Models\ProductMovement;
use App\Models\ProductTransition;
use Livewire\Component;
use App\Models\Warehouse;
use Illuminate\Support\Facades\Auth;
use App\Models\Book;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;

#[Layout('Layout.app')]
#[Title('Chỉnh sửa dữ liệu nhập kho')]
class Edit extends Component
{
    #[Validate()]
    public $product_movement;
    public $product_transition;
    public $total;
    public $inputs;
    public $key;
    public $quantity;
    public $import_price;
    public $product_id;
    public $code;
    public $description;
    public $note;
    public $book_id;
    public function mount($id)
    {
        $this->product_movement = ProductMovement::find($id);
        $this->product_transition = ProductTransition::where('movement_id', $id)->get();
        $this->key = count($this->product_transition);
        $this->code = $this->product_movement->code;
        $this->description = $this->product_movement->description;
        $this->note = $this->product_movement->note;
        foreach ($this->product_transition as $key => $value) {
            $this->inputs[] = $key;
            $this->product_id[$key] = $value->product_id;
            $this->quantity[$key] = $value->quantity;
            $this->import_price[$key] = Warehouse::where('book_id', $this->product_id[$key])->value('import_price');
            $this->total[$key] = $value->total;
        }
        $this->book_id = Warehouse::pluck('book_id')->toArray();
        // dd($this->product_id, $this->quantity, $this->total, $this->key, $this->import_price);
    }
    public function update()
    {
        if (empty($this->inputs)) {
            request()->session()->flash('fail', 'Không có sản phẩm nào để nhập hàng');
        } else {
            // dd($this->quantity, $this->product_id);
            $validated = $this->validate();
            $this->product_movement->update([
                "code" => $validated["code"],
                "description" => $validated["description"],
                "note" => $validated["note"],
                "creator" => Auth::user()->name,
                "type" => "import",
            ]);
            if ($this->product_movement) {
                // $this->product_transition->delete();
                ProductTransition::where('movement_id', $this->product_movement->id)->delete();
                $count = count($this->product_id);
                for ($key = 0; $key < $count; $key++) {
                    ProductTransition::create([
                        "movement_id" => $this->product_movement->id,
                        "product_id" => $this->product_id[$key],
                        "quantity" => $this->quantity[$key],
                        "total" => $this->total[$key]
                    ]);
                    $warehouse = Warehouse::where('book_id', $this->product_id[$key])->first();
                    if ($warehouse) {
                        $warehouse->stock += $warehouse->quantity;
                        $warehouse->quantity = $this->quantity[$key];
                        $warehouse->save();
                    }
                }
            }
            request()->session()->flash('success', 'Cập nhật thành công');
        }
    }
    public function render()
    {
        return view('livewire.product-movement.edit', [
            "books" => Book::whereIn('id', $this->book_id)->get(),
        ]);
    }
    public function removeField($key)
    {
        unset($this->inputs[$key]);
        unset($this->product_id[$key]);
        unset($this->quantity[$key]);
        unset($this->import_price[$key]);
        unset($this->total[$key]);
    }
    public function updateImportPrice($key)
    {
        $selected = $this->product_id[$key];
        $warehouse = Warehouse::where('book_id', $selected)->first();
        if ($warehouse) {
            $this->import_price[$key] = $warehouse->import_price;
        }
    }
    public function updateTotalPrice($key)
    {
        $this->total[$key] = $this->import_price[$key] * $this->quantity[$key];
    }
    public function addField($key)
    {
        $this->key = $key + 1;
        array_push($this->inputs, $key);
    }
    public function rules()
    {
        return [
            'code' => 'required|max:255',
            'description' => 'required|max:255',
            'note' => 'max:255',
            'product_id' => 'required',
            'quantity' => 'required|min:0'
        ];
    }

    public function messages()
    {
        return [
            'code.required' => 'Không bỏ trống mã đơn hàng.',
            'code.max' => 'Mã không được vượt quá 255 ký tự.',
            'description.required' => 'Không bỏ trống nội dung.',
            'description.max' => 'Miêu tả không được vượt quá 255 ký tự.',
            'note.max' => 'Ghi chú không được vượt quá 255 ký tự.',
            'product_id.required' => 'Vui lòng chọn sản phẩm',
            'quantity.required' => 'Vui lòng nhập số lượng nhập',
            'quantity.min' => 'Số lượng nhập phải lớn hơn 1'
        ];
    }
}
