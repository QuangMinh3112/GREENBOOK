<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Book extends Model
{
    use HasFactory, SoftDeletes;
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
