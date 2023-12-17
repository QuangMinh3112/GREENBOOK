<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Notifications\ResetPassword;
use App\Models\User;
use Ichtrojan\Otp\Models\Otp;

class ApiResetPassword extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('guest');
    }
    public function forgotPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);
        $user = User::where('email', 'like', '%' . $request->email . '%')->first();
        if ($user) {
            $user->notify(new ResetPassword());
            return response()->json(['message' => 'Đã gửi mã xác nhận'], 200);
        } else {
            return response()->json(['message' => 'Không tồn tại người dùng có email trên'], 404);
        }
    }
    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'otp' => 'required|numeric',
            'password' => 'required|min:5|confirmed',
        ]);
        $otp = Otp::where('identifier', 'like',  '%' . $request->email . '%')->where('token', $request->otp)->first();
        if ($otp) {
            $otp->delete();
            $user = User::where('email', 'like', '%' . $request->email . '%');
            $user->update(['password' => bcrypt($request->password)]);
            return response()->json(['message' => 'Khôi phục thành công'], 200);
        } else {
            return response()->json(['message' => 'Mã xác minh không hợp lệ'], 400);
        }
    }
}
