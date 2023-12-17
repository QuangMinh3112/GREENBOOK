<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Notifications\EmailVerificationNotification;
use Illuminate\Support\Facades\Auth;
use Ichtrojan\Otp\Models\Otp;


class ApiVerificationController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth.api');
    }
    public function sendOtpVertify()
    {
        if (Auth::check()) {
            $user = Auth::user();
            if ($user->is_vertify == 1) {
                return response()->json(['message' => 'Tài khoản đã được xác minh'], 200);
            } else {
                if ($user->email) {
                    $user->notify(new EmailVerificationNotification());
                    return response()->json(['message' => 'Đã gửi OTP'], 200);
                } else {
                    return response()->json(['message' => 'Không tìm thấy email người dùng'], 400);
                }
            }
        } else {
            return response()->json(['message' => 'Người dùng chưa đăng nhập '], 404);
        }
    }
    public function otpVertify(Request $request)
    {
        $user = Auth::user();
        $request->validate([
            'otp' => 'required|numeric',
        ]);
        $otp = Otp::where('identifier', 'like',  '%' . $user->email . '%')->where('token', $request->otp)->first();
        if ($otp) {
            $otp->delete();
            $user->is_vertify = true;
            $user->email_verified_at = now();
            $user->save();
            return response()->json(['message' => 'Xác minh thành công'], 200);
        } else {
            return response()->json(['message' => 'Mã OTP không hợp lệ'], 400);
        }
    }
}
