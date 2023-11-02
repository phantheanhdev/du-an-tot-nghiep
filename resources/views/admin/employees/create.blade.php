@extends('admin.layout.content')

@section('main-content')
    <div class="col-md-9">
        <div class="ibox float-e-margins" id="boxOrder">
            <div class="ibox-content">
                <h3 class="text-qr Rest-dark text-center p-2">
                    <a href="{{ route('employee.index')}}" class="btn btn-outline btn-primary btn-sm float-left">
                        <i class="fa fa-long-arrow-left mt-1"></i>
                    </a>
                   Thêm nhân viên
                </h3>
                <hr>
                <form method="POST" action="{{ route('employee.create') }}" enctype="multipart/form-data" id="create_categories">

                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Tên nhân viên</label>
                        <input type="text" name="name" class="form-control"  value="{{ old('name') }}">
                        @error('name')
    <span class="text-danger">{{ $message }}</span>
@enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Số điện thoại</label>
                        <input type="text" name="phone" class="form-control" value="{{ old('phone') }}">
                        @error('phone')
    <span class="text-danger">{{ $message }}</span>
@enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Địa chỉ cư trú</label>
                        <input type="text" name="address" class="form-control" value="{{ old('address') }}">
                        @error('address')
    <span class="text-danger">{{ $message }}</span>
@enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Ví trí làm việc</label>
                        <input type="text" name="position" class="form-control" value="{{ old('position') }}">
                      @error('position')
    <span class="text-danger">{{ $message }}</span>
@enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Ca làm việc</label>
                        <select class="form-control" name="shift">
                            <option value="Ca 1(8h-13h)">Ca 1(8h-13h)</option>
                            <option value="Ca 2(13h-18h)">Ca 2(13h-18h)</option>
                            <option value="Ca 3(18h-23h)">Ca 3(18h-23h)</option>
                          </select>
                          @error('shift')
                          <span class="text-danger">{{ $message }}</span>
                      @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Lương/1h</label>
                        <input type="number" name="salary" class="form-control" value="{{ old('salary') }}">
                        @error('salary')
    <span class="text-danger">{{ $message }}</span>
@enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Ngày tuyển dụng</label>
                        <input type="date" name="hire_date" class="form-control" value="{{ old('hire_date') }}">
                        @error('hire_date')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror

                    </div>

                    <button type="submit" class="btn btn-primary mr-2" id="btn_create_category">Submit</button>
                    <button type="reset" class="btn btn-primary">Reset</button>
                </form>
            </div>
        </div>
    </div>
@endsection
