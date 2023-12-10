<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Notifications\EmailVerificationNotification;
use Ichtrojan\Otp\Models\Otp;
use App\Notifications\ResetPassword;

class ApiAuthController extends Controller
{
    public function register(AuthRequest $request)
    {
        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
            'phone_number' => $request->input('phone_number'),
        ]);
        if ($user) {
            // $user->notify(new EmailVerificationNotification());
            return response()->json(['message' => 'Đăng ký thành công'], 201);
        } else {
            return response()->json(['errors' => $errors], 422);
        }
    }
    public function sendOtpVertify()
    {
        if (Auth::check()) {
            $user = Auth::user();
            if ($user->email) {
                $user->notify(new EmailVerificationNotification());
                return response()->json(['message' => 'Đã gửi OTP'], 200);
            } else {
                return response()->json(['message' => 'Không tìm thấy email người dùng'], 400);
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
            return response()->json(['message' => 'Tài khoản đã được xác minh'], 200);
        } else {
            return response()->json(['message' => 'Mã OTP không hợp lệ'], 400);
        }
    }
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['msg' => 'Vui lòng kiểm tra lại tài khoản mật khẩu', 'error' => $validator->errors()], 401);
        }
        $user = $request->only('email', 'password');
        if (Auth::attempt($user)) {
            $infomation = Auth::user();
            $accessToken = auth()->user()->createToken('MyAppToken')->accessToken;
            return response()->json(['access_token' => $accessToken, 'message' => 'Đăng nhập thành công', 'data' => $infomation], 200);
        } else {
            return response()->json(['error' => 'Vui lòng kiểm tra lại email hoặc mật khẩu'], 401);
        }
    }
    public function showProfile()
    {
        $user = Auth::user();
        if (!$user) {
            return response()->json(["message" => "User not found"], 404);
        }
        return response()->json(["user" => $user], 200);
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
    public function logOut()
    {
        auth()->user()->token()->revoke();
        return response()->json([
            "message" => "User Logout"
        ], 200);
    }
}
