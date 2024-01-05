<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;
    protected $table = 'coupons';
    protected $fillable = [
        'name',
        'code',
        'value',
        'type',
        'quantity',
        'start_date',
        'end_date',
        'point_required',
        'used_count',
        'price_required',
        'status',
        'is_activate'
    ];

    public function getCouponValue(): string
    {
        if ($this->type === "percent") {
            return "%";
        } else {
            return "VNĐ";
        }
    }

    public function qualified($userPoint)
    {
        return $userPoint >= $this->point_required;
    }
    public function getImageAttribute($coupon)
    {
        return asset('storage/' . $coupon);
    }
}
