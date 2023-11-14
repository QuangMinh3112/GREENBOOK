<?php

namespace App\Http\Controllers;


use App\Http\Controllers\Controller;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;


class AuthController extends Controller
{
    public function loginPage()
    {
        return view('Auth.login');
    }
    public function loginProcess()
    {
    }
    public function registerPage()
    {
        return view('Auth.register');
    }
    public function registerProcess()
    {
    }
}
