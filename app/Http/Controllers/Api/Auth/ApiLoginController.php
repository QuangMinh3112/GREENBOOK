<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;


class ApiLoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
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
}
