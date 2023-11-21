<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use App\Models\Customer;

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
        $request->validate([
            'phone' => 'required|regex:/^[0-9]+$/|min:10|max:10',
        ], [
            'phone.required' => 'Vui lòng nhập số điện thoại.',
            'phone.regex' => 'Số điện thoại chỉ được chứa ký tự số.',
            'phone.min' => 'Số điện thoại phải có ít nhất 10 số.',
            'phone.max' => 'Số điện thoại không được vượt quá 10 số.',
        ]);
        $phone = $request->phone;

        $customer = Customer::firstOrNew(['phone' => $phone]);

        if (!$customer->exists) {
            $customer->save();
        }
        session(['customer' => $customer,'phone' =>$phone]);

        return redirect()->route('order.menu', [
            'tableNo' => $request->tableNo,
            'tableId' => $request->tableId
        ]);
    }
}
