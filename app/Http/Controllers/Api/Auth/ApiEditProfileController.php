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
    public function updatePassword(Request $request)
    {
        $user = Auth::user();
        $request->validate([
            'old_password' => 'required',
            'password' => 'string|min:5|max:255|confirmed',
        ]);

        if (!Hash::check($request->input('old_password'), $user->password)) {
            return response()->json(['message' => 'Mật khẩu không phù hợp'], 401);
        }

        $userData = [];
        if ($request->filled('password')) {
            $userData['password'] = bcrypt($request->input('password'));
        }
        $user->update($userData);

        return response()->json(['message' => 'Cập nhật mật khẩu thành công'], 200);
    }
    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'min:5|max:255',
            'phone_number' => '',
            'email' => 'email',
        ]);

        $userData = [];
        if ($request->filled('name')) {
            $userData['name'] = $request->input('name');
        }
        if ($request->filled('phone_number')) {
            $userData['phone_number'] = $request->input('phone_number');
        }
        if ($request->filled('email')) {
            $userData['email'] = $request->input('email');
        }

        $user->update($userData);

        return response()->json(['message' => 'Cập nhật thông tin hồ sơ thành công'], 200);
    }
}
