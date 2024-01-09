<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class OrderDetail extends Model
{
    use HasFactory;
    protected $table = "order_details";
    protected $fillable = [
        'order_id',
        'book_id',
        'quantity',
        'book_name',
        'book_image',
        'book_price',
    ];
    public function book()
    {
        return $this->belongsTo(Book::class);
    }
}
