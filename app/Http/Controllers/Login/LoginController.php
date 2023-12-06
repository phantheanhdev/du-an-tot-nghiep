<?php

namespace App\Http\Controllers\Login;

use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;


class LoginController extends Controller
{
    //
    public function login(Request $request)
    {
        if ($request->isMethod('POST')) {
            $this->validate($request, [
                'username' => 'required',
                'password' => 'required|min:6',
            ], [
                'username.required' => 'Vui lòng nhập tên đăng nhập.',
                'password.required' => 'Vui lòng nhập mật khẩu .',
                'password.min' => 'Mật khẩu mới phải có ít nhất 6 ký tự.',
            ]);
            if (Auth::attempt(['username' => $request->username, 'password' => $request->password])) //đăng nhập thành công
            {
                Session::put('username', $request->username);
                return redirect('/')->with(session()->flash('alert', 'Đăng nhập thành công'));
            } else {
                return redirect()->back()->withErrors(['password' => 'Không đúng tên đăng nhập hoặc mật khẩu.']);
            }
        }
        return view('login.login');
    }
    public function register(Request $request)
    {
        if ($request->isMethod('POST')) {
            $this->validate($request, [
                'username' => 'required|unique:users',
                'email' => 'required|email|unique:users',
                'password' => 'required',
            ], [
                'username.required' => 'Vui lòng nhập tên đăng nhập.',
                'email.required' => 'Vui lòng nhập email.',
                'email.email' => 'Địa chỉ email không hợp lệ.',
                'email.unique' => 'Email đã được sử dụng.',
                'username.unique' => 'Tên đăng nhập đã tồn tại.',
                'password.required' => 'Vui lòng nhập mật khẩu .',
                'password.min' => 'Mật khẩu mới phải có ít nhất 6 ký tự.',
            ]);

            $user = new User();
            $user->username = $request->input('username');
            $user->role = 2;
            $user->remember_token = Str::random(10);
            $user->email = $request->input('email');
            $user->password = bcrypt($request->input('password'));
            $user->save();


            Auth::login($user);
            return redirect('/');
        }
        return view('login.register');
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
    public function showForm()
    {
        return view('login.change-password');
    }
    public function updatePassword(Request $request)
    {
        // Validation
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:6|different:current_password',
            'confirm_password' => 'required|same:new_password',
        ], [
            'current_password.required' => 'Vui lòng nhập mật khẩu hiện tại.',
            'new_password.required' => 'Vui lòng nhập mật khẩu mới.',
            'new_password.min' => 'Mật khẩu mới phải có ít nhất 6 ký tự.',
            'new_password.different' => 'Mật khẩu mới phải khác mật khẩu hiện tại.',
            'confirm_password.required' => 'Vui lòng nhập lại mật khẩu mới.',
            'confirm_password.same' => 'Mật khẩu xác nhận phải giống với mật khẩu mới.',
        ]);

        // Check if the current password matches the authenticated user's password
        if (Hash::check($request->current_password, auth()->user()->password)) {
            // Update the password
            auth()->user()->update(['password' => Hash::make($request->new_password)]);

            return redirect()->back()->with('success', 'Đổi mật khẩu thành công.');
        } else {
            return redirect()->back()->withErrors(['current_password' => 'Không đúng mật khẩu.']);
        }
    }
}
