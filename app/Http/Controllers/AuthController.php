<?php

namespace App\Http\Controllers;


use App\Http\Controllers\Controller;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;


class AuthController extends Controller
{
        public function index(){
            return view('Auth.login',[
                'title'=>'Login'
            ]);
        }
        public function check(Request $request){
            if(Auth::attempt([
                'email'=>$request->email,
                'password'=>$request->password
            ])){
                return redirect('success')->with('success','Đăng nhập thành công');
            }else{
                return redirect('/login')->withErrors([
                    'email' => 'Tài khoản và mật khẩu không chính xác',
                ]);
            }
        }
    }

