@extends('admin.layout.content')
@section('main-content')
    <div class="col-md-9">
        @include('error')
        <div class="ibox float-e-margins" id="boxOrder">
            <div class="ibox-content">
                <div class="sk-spinner sk-spinner-wave">
                    <div class="sk-rect1"></div>
                    <div class="sk-rect2"></div>
                    <div class="sk-rect3"></div>
                    <div class="sk-rect4"></div>
                    <div class="sk-rect5"></div>
                </div>
                <h3 class="text-qr Rest-dark text-center p-2">
                    <a href="/restaurant-manager" class="btn btn-outline btn-primary btn-sm float-left">
                        <i class="fa fa-long-arrow-left mt-1"></i>
                    </a>
                    Nhân viên
                    <a href="{{ route('employee.create') }}" class="float-right">
                        <button class="btn btn-primary">+ Thêm nhân viên</button>
                    </a>

                </h3>
                <hr />
                <input hidden value="Completed" id="lblCompleted" />
                <input hidden value="2" id="txtTableId" />

                <div class="col-md-12">
                    <div class="row table-responsive" id="nonPayOrder">
                        <table class="table table-hover">
                            <thead class="thead-dark">
                                <tr>
                                    <th>#</th>
                                    <th>Tên nhân viên</th>
                                    <th>Số điện thoại</th>
                                    <th>Địa chỉ</th>
                                    <th>Vị trí</th>
                                    <th>Ca làm việc</th>
                                    <th>Lương / 1h</th>
                                    <th>Ngày tuyển dụng</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($employees as $key => $item)
                                    <tr>
                                        <td>{{$key +1}}</td>
                                        <td>{{$item->name}}</td>
                                        <td>{{$item->phone}}</td>
                                        <td>{{$item->address}}</td>
                                        <td>{{$item->position}}</td>
                                        <td> {{$item->shift}} </td>
                                        <td>${{$item->salary}} / 1h</td>
                                        <td>{{$item->hire_date}}</td>
                                        <td class="d-flex justify-content-center">
                                            <a id="edit" class="px-2" href="{{ route('employee.edit', ['id' => $item->id]) }}">
                                                <button class="btn btn-success">
                                                    <i class="fa-solid fa-pen"></i>
                                                </button>
                                            </a>
                                            <a id="delete" href="{{ route('employee.delete', ['id' => $item->id]) }}">
                                                <button class="btn btn-danger">
                                                    <i class="fa-solid fa-trash-can"></i>
                                                </button>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection





