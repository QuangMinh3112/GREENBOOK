<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsedCoupon extends Model
{
    use HasFactory;
    protected $table = 'used_coupons';
    protected $fillable = [
        'user_id',
        'coupon_id',
        'used_date',
    ];
}
