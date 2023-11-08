<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class HomeController extends Controller
{
    public function home()
    {
        return view('user.home');
    }

    public function form_infor_user()
    {
        $table = $_GET['tableNo'];
        return view('user.form_infor_user', ['table' => $table]);
    }

    public function loginUser(Request $request)
    {
        $table = $request->tableNo;
        $cook = Cookie::make('customer_name', $request->customer_name, 15);
        return redirect()->route('order.menu', 'tableNo=' . $table)->withCookie($cook);
    }
}
