<html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login - QR MENU</title>
    <link rel="shortcut icon" type="image/png" href="/images/favicon.png" />
    <link rel="stylesheet" href="{{ asset('/lib/bootstrap/dist/css/bootstrap.min.css') }}" />
    <link href="{{ asset('/lib/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('admin/css/animate.css') }}" rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Yeon+Sung&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('admin/css/site.css') }}" />
    <link href="{{ asset('/css/chapterTitle.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('/lib/iCheck/square/red.css') }}">
</head>

<body class="gray-bg">
    <div class="loginColumns animated fadeInDown">
        <div class="row">
            <div class="col-lg-6 ibox-content" id="lg-land" style="background-image: url('{{ asset('qr-menu.jpg') }}'); background-size: cover;">
            </div>
            <div class="col-lg-6" id="loginBox">
                <div class="col-md-12 ibox-content">
                    <div class="sk-spinner sk-spinner-wave">
                        <div class="sk-rect1"></div>
                        <div class="sk-rect2"></div>
                        <div class="sk-rect3"></div>
                        <div class="sk-rect4"></div>
                        <div class="sk-rect5"></div>
                    </div>
                    <br>
                    <div class="enhanced-hr enhanced-hr-2">
                        <span>WELCOME </span>
                    </div>
                    <br>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <span class="text-danger field-validation-valid" data-valmsg-for="UserName"
                            data-valmsg-replace="true"></span>
                        <div class="form-group">
                            <input placeholder="Username" class="form-control" type="text" data-val="true"
                                data-val-required="Please enter username." id="UserName" name="username"
                                value="">
                            @error('username')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div> <span class="text-danger field-validation-valid" data-valmsg-for="Password"
                            data-valmsg-replace="true"></span>
                        <div class="form-group">
                            <input type="password" placeholder="Password" class="form-control" data-val="true"
                                data-val-required="Please enter password." id="Password" name="password">
                            @error('password')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror

                        </div>
                        <button type="submit" class="btn btn-outline btn-primary btn-block">
                            <span>LOGIN</span>
                        </button>
                        <br>
                </div>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-lg-6"></div>
            <div class="col-lg-6 text-right">
                <small>Copyright &#xA9; 2023</small>

            </div>
        </div>
    </div>
    <script src="{{ asset('/lib/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('/lib/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>

</body>

</html>
