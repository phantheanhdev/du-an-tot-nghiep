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
                        <button class="nav-link  active" id="nav-home-tab" data-toggle="tab" data-target="#nav-home"
                            type="button" role="tab" aria-controls="nav-home" aria-selected="true">Đơn đặt
                            hàng</button>
                        <button class="nav-link " id="nav-profile-tab" data-toggle="tab" data-target="#nav-profile"
                            type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Đơn hàng đã hoàn
                            thành
                        </button>
                    </div>
                </nav>
                <div class="tab-content" id="nav-tabContent">
                    {{-- đơn đến --}}
                    <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                        <div class="col-md-12">
                            <div class="card-body mt-3" id="nonPayOrder">
                                <table id="appTable" class="display text-center">
                                    @if (isset($order) && count($order) > 0)
                                        <thead class="">
                                            <tr>
                                                <th>Bàn</th>
                                                <th>Sản phẩm</th>
                                                <th>Tổng cộng</th>
                                                {{-- <th>Khách hàng</th> --}}
                                                <th>Ghi chú</th>
                                                <th>Thời gian</th>
                                                <th>Trạng thái</th>
                                                <th>Hành động</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($order as $item)
                                                <tr>
                                                    <td>{{ $item->table->name }}</td>
                                                    <td>
                                                        <ul style="list-style: none; padding: 0;">
                                                            @foreach ($item->orderDetails as $orderDetail)
                                                                <li>
                                                                    @php
                                                                        $variant = json_decode($orderDetail->item, true);
                                                                    @endphp
                                                                    @if ( $variant !== null && is_array($variant))
                                                                        @foreach ($variant as $key => $value)
                                                                                @if ($key === 'price')
                                                                                    {{$value}}
                                                                                @endif
                                                                        @endforeach
                                                                    @endif
                                                                    {{ $orderDetail->quantity }} x
                                                                    {{ $orderDetail->product->name }}
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    <td>{{ $item->total_price }} </td>
                                                    </td>
                                                    {{-- <td>{{ $item->customer_name }}</td> --}}
                                                    <td>{{ $item->note }}</td>
                                                    <td>{{ $item->created_at }}</td>
                                                    <th>
                                                        @if ($item->status == 0)
                                                            <span> Chưa xác nhận </span>
                                                        @endif
                                                    </th>
                                                    <td>
                                                        <form action="" method="get">
                                                            <select class="form-control order-status" name="status"
                                                                id="{{ $item->id }}">
                                                                <option value="0"
                                                                    {{ $item->status === 0 ? 'selected' : '' }}>
                                                                    Chưa xác nhận
                                                                </option>
                                                                <option value="1"
                                                                    {{ $item->status === 1 ? 'selected' : '' }}>
                                                                    Đã xác nhận
                                                                </option>
                                                                <option value="2"
                                                                    {{ $item->status === 2 ? 'selected' : '' }}>
                                                                    Hủy bỏ
                                                                </option>
                                                            </select>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    @else
                                        <div class="alert alert-danger" role="alert">
                                            Bạn không có đơn đặt hàng mới <i class="fa-solid fa-bell"></i>
                                        </div>
                                    @endif
                                </table>
                            </div>
                        </div>
                    </div>
                    {{-- đã thanh toán --}}
                    <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                        <div class="col-md-12">
                            <div class="row table-responsive mt-3" id="nonPayOrder">
                                <table id="myTable" class="table table-hover">
                                    <thead class="">
                                        <tr>
                                            <th>Bàn</th>
                                            <th>Tổng cộng</th>
                                            <th>Ghi chú</th>
                                            <th>Thời gian</th>
                                            <th>Trạng thái</th>
                                            <th>Khách hàng</th>
                                            <th>Hành động</th>
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
                                                <td>{{ $item->created_at }}</td>
                                                <td>
                                                    @if ($item->status == 2)
                                                        <span>Đã hủy</span>
                                                    @elseif ($item->status == 5)
                                                        <span>Trả</span>
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
        let table = new DataTable('#myTable', {
            responsive: true
        });
        let tables = new DataTable('#appTable', {
            responsive: true
        });
    </script>
    <script>
        $(document).ready(function() {
            $('body').on('change', '.order-status', function() {
                let status = $(this).find(':selected').val();
                let id = $(this).attr('id');
                $.ajax({
                    url: '{{ route('order-status') }}',
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
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>

    <script src="//js.pusher.com/3.1/pusher.min.js"></script>
    <script type="text/javascript">
        var pusher = new Pusher('3f445aa654bdfac71f01', {
            encrypted: true,
            cluster: "ap1"
        });

        var channel = pusher.subscribe('development');

        channel.bind('App\\Events\\HelloPusherEvent', function(data) {
            $('#table-' + data.id).addClass('red-bg');
            Command: toastr["warning"](data.message)

            toastr.options = {
                "closeButton": false,
                "debug": false,
                "newestOnTop": false,
                "progressBar": true,
                "positionClass": "toast-top-right",
                "preventDuplicates": false,
                "onclick": null,
                "showDuration": "300",
                "hideDuration": "1000",
                "timeOut": "5000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            }

            var audio = new Audio('{{ asset('Doorbell.mp3') }}');
            audio.play();
            setTimeout(function() {
                $('#table-' + data.id).removeClass('red-bg');
            }, 30000);
        });
    </script>
    <script type="text/javascript">
        var pusher = new Pusher('3f445aa654bdfac71f01', {
            encrypted: true,
            cluster: "ap1"
        });
        var channel = pusher.subscribe('channel-name');

        channel.bind('App\\Events\\OrderCreated', function(data) {
            $('#table-' + data.id).addClass('yellow-bg');
            Command: toastr["warning"]("Bạn có đơn order mới")

            toastr.options = {
                "closeButton": false,
                "debug": false,
                "newestOnTop": false,
                "progressBar": true,
                "positionClass": "toast-top-right",
                "preventDuplicates": false,
                "onclick": null,
                "showDuration": "300",
                "hideDuration": "1000",
                "timeOut": "5000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            }

            var audio = new Audio('{{ asset('Doorbell.mp3') }}');
            audio.play();
        });
    </script>
@endpush
