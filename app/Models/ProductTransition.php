<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductTransition extends Model
{
    use HasFactory;
    protected $table = "product_transitions";
    protected $fillable = [
        "product_id",
        "movement_id",
        "quantity",
        "total"
    ];
    public function book()
    {
        return $this->belongsTo(Book::class);
    }
    public function getBookName()
    {
        $book = Book::find($this->product_id);
        if ($book) {
            return $book->name;
        } else {
            return "Rỗng";
        }
    }
    public function getBookPrice()
    {
        $warehouse = Warehouse::where('book_id', $this->product_id)->first();
        if ($warehouse) {
            return $warehouse->import_price;
        } else {
            return "Rỗng";
        }
    }
}
