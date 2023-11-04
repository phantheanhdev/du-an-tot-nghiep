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
                    Bill Management

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
                                    <th>Table name</th>
                                    <th>Total_price</th>
                                    <th>Note</th>
                                    <th>Status</th>
                                    <th>Customer_name</th>
                                    <th>Customer_phone</th>
                                    <th>Action</th>
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
                                            @if ($item->status == 0)
                                                Pending
                                                @elseif ($item->status == 1)
                                                Order delivered
                                                @elseif ($item->status == 2)
                                                Compeleted
                                            @endif
                                        </td>
                                        <td>{{ $item->customer_name }}</td>
                                        <td>{{ $item->customer_phone }}</td>
                                        <th>
                                            <a href="{{ url('invoice/' . $item->id . '/generate') }}"
                                                class="btn btn-primary btn-sm float-end mx-1"><i class="fa-solid fa-download"></i>
                                                Dowload Invoice
                                            </a>
                                            <a href="{{ url('invoice/' . $item->id) }}"
                                                class="btn btn-warning btn-sm float-end mx-1"><i class="fa-solid fa-eye"></i>
                                                View Invoice
                                            </a>
                                            <a href="{{ url('print_order/' . $item->id) }}"
                                                class="btn btn-primary btn-sm float-end mx-1"><i class="fas fa-print"></i>
                                                Print Invoice
                                            </a>

                                        </th>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{ $orders->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
