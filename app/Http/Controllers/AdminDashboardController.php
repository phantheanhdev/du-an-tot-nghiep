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
        $todaysOrder = Order::whereDate('created_at', Carbon::today())->count();
        $totalPendingOrders = Order::where('status', 0)->count();
        $totalCompleteOrders = Order::where('status', 5)->count();

        $todaysEarnings = Order::where('status', 5)
            ->whereDate('order_day', Carbon::today())
            ->sum('total_price');
        $monthEarnings = Order::where('status', 5)
            ->whereMonth('created_at', Carbon::now()->month)
            ->sum('total_price');
        $yearEarnings = Order::where('status', 5)
            ->whereYear('created_at', Carbon::now()->year)
            ->sum('total_price');




        $lastFourDay = DB::table('orders')
            ->select(DB::raw('order_day, SUM(total_price) as total_amount'))
            ->where('order_day', '>=', DB::raw('CURDATE() - INTERVAL 4 DAY'))
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




        $statisticsMonth = DB::table('orders')
            ->select(DB::raw('MONTH(created_at) as month, COUNT(*) as total_orders, SUM(total_price) as total_amount'))
            ->where('created_at', '>=', now()->subMonths(6))->where('status', 5) // Lấy thông tin từ 6 tháng trước đến hiện tại
            ->groupBy('month')
            ->get();





        $statisticsYear = DB::table('orders')
            ->select(DB::raw('YEAR(created_at) as year, COUNT(*) as total_orders, SUM(total_price) as total_amount'))
            ->where('created_at', '>=', now()->subYears(3))->where('status', 5) // Lấy thông tin từ 3 năm trước đến hiện tại
            ->groupBy('year')
            ->get();



        return view('admin.dashboard.index', compact(
            'todaysOrder',
            'totalPendingOrders',
            'totalCompleteOrders',
            'todaysEarnings',
            'monthEarnings',
            'yearEarnings',
            'lastFourDay',
            'chart_data',
            'totalCategories',
            'totalProducts',
            'statisticsMonth',
            'statisticsYear'

        ));
    }
}
