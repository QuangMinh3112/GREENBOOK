<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\AuthRequest;
use App\Models\User;
use App\Notifications\EmailVerificationNotification;

class ApiRegisterController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('guest');
    }
    public function register(AuthRequest $request)
    {
        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
            'phone_number' => $request->input('phone_number'),
        ]);
        if ($user) {
            $user->notify(new EmailVerificationNotification());
            return response()->json(['message' => 'Đăng ký thành công'], 201);
        } else {
            return response()->json(['errors' => $errors], 422);
        }
    }
}
