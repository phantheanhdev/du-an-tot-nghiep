<html>

<head>
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
