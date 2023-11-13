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
    /**
     * Display a listing of the resource.
     */
    // public function __construct( Request $request)
    // {
    //     if($request->hasCookie('customer_name')){
    //             $table = $_GET['tableNo'];
    //             return redirect()->route('order.menu','tableNo='.$table);
    //         }
    // }
    public function index(Request $request)
    {
        $table_name = $_GET['tableNo'];
        $table_id = $_GET['tableId'];
        $categories = Category::all();
        $productsByCategory = [];
        $cookie_name = $request->input('customer_name');

        foreach ($categories as $category) {
            $products = Product::where('category_id', $category->id)->get();
            $productsByCategory[$category->category_name] = $products;
        }
        $customer_name = Cookie::get('customer_name');
        // dd($productsByCategory);
        return view("user.order.menu", [
            'table_name' => $table_name,
            'productsByCategory' => $productsByCategory,
            'customer_name' => $customer_name
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
