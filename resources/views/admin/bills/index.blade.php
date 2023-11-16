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
                </h3>
                <hr />
                <input hidden value="Completed" id="lblCompleted" />
                <input hidden value="2" id="txtTableId" />

                <div class="col-md-12">
                    <div class="row table-responsive" id="nonPayOrder">
                        <table class="table table-hover text-center">

                            <thead class="thead-dark text-center">
                                <tr>
                                    <th>Bàn</th>
                                    <th>Sản phẩm</th>
                                    <th>Tên khách hàng</th>
                                    <th>Ghi chú </th>
                                    <th>Thời Gian </th>
                                    <th>Trạng Thái</th>
                                    <th>Chức năng</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $order)
                                    <tr>
                                        <td>{{ $order->table_id }}</td>
                                        <td>
                                            <ul style="list-style: none; padding: 0;">
                                                @foreach ($order->orderDetails as $orderDetail)
                                                    <li>
                                                        {{ $orderDetail->quantity }} x
                                                        {{ $orderDetail->product->name }}
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </td>
                                        <td>{{$order->customer_name}}</td>
                                        <td>{{ $order->note }}</td>
                                        <td>{{ $order->created_at }}</td>
                                        <th>
                                            @if ($order->status == 1)
                                                <span>Đã xác nhận </span>
                                            @elseif ($order->status == 3)
                                                <span>Đang chuẩn bị</span>
                                            @elseif ($order->status == 4)
                                                <span>Đã giao món</span>
                                            @endif
                                        </th>
                                        <td>
                                            <form action="{{ route('admin.orders.updateStatus', ['id' => $order->id]) }}"
                                                method="POST">
                                                @csrf
                                                @method('PATCH')
                                                @if ($order->status == 1)
                                                    <button type="submit" name="status" value="3"
                                                        class="btn btn-success btn-sm">Đang chuẩn bị</button>
                                                @elseif ($order->status == 3)
                                                    <button type="submit" name="status" value="4"
                                                        class="btn btn-success btn-sm">Đã giao món</button>
                                                @else
                                                    <button type="" name="status" value="4"
                                                        class="btn btn-success btn-sm">Chờ thanh toán</button>
                                                @endif

                                            </form>
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
