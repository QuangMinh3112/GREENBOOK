<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Notifications\EmailVerificationNotification;
use Illuminate\Support\Facades\Auth;
use Ichtrojan\Otp\Models\Otp;


class ApiVerificationController extends Controller
{
    //
    public function __construct()
    {
        // $this->middleware('auth:api');
    }
    public function sendOtpVertify(Request $request)
    {
        $email = $request->input('email');
        if ($email) {
            $user = User::where('email', 'like', '%' . $email . '%')->first();
            if ($user) {
                if ($user->is_vertify == 0) {
                    $user->notify(new EmailVerificationNotification());
                    return response()->json(['message' => 'Đã gửi OTP'], 200);
                } else {
                    return response()->json(['message' => 'Tài khoản đã được xác minh'], 200);
                }
            } else {
                return response()->json(['message' => 'Không tìm thấy email người dùng'], 400);
            }
        }
    }
    public function otpVertify(Request $request)
    {
        $request->validate([
            'otp' => 'required|numeric',
        ]);
        $email = $request->input('email');
        $user = User::where('email', 'like', '%' . $email . '%')->first();
        if ($user) {
            $otp = Otp::where('identifier', 'like',  '%' . $email . '%')->where('token', $request->otp)->first();
            if ($otp) {
                $otp->delete();
                $user->is_vertify = true;
                $user->email_verified_at = now();
                $user->save();
                return response()->json(['message' => 'Xác minh thành công'], 200);
            } else {
                return response()->json(['message' => 'Mã OTP không hợp lệ'], 400);
            }
        } else {
            return response()->json(['message' => 'Không tìm thấy email người dùng'], 400);
        }
    }
}
