@extends('admin.layout.content')
@section('main-content')
    <div class="col-md-9">

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
                    Quản lý bàn
                    <a href="{{ route('table.create') }}" class="float-right">
                        <button class="btn btn-primary">Thêm bàn</button>
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
                                    <th>Tên</th>
                                    <th>Loại bàn</th>
                                    <th>QR</th>
                                    <th>Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($all_table as $table)
                                    <tr>
                                        <td>{{ $table->name }}</td>
                                        <td>{{ $table->type }}</td>
                                        <td>
                                            <img src="{{ $table->qr }}" alt="" width="100" height="100">
                                        </td>
                                        <td class="">
                                            <div class="d-flex justify-content-around align-items-center">
                                                <a href="{{ $table->qr }}">
                                                    <button class="btn btn-info">Tải QR</button>
                                                </a>
                                                <a href="{{ route('table.edit', $table->id) }}">
                                                    <button class="btn btn-secondary">Sửa</button>
                                                </a>
                                                <form action="{{ route('table.destroy', $table->id) }}" method="post"
                                                    id="table-form-delete">
                                                    @csrf
                                                    @method('DELETE')

                                                    <button class="btn btn-primary" type="submit"
                                                        id="table-btn-delete">Xóa</button>
                                                </form>
                                            </div>
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
