<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CouponResource;
use App\Models\Coupon;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApiCouponController extends Controller
{
    //
    private $user;
    private $coupon;
    public function __construct(Coupon $coupon)
    {
        $this->user = Auth::user();
        $this->coupon = $coupon;
    }
    public function getFreeCoupon()
    {
        $coupons = Coupon::where('status', 'LIKE', '%Public%')->latest()->get();
        // $qualifiedCoupon = $coupons->filter(function($coupon) use ($this->user->point){
        //     return $coupon->qualified($this->user->point);
        // });
        return response()->json(['message' => 'Success', 'data' => CouponResource::collection($coupons), 200]);
    }
}
