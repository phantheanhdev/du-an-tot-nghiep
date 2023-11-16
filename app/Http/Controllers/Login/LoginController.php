<?php

namespace App\Http\Controllers\Login;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\User;

class LoginController extends Controller
{
    //
    public function login(Request $request)
    {
        if ($request->isMethod('POST')) {
            if (Auth::attempt(['username' => $request->username, 'password' => $request->password])) //đăng nhập thành công
            {
                Session::put('username', $request->username);
                return redirect('/')->with(session()->flash('alert', 'Đăng nhập thành công'));
            } else {
                return redirect('/login')->with(session()->flash('alert', 'sai mật khẩu'));
            }
        }
        return view('login.login');
    }
    public function register(Request $request)
    {
        if ($request->isMethod('POST')) {
            $this->validate($request, [
                'name' => 'required',
                'email' => 'required',
                'password' => 'required',
            ]);

            $user = new User();
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->password = bcrypt($request->input('password'));
            $user->save();


            Auth::login($user);
            return redirect('/');
        }
    }
    public function showRegister()
    {

        return view('Auth.register');
    }
    public function logout()
    {
        Session::forget('username');
        Auth::logout();

        // Chuyển hướng người dùng về trang chủ hoặc trang đăng nhập (tùy chọn)
        return redirect('/');
    }
}
