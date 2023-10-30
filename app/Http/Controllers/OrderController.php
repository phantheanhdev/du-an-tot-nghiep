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

        $orders =  $this->order->paginate(10);
        $orders->load([
            'table'
        ]);
        return view('admin.orders.index', compact('orders'))->with('i',(request()->input('page',1)-1)*10);
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
    public function destroy(Order $order)
    {
        //
    }

    public function viewInvoice(string $id){
        $order  = Order::findOrFail($id);
        $bill = OrderDetail::findOrFail($id);
        $order->load([
            'table'
        ]);
        $bill->load([
            'product'
        ]);
        return view('admin.invoice.generate_invoice',[
            'order'=>$order,
            'bill'=>$bill

        ]);
    }

    public function genarateInvoice(string $id)
    {
        $order = Order::findOrFail($id);
        $data = ['orders' => $order];
        $todayDate = Carbon::now()->format('d-m-Y');
        $pdf = Pdf::loadView('admin.invoice.generate_invoice',$data);
        return $pdf->download('invoice-'.$order->id.'-'.$todayDate.'pdf');
    }

    public function print_order(string $id){
        $order = Order::findOrFail($id);
        $data = ['orders' => $order];
        $todayDate = Carbon::now()->format('d-m-Y');
        $pdf = Pdf::loadView('admin.invoice.generate_invoice',$data);
        return $pdf->stream();
    }
}
