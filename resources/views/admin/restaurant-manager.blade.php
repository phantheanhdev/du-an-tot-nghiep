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
                <input hidden value="Table No" id="lblTableNo" />
                <input hidden value="1" id="lblRestaurantId" />
                <input hidden value="You have a new order!" id="lblNewOrderMessage" />
                <input hidden value="Have a new order" id="lblNewOrderNotification" />
                <input hidden value="The waiter has been called." id="lblCallWaiter" />
                <input hidden value="Invoice is requested" id="lblCallBill" />

                <h3 class="text-qrRest-dark text-center">TABLES</h3>
                <div class="text-center">
                    <span class="badge badge-dark mr-2"><i class="fa fa-cutlery"></i> : There are
                        customers</span>
                    <span class="badge badge-dark mr-2"> <i class="fa fa-minus"></i> : The table is
                        empty</span>
                    <span class="badge badge-dark mr-2"> <i class="fa fa-bell"></i> : Have a new
                        order</span>
                </div>

                <hr />
                <div class="col-md-12">
                    <div class="row">
                        @foreach ($tables as $table)
                            <a href="{{ $table->orders->filter(function ($order) {
                                    return $order->status == 0 || $order->status == 1 || $order->status == 3 || $order->status == 4;
                                })->count() > 0
                                ? route('order-of-table', $table->id)
                                : '#' }}"
                                class="text-white">


                                <div id="table-{{ $table->id }}"
                                    class="widget p-lg text-center {{ $table->orders->filter(function ($order) {
                                            return $order->status != 2 && $order->status != 5;
                                        })->count() > 0
                                        ? 'green-bg'
                                        : 'black-bg' }} "
                                    style="height: 160px;">

                                    <div class="m-b-md">
                                        <i id="table-icon-2" class="fa fa-minus fa-4x"></i>
                                        <br />
                                        @if (
                                            $table->orders->filter(function ($order) {
                                                    return $order->status == 0 || $order->status == 5;
                                                })->count() == 0)
                                            <small id="table-notification-{{ $table->id }}">Bàn trống</small>
                                        @else
                                            <small id="table-notification-{{ $table->id }}">Bàn có khách</small>
                                        @endif

                                        <h3 class="font-bold no-margins">
                                            Bàn số: {{ $table->name }}
                                        </h3>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
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
            audio.addEventListener('canplaythrough', function() {
                audio.play();
            });;

            setTimeout(function() {
                $('#table-' + data.id).removeClass('red-bg');
            }, 30000);
        });
    </script>
@endsection
