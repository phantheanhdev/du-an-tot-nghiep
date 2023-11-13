<?php

namespace App\Http\Controllers;

use CarbonCarbon;
use Carbon\Carbon;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use App\Events\OrderCreated;
use Illuminate\Http\Request;
use App\Http\Requests\OrderRequest;
use App\Http\Requests\StoreCartRequest;
use App\Http\Requests\UpdateCartRequest;
use App\Models\OrderDetail;
use Illuminate\Contracts\Session\Session;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(StoreCartRequest $request)
    {
        //
    }
    public function remove(Request $request)
    {
        if ($request->id) {
            $cart = session()->get('cart');
            if (isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
            return response()->json(['cart' => $cart]);
        }
    }

    public function addToCart($id, Request $request)
    {
        $product = Product::findOrFail($id);

        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['quantity'] += $request->input('quantity', 1);
        } else {
            $cart[$id] = [
                "id" => $product->id,
                "name" => $product->name,
                "quantity" => $request->input('quantity', 1),
                "price" => $product->price,
            ];
        }

        session()->put('cart', $cart);

        // Trả về thông tin giỏ hàng dưới dạng JSON
        return response()->json(['cart' => $cart]);
    }


    public function order(OrderRequest $request)
    {
        $order = new Order();
        $order->table_id = $request->table_id;
        $order->order_day = Carbon::now('Asia/Ho_Chi_Minh');
        $order->total_price = $request->total_price;
        $order->status = 0;
        $order->note = $request->note;
        $order->customer_name = $request->customer_name;
        $order->customer_phone     = 'B';
        $order->save();

        $cart = session()->get('cart');

        foreach ($cart as $item) {
            $productOrder  = new OrderDetail();
            $productOrder->order_id = $order->id;
            $productOrder->product_id = $item['id'];
            $productOrder->quantity  = $item['quantity'];
            $productOrder->total_amount = $item['quantity'] * $item['price'];
            $productOrder->save();
        }

        //id , name , quantity , price

        session()->forget('cart');

        return redirect()->back()->with('success', 'Đặt món thành công');
    }
    public function getCart(Request $request)
    {
        $cart = session()->get('cart', []);
        return response()->json(['cart' => $cart]);
    }
    /**
     * Display the specified resource.
     */
    public function show(Cart $cart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCartRequest $request, Cart $cart)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cart $cart)
    {
        //
    }
}
