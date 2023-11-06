<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $table = $_GET['tableNo'];
        $categories = Category::all();
        $productsByCategory = [];
        $customer_name = $request->input('customer_name');
        foreach ($categories as $category) {
            $products = Product::where('category_id', $category->id)->get();
            $productsByCategory[$category->category_name] = $products;
        }
        return view("user.order.menu",[
            'table' => $table,
             'productsByCategory' => $productsByCategory,
             'customer_name'=>$customer_name
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
