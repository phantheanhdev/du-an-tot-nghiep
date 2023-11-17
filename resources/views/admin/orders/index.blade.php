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
                            type="button" role="tab" aria-controls="nav-home" aria-selected="true">Orders</button>
                        <button class="nav-link " id="nav-profile-tab" data-toggle="tab" data-target="#nav-profile"
                            type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Completed Orders
                        </button>
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
                                                <th>Table</th>
                                                <th>Product</th>
                                                <th>Total Amount</th>
                                                <th>Customer Name</th>
                                                <th>Note</th>
                                                <th>Clock</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($order as $item)
                                                <tr>
                                                    <td>{{ $item->table_id }}</td>
                                                    <td>
                                                        <ul style="list-style: none; padding: 0;">
                                                            @foreach ($item->orderDetails as $orderDetail)
                                                                <li>
                                                                    {{ $orderDetail->quantity }} x
                                                                    {{ $orderDetail->product->name }}
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    <td>{{ $item->total_price}} </td>
                                                    </td>
                                                    <td>{{ $item->customer_name }}</td>
                                                    <td>{{ $item->note }}</td>
                                                    <td>{{ $item->created_at }}</td>
                                                    <th>
                                                        @if ($item->status == 0)
                                                            <span> Not yet confirmed </span>
                                                        @endif
                                                    </th>
                                                    <td>
                                                        {{-- <form
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
                                                        </form> --}}
                                                        <form action="" method="get">
                                                            <select class="form-control order-status" name="status"
                                                                id="{{ $item->id }}">
                                                                <option value="0"
                                                                    {{ $item->status === 0 ? 'selected' : '' }}>
                                                                     Not yet confirmed
                                                                </option>
                                                                <option value="1"
                                                                    {{ $item->status === 1 ? 'selected' : '' }}>
                                                                    Confirmed
                                                                </option>
                                                                <option value="2"
                                                                    {{ $item->status === 2 ? 'selected' : '' }}>
                                                                    Cancel
                                                                </option>
                                                            </select>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    @else
                                        <div class="alert alert-danger" role="alert">
                                            You have no new orders <i class="fa-solid fa-bell"></i>
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
                                <table id="" class="table table-hover">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>Table </th>
                                            <th>Total Amount</th>
                                            <th>Note</th>
                                            <th>Clock</th>
                                            <th>Status</th>
                                            <th>Customer Name</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($orders as $key => $item)
                                            <tr>
                                                <td>
                                                    {{ $item->table->name }}
                                                </td>
                                                <td>{{ $item->total_price }}</td>
                                                <td>{{ $item->note }}</td>
                                                <td>{{ $item->created_at}}</td>
                                                <td>
                                                    @if ($item->status == 2)
                                                        <span>Cancelled</span>
                                                    @elseif ($item->status == 5)
                                                        <span>Paid</span>
                                                    @endif
                                                </td>
                                                <td>{{ $item->customer_name }}</td>
                                                <th>
                                                    <a href="{{ url('invoice/' . $item->id) }}"
                                                        class="btn btn-warning btn-sm float-end mx-1"><i
                                                            class="fa-solid fa-eye"></i>
                                                    </a>
                                                    <a id="{{ $item->id }}"
                                                        href="#"class="btn btn-warning btn-sm float-end mx-1 deleteIcon">
                                                        <i class="fa-solid fa-trash-can"></i>
                                                    </a>
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
@push('scripts')
    <script>
        $(document).ready(function() {
            $('body').on('change','.order-status', function() {
                let status = $(this).find(':selected').val();
                let id = $(this).attr('id');
                $.ajax({
                    url: '{{ route("order-status") }}',
                    method: 'GET',
                    data: {
                        status: status,
                        id: id
                    },
                    success: function(data) {
                        toastr.success(data.message)
                        window.location.reload()
                    },
                    error: function(xhr, status, error) {
                        console.log(error);
                    }
                })
            })
        })
    </script>


    <script>
        $(document).on('click', '.deleteIcon', function(e) {
            e.preventDefault();
            let id = $(this).attr('id');
            let csrf = '{{ csrf_token() }}';
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '{{ route('detete-order') }}',
                        method: 'delete',
                        data: {
                            id: id,
                            _token: csrf
                        },
                        success: function(response) {
                            console.log(response);
                            Swal.fire(
                                'Deleted!',
                                'Your file has been deleted.',
                                'success'
                            )
                            window.location.reload();

                        }
                    });
                }
            })
        });
    </script>

@endpush
