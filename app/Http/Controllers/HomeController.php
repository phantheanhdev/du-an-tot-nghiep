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
        $table_id = $_GET['tableId'];
        $table_no = $_GET['tableNo'];
        return view('user.form_infor_user', [
            'table_id' => $table_id,
            'table_no' => $table_no
        ]);
    }

    public function loginUser(Request $request)
    {
        $tableId = $request->tableId;
        $tableNo = $request->tableNo;
        $cook = Cookie::make('customer_name', $request->customer_name, 20);
        return redirect()->route('order.menu', [
            'tableNo=' . $tableNo,
            'tableId' => $tableId
        ])->withCookie($cook);
    }
}
