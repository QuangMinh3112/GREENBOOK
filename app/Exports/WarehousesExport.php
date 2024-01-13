<?php

namespace App\Exports;

use App\Models\Warehouse;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class WarehousesExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    protected $warehouses;
    public function __construct(Warehouse $warehouses)
    {
        $this->warehouses = $warehouses;
    }
    public function collection()
    {
        return Warehouse::with('book')->get();
    }
    public function map($warehouses): array
    {
        return [
            $warehouses->id,
            $warehouses->getBookName(),
            $warehouses->suppliers_id,
            $warehouses->import_price,
            $warehouses->retail_price,
            $warehouses->wholesale_price,
            $warehouses->quantity,
            $warehouses->returned_quantity,
            $warehouses->defective_quantity,
            $warehouses->stock,
        ];
    }
    public function headings(): array
    {
        return [
            'ID',
            'ID sách',
            'ID nhà cung cấp',
            'Giá nhập',
            'Giá lẻ',
            'Giá sỉ',
            'Số lượng',
            'Trả về',
            'Bị hỏng',
            'Tồn kho',
            'Ngày tạo',
            'Ngày cập nhật',
        ];
    }
}
