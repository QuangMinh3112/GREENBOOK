<?php

namespace App\Livewire\Suppliers;

use App\Models\Supplier;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\WithPagination;

#[Layout('Layout.app')]
#[Title('Nhà cung cấp')]
class Index extends Component
{
    use WithPagination;
    public $page = 5;
    public $name;
    public $email;
    public function render()
    {
        return view('livewire.suppliers.index', [
            'suppliers' => Supplier::when($this->name != "", function ($query) {
                $query->nameSearch($this->name);
            })->when($this->email != "", function ($query) {
                $query->emailSearch($this->email);
            })->paginate($this->page),
        ]);
    }
    public function delete($id)
    {
        $suppliers = Supplier::find($id);
        if ($suppliers) {
            $suppliers->delete();
            request()->session()->flash('success', 'Xoá thành công');
        }
    }
}
