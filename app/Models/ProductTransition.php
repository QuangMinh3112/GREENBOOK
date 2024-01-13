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
}
