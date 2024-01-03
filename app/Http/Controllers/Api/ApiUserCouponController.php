<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Models\UserCoupon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApiUserCouponController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    public function index()
    {
        $user = Auth::user();
        $user_coupon = UserCoupon::where('user_id', $user->id)->with('coupon')->get();
        if (count($user_coupon) > 0) {
            return response()->json(["message" => "Success", "data" => $user_coupon], 200);
        } else {
            return response()->json(["message" => "Không có mã giảm giá nào"], 200);
        }
    }
    public function filter(Request $request)
    {
        $type = $request->input('type');
        $is_used = $request->input('is_used');
        $userCoupons = UserCoupon::query();
        if ($type) {
            $userCoupons->whereHas('coupon', function ($query) use ($type) {
                $query->where('type', $type);
            });
        }
        if ($is_used) {
            $coupon->where('is_used', $is_used);
        }
    }
    public function show($id)
    {
        $user = Auth::user();
        $detail = UserCoupon::where('user_id', $user->id)->where('id', $id)->get();
        if ($detail) {
            return response()->json(["message" => "Success", "data" => $detail], 200);
        } else {
            return response()->json(["message" => "Không tìm thấy mã giảm giá"], 404);
        }
    }
    public function delete($id)
    {
        $user = Auth::user();
        $delete = UserCoupon::where('user_id', $user->id)->where('id', $id)->get();
        if ($delete->delete()) {
            return response()->json(["message" => "Xoá thành công"], 200);
        } else {
            return response()->json(["message" => "Không tìm thấy mã giảm giá"], 404);
        }
    }
}
