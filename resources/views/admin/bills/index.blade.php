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
                    Order Board
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
                                    <th>Order_Id</th>
                                    <th>Product</th>
                                    <th>Quantity</th>
                                    <th>Total_amount</th>
                                    <th>Order_date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($bills as $key => $item)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                         <td>
                                            {{$item->order->id}}
                                        </td>
                                        <td>{{ $item->product_id }}</td>
                                        <td>{{ $item->quantity}}</td>
                                        <td>{{ $item->total_amount}}</td>
                                        <th>{{ $item->created_at}}</th>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{$bills->links()}}
                </div>
            </div>
        </div>
    </div>
@endsection
