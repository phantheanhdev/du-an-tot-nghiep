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
use App\Models\Coupon;
use App\Models\OrderDetail;
use Illuminate\Support\Facades\Session;

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
            session()->flash('success', 'Product removed successfully');
        }
    }

    public function addToCart($id)
    {
        $product = Product::findOrFail($id);

        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                "id" => $product->id,
                "name" => $product->name,
                "quantity" => 1,
                "price" => $product->price,
                // "image" => $product->image
            ];
        }

        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Product added to cart successfully!');
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


    public function applyCoupon(Request $request)
    {
        if ($request->coupon_code === null) {
            return response(['status' => 'error', 'message' => 'Coupon filed is required']);
        }
        $coupon = Coupon::where(['code' => $request->coupon_code, 'status' => 1])->first();
        if ($coupon === null) {
            return response(['status' => 'error', 'message' => 'Coupon not exist!']);
        } else if ($coupon->start_date > date('Y-m-d')) {
            return response(['status' => 'error', 'message' => 'Coupon not exist!']);
        } else if ($coupon->end_date < date('Y-m-d')) {
            return response(['status' => 'error', 'message' => 'Coupon is expired']);
        } else if ($coupon->total_used >= $coupon->quantity) {
            return response(['status' => 'error', 'message' => 'you can not apply this coupon']);
        }

        if ($coupon->discount_type === 'amount') {
            Session::put('coupon', [
                'coupon_name' => $coupon->name,
                'coupon_code' => $coupon->code,
                'discount_type' => 'amount',
                'discount' => $coupon->discount
            ]);
        } else if ($coupon->discount_type === 'percent') {
            Session::put('coupon', [
                'coupon_name' => $coupon->name,
                'coupon_code' => $coupon->code,
                'discount_type' => 'percent',
                'discount' => $coupon->discount
            ]);
        }
        return response(['status' => 'success', 'message' => 'Coupon applied successfully!']);
    }

    public function couponCalculation()
    {
        if (Session::has('coupon')) {
            $coupon = Session::get('coupon');
            $subTotal = getTotalCart();
            if ($coupon['discount_type'] === 'amount') {
                if ($coupon['discount'] >= getTotalCart()) {
                    $total =  0;
                    return response(['status' => 'success', 'cart_total' => $total, 'discount' => $coupon['discount']]);
                } else {
                    $total = $subTotal - $coupon['discount'];
                    return response(['status' => 'success', 'cart_total' => $total, 'discount' => $coupon['discount']]);
                }
            } else if ($coupon['discount_type'] === 'percent') {
                $discount = $subTotal - ($subTotal * $coupon['discount'] / 100);
                $total = $subTotal - $discount;
                return response(['status' => 'success', 'cart_total' => $total, 'discount' => $discount]);
            }
        } else {
            $total = getTotalCart();
            return response(['status' => 'success', 'cart_total' => $total, 'discount' => 0]);
        }
    }

    public function cencelCoupon()
    {
        if (Session::has('coupon')) {
            session()->forget('coupon');
            $total = getTotalCart();
            return response(['status' => 'success','message' => 'Voucher canceled successfully!' ,  'cart_total' => $total, 'discount' => 0]);
        }
    }
}
