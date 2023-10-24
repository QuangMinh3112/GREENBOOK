<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Category extends Model
{
    use HasFactory, SoftDeletes;
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
    public function parentCategory()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }
    public function getFullCategoryAttribute()
    {
        $category = $this;
        $path = $category->name;
        while ($category->parentCategory) {
            $category = $category->parentCategory;
            if ($category->name != $this->name) {
                $path = $category->name . ' >> ' . $path;
            }
        }
        if ($path === $category->name) {
            return "Không có";
        } else {
            return $path;
        }
    }
    public static function tree()
    {
        $allCategories = Category::all();
        $rootCategories = $allCategories->whereNull('parent_id');
        self::formatTree($rootCategories, $allCategories);
        return $rootCategories;
    }
    private static function formatTree($categories, $allCategories)
    {
        foreach ($categories as $category) {
            $category->children = $allCategories->where('parent_id', $category->id);
            if ($category->children->isNotEmpty()) {
                self::formatTree($category->children, $allCategories);
            }
        }
    }
}
