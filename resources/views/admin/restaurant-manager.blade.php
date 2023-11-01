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
                            <a href="{{ route('order-of-table', $table->id) }}" class="text-white">
                                <div id="table-2" class="widget black-bg p-lg text-center">

                                    <div class="m-b-md">
                                        <i id="table-icon-2" class="fa fa-minus fa-4x"></i>
                                        <br />
                                        <small id="table-notification-2">Bàn trống</small>

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
        });
    </script>
@endsection
