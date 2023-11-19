<?php

namespace App\Http\Controllers;

use App\Models\Table;
use App\Models\Order;
use App\Models\Product;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Symfony\Component\VarDumper\VarDumper;
use Barryvdh\DomPDF\Facade\Pdf;

class TableController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // lấy bảng table và sắp xếp theo id từ lớn -> bé
        $all_table = Table::orderBy('id', 'desc')->get();

        return view('admin.table.index', ['all_table' => $all_table]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.table.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate
        $validate = $request->validate([
            'name' => 'required',
            'type' => 'required|integer',
        ]);

        // Lấy dữ liệu từ form
        $name = $request->input('name');
        $type = $request->input('type');

        // Kiểm tra xem giá trị $name đã tồn tại trong cột 'name' của bảng 'table' hay chưa
        $nameExists = Table::where('name', $name)->exists();

        if ($nameExists) {
            // Nếu $name đã tồn tại, redirect với thông báo lỗi
            $notification = [
                'message' => 'Tên bàn đã tồn tại. Vui lòng chọn tên khác',
                'alert-type' => 'error',
            ];
            return redirect()->route('table.create')->withInput()->with($notification);
        }

        // Lấy id lớn nhất và tạo mới 1 id để gán vào link
        $id = Table::max('id');
        $new_id = $id + 1;

        $data = [
            'name' => $name,
            'type' => $type,
            'qr' => 'https://chart.googleapis.com/chart?chs=250x250&cht=qr&chl=http://127.0.0.1:8000/foodie?tableId=' . $new_id . '%26tableNo=' . $name,
        ];

        try {
            Table::create($data);

            $notification = [
                'message' => 'Thêm bàn thành công',
                'alert-type' => 'success',
            ];

            return redirect()->route('table.index')->with($notification);
        } catch (\Throwable $th) {
            $notification = [
                'message' => 'Thêm bàn thất bại',
                'alert-type' => 'failse',
            ];

            return redirect()->route('table.create')->with($notification);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Table $table)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Table $table)
    {

        return view('admin.table.edit', ['table' => $table]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Table $table)
    {
        $validate = $request->validate([
            'name' => 'required',
            'type' => 'required|integer',
        ]);

        // Lấy dữ liệu từ form
        $name = $request->input('name');
        $type = $request->input('type');

        // Kiểm tra xem giá trị $name đã tồn tại trong cột 'name' của bảng 'table' (ngoại trừ bản ghi đang được cập nhật) hay chưa
        $nameExists = Table::where('name', $name)
            ->where('id', '<>', $table->id)
            ->exists();

        if ($nameExists) {
            // Nếu $name đã tồn tại (ngoại trừ bản ghi đang được cập nhật), redirect với thông báo lỗi
            $notification = [
                'message' => 'Tên bàn đã tồn tại. Vui lòng chọn tên khác',
                'alert-type' => 'error',
            ];
            return redirect()->route('table.edit', $table->id)->withInput()->with($notification);
        }

        $data = [
            'name' => $name,
            'type' => $type,
            'qr' => 'https://chart.googleapis.com/chart?chs=250x250&cht=qr&chl=http://127.0.0.1:8000/foodie?tableId=' . $table->id . '%26tableNo=' . $name
        ];

        try {
            $table->update($data);

            $notification = [
                'message' => 'Đã sửa thông tin bàn thành công',
                'alert-type' => 'success',
            ];

            return redirect()->route('table.index')->with($notification);
        } catch (\Throwable $th) {
            $notification = [
                'message' => 'Sửa thông tin bàn thất bại',
                'alert-type' => 'failse',
            ];

            return redirect()->route('table.index')->with($notification);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Table $table)
    {
        try {
            $table->delete();

            $notification = array(
                "message" => "Xóa bàn thành công",
                "alert-type" => "success",
            );

            return redirect()->route('table.index')->with($notification);
        } catch (\Throwable $th) {
            $notification = array(
                "message" => "Xóa bàn thất bại",
                "alert-type" => "failse",
            );

            return redirect()->route('table.index')->with($notification);
        }
    }

    // trang đầu tiên khi chuyển hướng về admin
    public function restaurant_manager()
    {
        $tables = Table::with('orders')->get();
        return view('admin.restaurant-manager', ['tables' => $tables]);
    }

    // trang chi tiết order nhận của từng bàn
    public function order_of_table($id)
    {
        $table = Table::findOrFail($id);

        $orders = Order::where('table_id', $id)
            ->whereIn('status', [0,1,3,4])
            ->get();
        foreach ($orders as $order) {
            $order->orderDetails = OrderDetail::where('order_id', $order->id)->get();

            foreach ($order->orderDetails as $orderDetail) {
                $orderDetail->product = Product::find($orderDetail->product_id);
            }
        }

        return view('admin.order-of-table', ['table' => $table, 'orders' => $orders]);
    }
    public function updateStatus(Request $request, $id)
    {
        $order = Order::findOrFail($id);

        $newStatus = $request->input('status');

        // Kiểm tra xem trạng thái mới hợp lệ hay không
        if (!in_array($newStatus, [0,1,2,3,4,5])) {
            return redirect()->back()->with('error', 'Invalid status.');
        }

        $order->status = $newStatus;
        $order->save();

        return redirect()->back()->with('success', 'Status updated successfully.');
    }
}
