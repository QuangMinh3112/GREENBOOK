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
    public function parentCategory()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }
    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
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
        $allCategories = Category::all();
        $rootCategories = $allCategories->whereNull('parent_id');
        self::formatTree($rootCategories, $allCategories);
        if ($rootCategories->isNotEmpty()) {
            return $rootCategories;
        } else {
            return null;
        }
    }
    private static function formatTree($categories, $allCategories)
    {
        foreach ($categories as $category) {
            $children = $allCategories->where('parent_id', $category->id);

            if ($children->isNotEmpty()) {
                $category->children = collect(self::formatTree($children, $allCategories));
            } else {
                $category->children = null;
            }
        }

        return $categories;
    }
}
