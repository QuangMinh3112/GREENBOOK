<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComboBook extends Model
{
    use HasFactory;
    protected $table = 'combo_books';
    protected $fillable = [
        'book_id',
        'combo_id'
    ];
}
