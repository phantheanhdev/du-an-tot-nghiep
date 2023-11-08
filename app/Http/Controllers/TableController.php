<?php

namespace App\Http\Controllers;

use App\Models\Table;
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
        //validate
        $validate = $request->validate([
            'name' => 'required',
            'type' => 'required|integer',
        ]);

        // lấy dữ liệu từ form
        $name = $request->input('name');
        $type = $request->input('type');

        //lấy id lớn nhất và tạo mới 1 id để gán vào link
        $id = Table::max('id');
        $new_id = $id + 1;

        $data = [
            'name' => $name,
            'type' => $type,
            'qr' => 'https://chart.googleapis.com/chart?chs=250x250&cht=qr&chl=http://127.0.0.1:8000?tableId=' . $new_id . '%26tableNo=' . $name
        ];
        try {
            Table::create($data);

            $notification = array(
                "message" => "Thêm bàn thành công",
                "alert-type" => "success",
            );

            return redirect()->route('table.index')->with($notification);
        } catch (\Throwable $th) {
            $notification = array(
                "message" => "Thêm bàn không thành công",
                "alert-type" => "failse",
            );

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

        // lấy dữ liệu từ form
        $name = $request->input('name');
        $type = $request->input('type');

        $data = [
            'name' => $name,
            'type' => $type,
            'qr' => 'https://chart.googleapis.com/chart?chs=250x250&cht=qr&chl=http://127.0.0.1:8000?tableId=' . $table->id . '%26tableNo=' . $name
        ];

        try {
            $table->update($data);

            $notification = array(
                "message" => "Sửa thông tin bàn thành công",
                "alert-type" => "success",
            );

            return redirect()->route('table.index')->with($notification);
        } catch (\Throwable $th) {
            $notification = array(
                "message" => "Sửa thông tin bàn không thành công",
                "alert-type" => "failse",
            );

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
                "message" => "Xóa bàn không thành công",
                "alert-type" => "failse",
            );

            return redirect()->route('table.index')->with($notification);
        }
    }

    // trang đầu tiên khi chuyển hướng về admin
    public function restaurant_manager()
    {
        $tables = Table::all();
        return view('admin.restaurant-manager', ['tables' => $tables]);
    }

    // trang chi tiết order nhận của từng bàn
    public function order_of_table($id)
    {
        $table = Table::findOrFail($id);

        return view('admin.order-of-table', ['table' => $table]);
    }
}
