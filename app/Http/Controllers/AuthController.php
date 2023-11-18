<?php

namespace App\Http\Controllers;


use App\Http\Controllers\Controller;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use RealRashid\SweetAlert\Facades\Alert;


class AuthController extends Controller
{
    private $user;
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function loginPage()
    {
        $title = "Đăng nhập";
        return view('Auth.login', compact('title'));
    }
    public function loginProcess(Request $request)
    {
        $data = $request->only('email', 'password');
        if (Auth::attempt($data)) {
            return redirect('/');
        } else {
            Alert::info('Đăng nhập thất bại', 'Vui lòng kiểm tra lại Email hoặc mật khẩu');
            return back();
        }
    }
    public function registerPage()
    {
        $title = "Đăng ký";
        return view('Auth.register', compact('title'));
    }
    public function registerProcess(Request $request)
    {
        if ($request->isMethod('POST')); {
            $this->user->name = $request->name;
            $this->user->email = $request->email;
            $this->user->address = $request->address;
            $this->user->avatar = "dvfhjdshfgsd";
            $this->user->password = Hash::make($request->password);
            $this->user->phone_number = $request->phone_number;
            $this->user->save();
            if ($this->user->save()) {
                Alert::success('Đăng ký thành công');
                return redirect()->route('auth.login');
            }
        }
    }
    public function logOut()
    {
        Auth::logout();
        return back();
    }
    public function profile()
    {
        $user = $this->user::find(Auth::user()->id);
        
    }
}
