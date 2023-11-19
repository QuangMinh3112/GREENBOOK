<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $table = 'orders';
    protected $fillable = [
        'name',
        'email',
        'phone_number',
        'address',
        'payment',
        'status',
        'total',
        'coupon_id',
        'user_id'
    ];
    public function getPaymentAttribute($value)
    {
        return $value === 'COD' ? 'Thanh toán khi nhận hàng' : 'Đã thanh toán';
    }
    public function getStatusAttribute($value)
    {
        switch ($value) {
            case 'pending':
                return 'Chờ xử lý';
            case 'shipping':
                return 'Đang giao hàng';
            case 'shipped':
                return 'Đã giao hàng';
            case 'completed':
                return 'Hoàn thành';
            case 'failed':
                return 'Thất bại';
            default:
                return $value;
        }
    }
}
