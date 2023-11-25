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
                Khách hàng
                {{-- <a href="{{ route('create') }}" class="float-right">
                    <button class="btn btn-primary">+ Thêm mới</button>
                </a> --}}
            </h3>
            <hr />
            <input hidden value="Completed" id="lblCompleted" />
            <input hidden value="2" id="txtTableId" />

            <div class="col-md-12">
                <div class="row table-responsive" id="nonPayOrder">
                    <table id="myTable" class="display ">
                        <thead class="thead-dark">
                            <tr>
                                <th>STT</th>
                                <th>Số điện thoại</th>
                                <th>Số lần mua</th>
                                <th>Tổng điểm </th>
                                <th>Hành Động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($customer as $key => $item)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $item->phone }}</td>
                                    <td>{{ $item->orders->count()}}</td>
                                    <td>{{ $item->point }}</td>
                                    <td>
                                        <a id="edit" href="" class="btn btn-warning btn-sm float-end mx-1">
                                            <i class="fa-solid fa-pen"></i>
                                        </a>
                                        <a id="view" href="" class="btn btn-warning btn-sm float-end mx-1">
                                            <i class="fa-regular fa-eye"></i>
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
@push('scripts')
    <script>
        let table = new DataTable('#myTable', {
            responsive: true
        });
    </script>
@endpush
