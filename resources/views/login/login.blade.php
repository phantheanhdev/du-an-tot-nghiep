<html>

<head>
<<<<<<< HEAD
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
=======


    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>FOODIE</title>

    <!-- Custom fonts for this template-->
    <link href="{{ asset('bootstrap/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('bootstrap/css/sb-admin-2.min.css') }}" rel="stylesheet">

</head>

<body class="bg-gradient-danger">


    <div class="container">
        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Đăng Nhập</h1>
                                    </div>
                                    <form method="POST" action="{{ route('login') }}">
                                        @csrf
                                        <div class="form-group">
                                            <input type="text" name="username" class="form-control form-control-user"
                                                id="exampleInputEmail" aria-describedby="emailHelp"
                                                placeholder=" Tên Đăng Nhập..." required>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" name="password"
                                                class="form-control form-control-user" id="exampleInputPassword"
                                                placeholder="Mật Khẩu" required>
                                        </div>
                                        <button type="submit" class="btn btn-danger">Đăng Nhập</button>
                                    </form>
                                </div>
                            </div>
                        </div>
>>>>>>> 59fcbc8 (edit loi vat)
                    </div>
                    <br>
                    <div class="enhanced-hr enhanced-hr-2">
                        <span>WELCOME   </span>
                    </div>
                    <br>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <span class="text-danger field-validation-valid" data-valmsg-for="UserName" data-valmsg-replace="true"></span>
                        <div class="form-group">
                            <input placeholder="Username" class="form-control" type="text" data-val="true" data-val-required="Please enter username." id="UserName" name="username" value="">
                            @error('username') <div class="text-danger">{{ $message }}</div> @enderror
                        </div> <span class="text-danger field-validation-valid" data-valmsg-for="Password" data-valmsg-replace="true"></span>
                        <div class="form-group">
                            <input type="password" placeholder="Password" class="form-control" data-val="true" data-val-required="Please enter password." id="Password" name="password">
                            @error('password') <div class="text-danger">{{ $message }}</div> @enderror

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
