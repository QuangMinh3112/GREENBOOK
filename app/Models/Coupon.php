<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;
    protected $table = 'coupons';
    protected $fillable = [
        'code',
        'status',
        'discount',
        'value',
        'end_time',
        'description'
    ];

    public function getCouponValue(): string
    {
        if ($this->value === "percent") {
            return "%";
        } else {
            return "VNĐ";
        }
    }

    public function qualified($userPoint)
    {
        return $userPoint >= $this->point_required;
    }
}
