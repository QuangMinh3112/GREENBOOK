<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Book extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = "books";
    protected $fillable = [
        'name',
        'image',
        'detail_image',
        'price',
        'author',
        'category_id',
        'description',
        'short_description',
        'slug',
        'published_company',
        'published_year',
        'width',
        'height',
        'quantity',
        'status',
        'sale',
        'number_of_pages',
    ];
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function getCategoryName()
    {
        $category = Category::find($this->category_id);
        if ($category) {
            return $category->name;
        } else {
            return "Rỗng";
        }
    }
    public function getStatus()
    {
        if ($this->status == 0) {
            return "Inactive";
        } else {
            return "Active";
        }
    }
}
