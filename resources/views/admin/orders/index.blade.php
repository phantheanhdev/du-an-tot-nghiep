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
                {{--  --}}
                <nav>
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <button class="nav-link active" id="nav-home-tab" data-toggle="tab" data-target="#nav-home"
                            type="button" role="tab" aria-controls="nav-home"aria-selected="true">Đơn hàng</button>
                        <button class="nav-link" id="nav-profile-tab" data-toggle="tab" data-target="#nav-profile"
                            type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Đơn hàng đã hoàn thành</button>
                    </div>
                </nav>
                <div class="tab-content" id="nav-tabContent">
                    {{-- đơn đến --}}
                    <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                        <div class="col-md-12">
                            <div class="row table-responsive" id="nonPayOrder">
                                <table class="table table-hover text-center">
                                    @if (isset($order) && count($order) > 0)
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
                                            @foreach ($order as $order)
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
                                                    <td>{{ $order->customer_name}}</td>
                                                    <td>{{ $order->note }}</td>
                                                    <td>{{ $order->created_at }}</td>
                                                    <th>
                                                        @if ($order->status == 0)
                                                            <span>Chờ xác nhận </span>
                                                        @endif
                                                    </th>
                                                    <td>
                                                        <form
                                                            action="{{ route('admin.orders.updateStatus', ['id' => $order->id]) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('PATCH')
                                                            @if ($order->status == 0)
                                                                <button type="submit" name="status" value="1"
                                                                    class="btn btn-success btn-sm">Xác nhận</button>
                                                                <button type="submit" name="status" value="2"
                                                                    class="btn btn-danger btn-sm">Hủy</button>
                                                            @endif
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    @else
                                        <div class="alert alert-danger" role="alert">
                                            Bạn không có đơn đặt hàng mới.
                                        </div>
                                    @endif
                                </table>
                            </div>
                        </div>
                    </div>
                    {{-- đã thanh toán --}}
                    <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                        <div class="col-md-12">
                            <div class="row table-responsive" id="nonPayOrder">
                                <table class="table table-hover">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>#</th>
                                            <th>Tên bàn</th>
                                            <th>Tổng tiền</th>
                                            <th>Ghi chú</th>
                                            <th>Trạng thái</th>
                                            <th>Tên khách hàng</th>
                                            <th>Chức năng</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($orders as $key => $item)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>
                                                    {{ $item->table->name }}
                                                </td>
                                                <td>{{ $item->total_price }}</td>
                                                <td>{{ $item->note }}</td>
                                                <td>
                                                    @if ($item->status == 2)
                                                        <span>Hủy</span>
                                                    @elseif ($item->status == 5)
                                                        <span>Đã ra thanh toán</span>
                                                    @endif
                                                </td>
                                                <td>{{ $item->customer_name }}</td>
                                                <th>
                                                    {{-- <a href="{{ url('invoice/' . $item->id . '/generate') }}"
                                        class="btn btn-primary btn-sm float-end mx-1"><i class="fa-solid fa-download"></i>
                                        Dowload Invoice
                                    </a> --}}
                                                    <a href="{{ url('invoice/' . $item->id) }}"
                                                        class="btn btn-warning btn-sm float-end mx-1"><i
                                                            class="fa-solid fa-eye"></i>
                                                    </a>
                                                    <a href=""class="btn btn-warning btn-sm float-end mx-1">
                                                        <i class="fa-solid fa-trash-can"></i>
                                                    <a href=""></a>
                                                    {{-- <a href="{{ url('print_order/' . $item->id) }}"
                                        class="btn btn-primary btn-sm float-end mx-1"><i class="fas fa-print"></i>
                                        Print Invoice
                                    </a> --}}

                                                </th>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        {{-- {{ $orders->links() }} --}}
                    </div>
                </div>



                {{--  --}}

            </div>
        </div>
    </div>
@endsection
