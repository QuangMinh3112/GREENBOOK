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
        auth()->user()->token()->revoke();
        return response()->json([
            "message" => "User Logout"
        ], 200);
    }
}
