<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class EmployeeController extends Controller
{
    public function index() {
        $employees = Employee::all();
        return view('admin.employees.index',compact('employees'));
    }

    public function create(Request $request){
        if($request->isMethod('post')){
            $validator = Validator::make($request->all(), [
                'name' => 'required|unique:employees',
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

            $employee = Employee::create($request->except('_token'));
            if($employee->id) {
                $notification = array(
                    "message" => "Add staff successfully",
                    "alert-type" => "success",
                );
                return redirect()->route('employee.index')->with($notification);
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
                $notification = array(
                    "message" => "Update staff successfully",
                    "alert-type" => "success",
                );
                return redirect()->route('employee.index')->with($notification);
            }
        }
        return view('admin.employees.edit',compact('employee'));
    }

    public function delete($id) {
        if($id){
        $employee = Employee::find($id);
        if($employee->delete()){
            $notification = array(
                "message"=> "Delete staff successfully",
                "alert-type" =>"success",
            );
            return redirect()->route('employee.index')->with($notification);
        }else{
            $notification = array(
                "message"=> "Delete staff fail",
                "alert-type" =>"success",
            );
            return redirect()->back()->with($notification);
        }
    }
return;
    }
}
