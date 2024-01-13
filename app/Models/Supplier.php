<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;
    protected $table = "suppliers";
    protected $fillable = [
        'name',
        'phone_number',
        'email',
        'fax',
        'address',
    ];
    public function scopeNameSearch($query, $value)
    {
        $query->where('name', 'like', '%' . $value . '%');
    }
    public function scopeEmailSearch($query, $value)
    {
        $query->where('email', 'like', '%' . $value . '%');
    }
}
