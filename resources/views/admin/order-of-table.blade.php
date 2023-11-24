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
                                    <th>Tổng Tiền </th>
                                    <th>Trạng Thái</th>
                                    <th>Hành Động</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders->sortByDesc('created_at') as $order)
                                    <tr>
                                        <td>{{ $order->table_id }}</td>
                                        <td>
                                            <ul style="list-style: none; padding: 0;">
                                                @foreach ($order->orderDetails as $orderDetail)
                                                    <li>
                                                        {{ $orderDetail->quantity }} x {{ $orderDetail->product->name }}
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </td>
                                        <td>
                                            @if (isset($order->note) && !empty($order->note))
                                                {{ $order->note }}
                                            @else
                                                Không Có
                                            @endif
                                        </td>
                                        <td>{{ $order->created_at }}</td>
                                        <td>{{ $order->total_price }} VNĐ</td>
                                        <td>
                                            @if ($order->status == 0)
                                                <div class="bg-warning fs-1 rounded"><span>Chưa xác nhận</span></div>
                                            @elseif ($order->status === 1)
                                                <div class="bg-primary fs-1 rounded"><span>Đã xác nhận</span></div>
                                                <div class="bg-secondary fs-1 rounded mt-2"><a class="text-white" href="{{url('/order-form/'.$order->id)}}">In hóa đơn</a></div>
                                            @elseif ($order->status === 3)
                                                <div class="bg-primary fs-1 rounded"><span>Đang chuẩn bị</span></div>
                                            @elseif ($order->status === 4)
                                                <div class="bg-success fs-1 rounded"><span>Đã ra món</span></div>
                                            @endif
                                        </td>
                                        <td>
                                            <form action="{{ route('admin.orders.updateStatus', ['id' => $order->id]) }}"
                                                method="POST">
                                                @csrf
                                                @method('PATCH')

                                                @if ($order->status == 0)
                                                    <button type="submit" name="status" value="1"
                                                        class="btn btn-info btn-sm">Xác nhận</button>
                                                    <button type="submit" name="status" value="2"
                                                        class="btn btn-danger btn-sm">Hủy</button>
                                                @elseif ($order->status === 1)
                                                    <button type="submit" name="status" value="3"
                                                        class="btn btn-info btn-sm">Đang chuẩn bị</button>
                                                @elseif ($order->status === 3)
                                                    <button type="submit" name="status" value="4"
                                                        class="btn btn-info btn-sm">Đã ra món</button>
                                                @elseif ($order->status === 4)
                                                    <a href="{{ url('print_order/' . $order->id) }}" class="btn btn-outline btn-primary btn-block"> <i class="fa fa-credit-card" style="color: #d35352;"></i>Thanh toán</a>
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
