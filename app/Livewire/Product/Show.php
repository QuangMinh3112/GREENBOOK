<?php

namespace App\Livewire\Product;

use App\Models\Book;
use App\Models\Warehouse;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;


#[Layout('Layout.app')]
#[Title('Chi tiết sản phẩm')]
class Show extends Component
{

    public $product;
    public $warehouse;
    public function mount($id)
    {
        $this->product = Book::find($id);
        $this->warehouse = Warehouse::where('book_id', $id)->first();
    }
    public function render()
    {
        return view('livewire.product.show');
    }
}
