<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;

class ApiAuthController extends Controller
{
    private $user;
    public function __construct(User $user)
    {
        $this->user = $user;
    }
    public function register(Request $request)
    {
        if ($request->isMethod('POST')) {
            $this->user->name = $request->name;
            $this->user->email = $request->email;
            $this->user->phone_number = $request->phone_number;
            $this->user->password = Hash::make($request->name);
            $this->user->save();
            if ($this->user->save()) {
                return response()->json(['message' => 'Đăng ký thành công'], 200);
            }
        }
    }
    public function login(Request $request)
    {
        if ($request->isMethod('POST')) {
            $data = $request->only('email', 'password');
            if (Auth::attempt($data)) {
                $user = Auth::user();
                $accessToken = $user->createToken('authToken')->accessToken;
                return response()->json(['user' => $user, 'access_token' => $accessToken], 200);
            } else {
                return response()->json(['message' => 'Tài khoản không tồn tại'], 401);
            }
        }
    }
    public function checkLogin()
    {
        // $user = Auth::user();
        if (Auth::check()) {
            return response()->json(['authenticated' => true, 'message' => 'Đã đăng nhập']);
        } else {
            return response()->json(['authenticated' => false, 'message' => 'Chưa đăng nhập']);
        }
    }
    public function logOut()
    {
        $user = Auth::user();
        $user->revoke();
        return response()->json(['message' => 'Đã đăng xuất']);
    }
    public function profile()
    {
        $user = Auth::user();
        return response()->json(['message' => 'Đã lấy ra thông tin user', 'data' => $user]);
    }
}
