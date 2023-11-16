<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class EmployeeController extends Controller
{
    //
    public function index() {
        $employees = Employee::all();
        return view('admin.employees.index',compact('employees'));
    }

    public function create(Request $request){
        if($request->isMethod('post')){
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'phone' => 'required',
                'address' => 'required',
                'position' => 'required',
                'shift' => 'required',
                'salary' => 'required',
                'hire_date' => 'required',
            ]);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
            $name = $request->input('name');
            $nameExists = Employee::where('name', $name)->exists();

        if ($nameExists) {
            // Nếu $name đã tồn tại, redirect với thông báo lỗi
            $notification = [
                'message' => 'Table name already exists. Please choose another name',
                'alert-type' => 'error',
            ];
            return redirect()->route('employee.create')->withInput()->with($notification);
        }
            $employee = Employee::create($request->except('_token'));
            if($employee->id) {
                Session::flash('success','Thêm nhân viên thành công');
                return redirect()->route('employee.index');
            }
        }
        return view('admin.employees.create');
    }

    public function edit(Request $request, $id){
        $employee = Employee::find($id);
        if($request->isMethod('post')){
            $request->validate([
                'name' => 'required',
                'phone' => 'required',
                'address' => 'required',
                'position' => 'required',
                'shift' => 'required',
                'salary' => 'required',
                'hire_date' => 'required',
            ]);
            $result = Employee::where('id',$id)->update($request->except('_token'));
            if($result){
                Session::flash('success','Cập nhập nhân viên thành công');
                return redirect()->route('employee.index');
            }
        }
        return view('admin.employees.edit',compact('employee'));
    }

    public function delete($id) {
        $employee = Employee::find($id);
        $employee->delete();
        return redirect()->back()->with('success','Xóa nhân viên thành công');
    }
}
