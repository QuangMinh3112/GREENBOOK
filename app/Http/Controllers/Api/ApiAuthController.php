<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ApiAuthController extends Controller
{
    public function register(AuthRequest $request)
    {
        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
            'address' => $request->input('address'),
        ]);
        if ($user) {
            return response()->json(['message' => 'Đăng ký thành công'], 201);
        } else {
            return response()->json(['errors' => $errors], 422);
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
            return response()->json(['error' => 'Unauthorized'], 401);
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
    public function logOut()
    {
        auth()->user()->token()->revoke();
        return response()->json([
            "message" => "User Logout"
        ], 200);
    }
}
