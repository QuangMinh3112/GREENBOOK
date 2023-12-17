<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ApiLogoutController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth.api');
    }
    public function logOut()
    {
        $user = auth()->user();
        $accessToken = $user->token();

        // Kiểm tra xem access token có hợp lệ không
        if ($accessToken->expires_at > now()) {
            $accessToken->revoke();
        }

        return response()->json([
            "message" => "User Logout"
        ], 200);
    }
}
