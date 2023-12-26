<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ApiEditProfileController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'old_password' => '',
            'password' => 'string|min:5|max:255|confirmed',
            'name' => 'min:5|max:255',
            'phone_number' => '',
            'email' => 'email',
        ]);

        if (!Hash::check($request->input('old_password'), $user->password)) {
            return response()->json(['message' => 'Mật khẩu không phù hợp'], 401);
        }

        $userData = [];
        if ($request->filled('name')) {
            $userData['name'] = bcrypt($request->input('name'));
        }
        if ($request->filled('phone_number')) {
            $userData['phone_number'] = bcrypt($request->input('phone_number'));
        }
        if ($request->filled('email')) {
            $userData['email'] = bcrypt($request->input('email'));
        }
        if ($request->filled('password')) {
            $userData['password'] = bcrypt($request->input('password'));
        }
        $user->update($userData);

        return response()->json(['message' => 'Cập nhật hồ sơ thành công'], 200);
    }
}
