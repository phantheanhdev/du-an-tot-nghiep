<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home()
    {
        return view('user.home');
    }

    public function form_infor_user(){
        $table = $_GET['tableNo'];
        return view('user.form_infor_user',['table'=> $table]);
    }
}
