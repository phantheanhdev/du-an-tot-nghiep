<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminDashboardController extends Controller
{
    public function index()
    {
        //Thống kê doanh thu theo ngày - tháng - năm
        $todaysOrder = Order::whereDate('created_at', Carbon::today())->where('status', 2)->count();
        $totalPendingOrders = Order::where('status', 0)->count();

        $todaysEarnings = Order::where('status', 2)
            ->whereDate('order_day', Carbon::today())
            ->sum('total_price');
        $monthEarnings = Order::where('status', 2)
            ->whereMonth('created_at', Carbon::now()->month)
            ->sum('total_price');
        $yearEarnings = Order::where('status', 2)
            ->whereYear('created_at', Carbon::now()->year)
            ->sum('total_price');




        $lastFourDay = DB::table('orders')
            ->select(DB::raw('order_day, SUM(total_price) as total_amount'))
            ->where('order_day', '>=', DB::raw('CURDATE() - INTERVAL 3 DAY'))
            ->groupBy('order_day')
            ->get();

        $data = "";
        foreach ($lastFourDay as $val) {
            $data .= "['" . $val->order_day . "' , " . $val->total_amount . "],";
        }
        $chart_data = $data;
        //////////////////
        $totalCategories = Category::count();
        $totalProducts = Product::count();




        return view('admin.dashboard.index', compact(
            'todaysOrder',
            'totalPendingOrders',
            'todaysEarnings',
            'monthEarnings',
            'yearEarnings',
            'lastFourDay',
            'chart_data',
            'totalCategories',
            'totalProducts'

        ));
    }
}
