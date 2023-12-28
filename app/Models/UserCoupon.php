<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserCoupon extends Model
{
    use HasFactory;
    protected $table = "user_coupons";
    protected $fillable = [
        'user_id',
        'coupon_id',
    ];
}
