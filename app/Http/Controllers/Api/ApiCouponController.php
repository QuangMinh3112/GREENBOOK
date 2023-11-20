<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CouponResource;
use App\Models\Coupon;
use Illuminate\Http\Request;

class ApiCouponController extends Controller
{
    //
    public function getFreeCoupon()
    {
        $coupon = Coupon::where('status', 'LIKE', '%Public%')->latest()->get();
        return response()->json(['message' => 'Success', 'data' => CouponResource::collection($coupon), 200]);
    }
}
