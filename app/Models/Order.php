<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Order extends Model
{
    use HasFactory, HasUuids;
    protected $table = 'orders';
    protected $fillable = [
        'order_code',
        'name',
        'email',
        'phone_number',
        'address',
        'payment',
        'status',
        'ship_fee',
        'total_product_amount',
        'total',
        'code',
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
    public static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->id = Str::uuid();
            $model->order_code = 'DONHANG-' . str_pad(Order::count() + 1, 4, '0', STR_PAD_LEFT);
        });
    }
}
