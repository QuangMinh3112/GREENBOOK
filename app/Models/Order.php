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
        'coupon',
        'user_id',
        'service_id',
        'province_id',
        'district_id',
        'ward_id',
    ];
    public function getPaymentAttribute($value)
    {
        if ($value === 'Waiting') {
            return 'Đang chờ thanh toán';
        } elseif ($value === 'COD') {
            return 'Thanh toán khi nhận hàng';
        } elseif ($value === 'Paid') {
            return 'Đã thanh toán';
        }
    }
    public function getStatusAttribute($value)
    {
        switch ($value) {
            case 'pending':
                return 'Chờ xử lý';
            case 'confirmed':
                return 'Đã xác nhận';
            case 'pending':
                return 'Chờ xử lý';
            case 'completed':
                return 'Hoàn thành';
            case 'cancel':
                return 'Đã huỷ';
            case 'shipped':
                return 'Đã giao hàng';
            case 'completed':
                return 'Hoàn thành';
            case 'failed':
                return 'Thất bại';
            case 'shipping':
                return 'Đang giao';
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
    public function scopePurchased($user_id)
    {
        return $this->where('user_id', $user_id)
            ->where('status', 'completed')
            ->exists();
    }
    public function scopeSearch($query, $value)
    {
        $query->where('order_code', 'like', "%{$value}%");
    }
    public function scopeFindId($query, $uuid)
    {
        return $query->where('id', $uuid);
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
