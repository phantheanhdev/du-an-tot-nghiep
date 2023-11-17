<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    public function index()
    {

        $order = $this->order->where('status',0)->get();
        $orders = $this->order->whereIn('status',[2,5])->get();
        return view('admin.orders.index',[
            'order'=>$order,
            'orders'=>$orders
        ])->with('i',(request()->input('page',1)-1)*10);
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

    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $orders = Order::findOrFail($request->id);
        $orders->delete();
    }

    public function updateOrderStatus(Request $request){
        $order = Order::findOrFail($request->id);
        $order->status = $request->status;
        $order->save();
        return response(['message' => 'Bạn đã cập nhập thành công']);
    }

    public function viewInvoice(string $id){
        $order  = Order::findOrFail($id);
        $todayDate = Carbon::now('Asia/Ho_Chi_Minh');
        $bill = OrderDetail::where('order_id',$id)->get();
        return view('admin.invoice.generate_invoice',[
            'order'=>$order,
            'bill'=>$bill,
            'todayDate' =>$todayDate

        ]);
    }

    public function genarateInvoice(string $id)
    {
        $order = Order::findOrFail($id);
        $todayDate = Carbon::now('Asia/Ho_Chi_Minh');
        $bill = OrderDetail::where('order_id',$id)->get();
        $pdf = Pdf::loadView('admin.invoice.print_invoice',[
            'order'=>$order,
            'bill'=>$bill,
            'todayDate' =>$todayDate
        ]);
        return $pdf->download('invoice-'.$order->id.'-'.$todayDate.'pdf');
    }

    public function print_order(string $id){
        $order = Order::findOrFail($id);
        $todayDate = Carbon::now('Asia/Ho_Chi_Minh');
        $bill = OrderDetail::where('order_id',$id)->get();
        $pdf = Pdf::loadView('admin.invoice.print_invoice',[
            'order'=>$order,
            'bill'=>$bill,
            'todayDate' =>$todayDate
        ]);
        return $pdf->stream();
    }

}
