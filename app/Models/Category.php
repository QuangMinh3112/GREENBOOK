<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Category extends Model
{
    use HasFactory;
    protected $table = 'categories';
    protected $fillable = [
        'name',
        'description',
        'slug',
        'parent_id'
    ];
    public function limit()
    {
        return Str::limit($this->description, 30, '...');
    }
    // public function parentCategory()
    // {
    //     return $this->belongsTo(Category::class, 'parent_id');
    // }
    // public function getFullCategoryAttribute()
    // {
    //     $category = $this;
    //     $path = $category->name;
    //     while($category->parentCategory){
    //         $category = $category->parentCategory;
    //         $path = $category->name . '>' . $path;
    //     }
    //     return $path;
    // }
}
