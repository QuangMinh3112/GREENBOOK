<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Str;


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
            if ($infomation->status == 0) {
                return response()->json(['error' => 'Bạn đã bị cấm'], 401);
            } else {
                $accessToken = auth()->user()->createToken('MyAppToken')->accessToken;
                return response()->json(['access_token' => $accessToken, 'message' => 'Đăng nhập thành công', 'data' => $infomation], 200);
            }
        } else {
            return response()->json(['error' => 'Vui lòng kiểm tra lại email hoặc mật khẩu'], 401);
        }
    }
    public function redirectGoogle()
    {
        return Socialite::driver('google')->stateless()->redirect();
    }
    public function handleGoogleCallback()
    {
        $socialiteUser = Socialite::driver('google')->stateless()->user();

        $user = User::where('email', $socialiteUser->email)->first();

        if (!$user) {
            $user = User::create([
                'name' => $socialiteUser->name,
                'email' => $socialiteUser->email,
                'password' => bcrypt(Str::random(16)),
                'is_vertify' => 1,
            ]);
        }

        $token = $user->createToken('Socialite Token')->accessToken;

        return response()->json(['access_token' => $token, 'user' => $user]);
    }
    public function redirectFacebook()
    {
        return Socialite::driver('facebook')->stateless()->redirect();
    }
    public function handleFacebookCallback()
    {
        $socialiteUser = Socialite::driver('facebook')->stateless()->user();

        $user = User::where('email', $socialiteUser->email)->first();

        if (!$user) {
            $user = User::create([
                'name' => $socialiteUser->name,
                'email' => $socialiteUser->email,
                'password' => bcrypt(Str::random(16)),
            ]);
        }

        $token = $user->createToken('Socialite Token')->accessToken;

        return response()->json(['access_token' => $token]);
    }
}
