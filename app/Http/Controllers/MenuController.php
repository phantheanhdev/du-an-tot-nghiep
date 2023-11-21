<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Cookie\CookieJar;
use Illuminate\Http\Request;
use Illuminate\Cookie\CookieServiceProvider;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cookie;

class MenuController extends Controller
{



    public function index(Request $request)
    {
        $tableId = $_GET['tableId'];
        $tableNo = $_GET['tableNo'];
        $categories = Category::all();
        $productsByCategory = [];
        // $cookie_name = $request->input('customer_name');

        foreach ($categories as $category) {
            $products = Product::where('category_id', $category->id)->get();
            $productsByCategory[$category->category_name] = $products;
        }
        $phone = session('phone');


        return view("user.order.menu", [
            'tableId' => $tableId,
            'tableNo' => $tableNo,
            'productsByCategory' => $productsByCategory,
            'phone' => $phone
        ]);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
