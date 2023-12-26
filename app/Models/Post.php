<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = "posts";
    protected $fillable = [
        "title",
        "content",
        "image",
        "status",
        "slug",
        "view",
        "category_id",
        "user_id"
    ];
    public function getCategoryName()
    {
        $category = CategoryPost::find($this->category_id);
        if ($category) {
            return $category->name;
        } else {
            return "Rỗng";
        }
    }
    public function getUserName()
    {
        $user = User::find($this->user_id);
        if ($user) {
            return $user->name;
        } else {
            return "";
        }
    }
    public function category()
    {
        return $this->belongsTo(CategoryPost::class);
    }
    public function getImageAttribute($post)
    {
        return asset('storage/' . $post);
    }
    public function scopeTitleSearch($query, $value)
    {
        $query->where('title', 'like', '%' . $value . '%');
    }
    public function scopeStatusSearch($query, $value)
    {
        $query->where('status', 'like', '%' . $value . '%');
    }
}
