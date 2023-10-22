<?php

namespace App\Http\Controllers;

use App\Models\Table;
use Illuminate\Http\Request;
use Symfony\Component\VarDumper\VarDumper;

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
            'qr' => 'https://api.qrserver.com/v1/create-qr-code/?data=http://127.0.0.1:8000?id=' . $new_id . '?table_name=' . $name . '&amp;size=200x200'
        ];

        Table::create($data);

        return redirect()->route('table.index')->with(session()->flash('alert', 'Thêm bàn thành công'));
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Table $table)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Table $table)
    {
        $table->delete();

        return redirect()->route('table.index')->with(session()->flash('alert', 'Xóa bàn thành công'));
    }

    // trang đầu tiên khi chuyển hướng về admin
    public function restaurant_manager()
    {
        return view('admin.restaurant-manager');
    }
}
