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

            <h3 class="text-qrRest-dark text-center">Tất cả bàn</h3>
            <div class="text-center">
                <span class="badge badge-dark mr-2"><i class="fa fa-cutlery"></i> : Có khách</span>
                <span class="badge badge-dark mr-2"> <i class="fa fa-minus"></i> : Bàn trống</span>
                <span class="badge badge-dark mr-2"> <i class="fa fa-bell"></i> : Đang có đơn</span>
            </div>

            <hr />
            <div class="col-md-12">
                <div class="row">
                    @foreach ($tables as $table)
                    <a href="{{ route('order-of-table', $table->id) }}" class="text-white">
                        <div id="table-{{ $table->name }}" class="widget p-lg text-center {{ $table->orders->filter(function ($order) {
                                            return $order->status == 0 || $order->status == 1;
                                        })->count() > 0
                                        ? 'green-bg'
                                        : 'black-bg' }} " style="height: 160px;">

                            <div class="m-b-md">
                                <i id="table-icon-2" class="fa fa-minus fa-4x"></i>
                                <br />
                                @if (
                                $table->orders->filter(function ($order) {
                                return $order->status == 0 || $order->status == 1;
                                })->count() > 0)
                                <small id="table-notification-{{ $table->id }}">Bàn có khách</small>
                                @else
                                <small id="table-notification-{{ $table->id }}">Bàn trống</small>
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
        let originClass = ''
        if (data.message.includes('có đơn mới')) {
            $('#table-' + data.id).addClass('yellow-bg');
        }
         else {
            originClass = $('#table-' + data.id).attr('class');
            $('#table-' + data.id).addClass('red-bg').removeClass('green-bg');
        }

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

        var audio = new Audio('{{ asset('Doorbell.mp3 ') }}');
        audio.addEventListener('canplaythrough', function() {
            audio.play();
        });;

        setTimeout(function() {
            
            $('#table-' + data.id).addClass(originClass).removeClass('red-bg').removeClass('yellow-bg')
            if (data.message.includes('có đơn mới')) {
                $('#table-' + data.id).addClass('green-bg');
                $('#table-notification-' + data.id).text('Bàn có khách')
            }
        }, 30000);
    });
</script>
@endsection