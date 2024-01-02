<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApiShowProfileController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function showProfile()
    {
        $user = Auth::user();
        if (!$user) {
            return response()->json(["message" => "User not found"], 404);
        }
        return response()->json(["user" => $user], 200);
    }
}
