<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Warehouse extends Model
{
    use HasFactory;
    protected $table = "warehouses";
    protected $fillable = [
        "book_id",
        "quantity",
        "import_price",
        "retail_price",
        "wholesale_price",
        "returned_quantity",
        "defective_quantity",
        "stock",
    ];
    public function getBookName()
    {
        $book = Book::find($this->book_id);
        if ($book) {
            return $book->name;
        } else {
            return "Rỗng";
        }
    }
    public function getSupplier()
    {
        $supplier = Supplier::find($this->supplier_id);
        if ($supplier) {
            return $supplier->name;
        } else {
            return "Rỗng";
        }
    }
    public function getBookImage()
    {
        $book = Book::find($this->book_id);
        if ($book) {
            return $book->image;
        } else {
            return "Rỗng";
        }
    }
    public function book()
    {
        return $this->belongsTo(Book::class, 'book_id');
    }
    public function carts()
    {
        return $this->hasMany(Cart::class, 'book_id', 'book_id');
    }
}
