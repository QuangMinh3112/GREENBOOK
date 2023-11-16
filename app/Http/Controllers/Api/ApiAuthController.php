<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ApiAuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
        ]);
        return response()->json(['message' => 'Registration successful'], 200);
    }
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['msg' => 'Lỗi chưa login được', 'error' => $validator->errors()], 401);
        }

        $user = $request->only('email', 'password');

        if (Auth::attempt($user)) {
            $accessToken = auth()->user()->createToken('MyAppToken')->accessToken;

            return response()->json(['access_token' => $accessToken, 'message' => 'Login successful'], 200);
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
