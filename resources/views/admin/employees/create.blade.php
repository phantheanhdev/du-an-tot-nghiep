@extends('admin.layout.content')

@section('main-content')
    <div class="col-md-9">
        <div class="ibox float-e-margins" id="boxOrder">
            <div class="ibox-content">
                <h3 class="text-qr Rest-dark text-center p-2">
                    <a href="/category" class="btn btn-outline btn-primary btn-sm float-left">
                        <i class="fa fa-long-arrow-left mt-1"></i>
                    </a>
                   Thêm nhân viên
                </h3>
                <hr>
                @include('error')
                <form method="POST" action="{{ route('employee.create') }}" enctype="multipart/form-data" id="create_categories">

                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Tên nhân viên</label>
                        <input type="text" name="name" class="form-control">
                        <div class="form-text" id="name" style="color: red"></div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Số điện thoại</label>
                        <input type="text" name="phone" class="form-control">
                        <div class="form-text" id="name" style="color: red"></div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Địa chỉ cư trú</label>
                        <input type="text" name="address" class="form-control">
                        <div class="form-text" id="name" style="color: red"></div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Ví trí làm việc</label>
                        <input type="text" name="position" class="form-control">
                        <div class="form-text" id="name" style="color: red"></div>
                    </div> <div class="mb-3">
                        <label class="form-label">Ca làm việc</label>
                        <input type="text" name="shift" class="form-control">
                        <div class="form-text" id="name" style="color: red"></div>
                    </div> <div class="mb-3">
                        <label class="form-label">Lương/1h</label>
                        <input type="text" name="salary" class="form-control">
                        <div class="form-text" id="name" style="color: red"></div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Ngày tuyển dụng</label>
                        <input type="date" name="hire_date" class="form-control">
                        <div class="form-text" id="note" style="color: red"></div>

                    </div>

                    <button type="submit" class="btn btn-primary mr-2" id="btn_create_category">Submit</button>
                    <button type="reset" class="btn btn-primary">Reset</button>
                </form>
            </div>
        </div>
    </div>
@endsection
