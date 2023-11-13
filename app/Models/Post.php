<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function getCategoryName()
    {
        $category = CategoryPost::find($this->category_id);
        if ($category) {
            return $category->name;
        } else {
            return "Rỗng";
        }
    }
}
