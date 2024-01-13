<?php

namespace App\Livewire\ProductMovement;

use App\Models\Book;
use App\Models\ProductMovement;
use App\Models\ProductTransition;
use App\Models\Warehouse;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;

#[Layout('Layout.app')]
#[Title('Nhập kho')]
class Create extends Component
{
    #[Validate()]
    public $total;
    public $inputs;
    public $key;
    public $quantity;
    public $import_price;
    public $product_id;
    public $code;
    public $description;
    public $note;
    public function mount()
    {
        $this->inputs = [];
        $this->key = 0;
        $this->import_price[] = 0;
        $this->quantity = [];
        $this->total = [];
        $this->product_id = [];
    }
    public function render()
    {
        return view('livewire.product-movement.create', [
            "books" => Book::all(),
        ]);
    }
    public function addField($key)
    {
        $this->key = $key + 1;
        array_push($this->inputs, $key);
    }
    public function addNew()
    {
        $validated = $this->validate();
        $import = ProductMovement::create([
            "code" => $validated["code"],
            "description" => $validated["description"],
            "note" => $validated["note"],
            "creator" => Auth::user()->name,
            "type" => "import",
        ]);
        if ($import) {
            foreach ($this->inputs as $key => $product_id) {
                ProductTransition::create([
                    "movement_id" => $import->id,
                    "product_id" => $product_id,
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
        request()->session()->flash('success', 'Thêm mới thành công');
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
    public function rules()
    {
        return [
            'code' => 'required|max:255',
            'description' => 'required|max:255',
            'note' => 'max:255',
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
        ];
    }
}
