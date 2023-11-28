@extends('admin.layout.content')

@section('main-content')
    <div class="col-md-9">
        <div class="ibox float-e-margins" id="boxOrder">
            <div class="ibox-content">
                <h3 class="text-qr Rest-dark text-center p-2">
                    <a href="{{ route('employee.index')}}" class="btn btn-outline btn-primary btn-sm float-left">
                        <i class="fa fa-long-arrow-left mt-1"></i>
                    </a>
                    Cập nhập nhân viên
                </h3>
                <hr>
                <form method="POST" action="{{ route('employee.edit',['id'=>$employee->id]) }}" enctype="multipart/form-data" id="create_categories">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Tên nhân viên</label>
                        <input type="text" name="name" class="form-control" value="{{ $employee->name }}" >
                        @error('name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Số điện thoại</label>
                        <input type="text" name="phone" class="form-control" value="{{ $employee->phone }}" >
                        @error('phone')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Địa chỉ</label>
                        <input type="text" name="address" class="form-control" value="{{ $employee->address }}" >
                        @error('address')
    <span class="text-danger">{{ $message }}</span>
@enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Vị trí</label>
                        <input type="text" name="position" class="form-control" value="{{ $employee->position }}" >
                        @error('position')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                    </div> <div class="mb-3">
                        <label class="form-label">Ca làm việc</label>
                        <select class="form-control" name="shift" >
                            <option {{$employee->shift == 'Ca 1(8h-13h)' ? "selected" : ""}}  value="Ca 1(8h-13h)">Ca 1(8h-13h)</option>
                            <option {{$employee->shift == 'Ca 2(13h-18h)' ? "selected" : ""}}  value="Ca 2(13h-18h)">Ca 2(13h-18h)</option>
                            <option {{$employee->shift == 'Ca 3(18h-23h)' ? "selected" : ""}}  value="Ca 3(18h-23h)">Ca 3(18h-23h)</option>
                          </select>
                          @error('shift')
                          <span class="text-danger">{{ $message }}</span>
                      @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Ngày tuyển dụng</label>
                        <input type="date" name="hire_date" class="form-control" value="{{ $employee->hire_date }}" >
                        @error('hire_date')
    <span class="text-danger">{{ $message }}</span>
@enderror

                    </div>

                    <button type="submit" class="btn btn-primary mr-2" id="btn_create_category">Cập nhập</button>
                    <button type="reset" class="btn btn-primary">Tạo lại</button>
                </form>
            </div>
        </div>
    </div>
@endsection
