<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryPost extends Model
{
    use HasFactory;
    public function parentCategory()
    {
        return $this->belongsTo(CategoryPost::class, 'parent_id');
    }
    public function children()
    {
        return $this->hasMany(CategoryPost::class, 'parent_id');
    }
    public function getFullCategoryAttribute()
    {
        $category = $this;
        $path = $category->name;
        while ($category->parentCategory) {
            $category = $category->parentCategory;
            if ($category->name != $this->name) {
                $path = $category->name . " \u{27A4} " . $path;
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
        $allCategories = CategoryPost::all();
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
