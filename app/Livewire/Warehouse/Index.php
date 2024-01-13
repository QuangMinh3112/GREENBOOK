<?php

namespace App\Livewire\Warehouse;

use App\Exports\WarehousesExport;
use App\Models\Warehouse;
use App\Models\Category;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

#[Layout('Layout.app')]
#[Title('Kho hàng')]

class Index extends Component
{
    use WithPagination;
    public $page = 5;
    public $category_id;
    public function render()
    {
        $query = Warehouse::query();
        if ($this->category_id) {
            $query->whereHas('book', function ($bookQuery) {
                $bookQuery->where('category_id', $this->category_id);
            });
        }
        return view('livewire.warehouse.index', [
            "warehouses" => $query->paginate($this->page),
            'categories' => Category::tree(),
        ]);
    }
    public function export(Warehouse $warehouses)
    {
        return Excel::download(new WarehousesExport($warehouses), 'kho-hang.xlsx');
    }
}
