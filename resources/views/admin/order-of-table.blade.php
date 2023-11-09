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
            <h3 class="text-qrRest-dark text-center">
                <a href="{{ route('restaurant-manager') }}" class="btn btn-outline btn-primary btn-sm float-left"><i class="fa fa-long-arrow-left mt-1"></i>
                </a>
                Bàn số : {{ $table->name }}
            </h3>
            <hr />
            <input hidden value="Completed" id="lblCompleted" />
            <input hidden value="2" id="txtTableId" />

            <div class="col-md-12">
                <div class="row table-responsive" id="nonPayOrder">
                    <table class="table table-hover">
                        <thead class="thead-dark">
                            <tr>
                                <th>Bàn</th>
                                <th>Sản phẩm</th>
                                <th>Ghi chú </th>
                                <th>Thời Gian </th>
                                <th>Trạng Thái</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($orders as $order)
                            <tr>
                                <td>{{ $order->table_id }}</td>
                                <td>
                                    <ul style="list-style: none; padding: 0;">
                                        @foreach($order->orderDetails as $orderDetail)
                                        <li>
                                           {{ $orderDetail->quantity }}     x     {{ $orderDetail->product->name }}
                                        </li>
                                        @endforeach
                                    </ul>
                                </td>
                                <td>{{ $order->note }}</td>
                                <td>{{ $order->created_at }}</td>
                                <td>
                                    <form action="{{ route('admin.orders.updateStatus', ['id' => $order->id]) }}" method="POST">
                                        @csrf
                                        @method('PATCH')

                                        @if ($order->status === 'Xác Nhận')
                                        <button type="submit" name="status" value="Đã Xác Nhận" class="btn btn-success btn-sm">Xác nhận</button>
                                        <button type="submit" name="status" value="Hủy" class="btn btn-danger btn-sm">Hủy</button>
                                        @elseif ($order->status === 'Đã Xác Nhận')
                                        <div class="bg-warning fs-1 rounded"><span >Đã Xác Nhận </span></div>
                                        @elseif ($order->status === 'Hủy')
                                        <div class="bg-danger fs-1 rounded"><span >Đã hủy</span></div>
                                        @elseif ($order->status === 'Đã Thanh Toán')
                                        <div class="bg-success fs-1 rounded"><span >Đã Thanh Toán </span></div>
                                        @endif
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-end pt-3">
                        <p style="font-size: 20px; font-weight: bold; padding: 5px; margin-right: 10px;" class="fs-1 fw-bold">Tổng Tiền: </p><span style="font-size: 20px; padding-top: 5px ;">{{$order->total_price}} VNĐ</span>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection