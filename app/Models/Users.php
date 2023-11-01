<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; // add soft delete

class Users extends Model
{
    use HasFactory,SoftDeletes;
    protected $table='users';
    protected $fillable=['name','address','phone_number','role','email','password'];
}


