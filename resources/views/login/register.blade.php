@extends('admin.layout.content')
@section('main-content')
<div class="col-md-9" style="font-size: large;">
    <div class="ibox float-e-margins" id="boxOrder">
        <div class="ibox-content">
            <div class="sk-spinner sk-spinner-wave">
                <div class="sk-rect1"></div>
                <div class="sk-rect2"></div>
                <div class="sk-rect3"></div>
                <div class="sk-rect4"></div>
                <div class="sk-rect5"></div>
            </div>
            <h1 class="text-qr Rest-dark text-center p-2">
                <a href="/showUser" class="btn btn-outline btn-primary btn-sm float-left">
                    <i class="fa fa-long-arrow-left mt-1"></i>
                </a>
                Tạo tài khoản
            </h1>
            <input hidden value="Completed" id="lblCompleted" />
            <input hidden value="2" id="txtTableId" />

            <div class="card-body">
                @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <label for="new_password" class="form-label">Tên đăng nhập:</label>
                    <div class="form-group">
                        <input type="text" name="username" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" >
                        @error('username') <div class="text-danger">{{ $message }}</div> @enderror

                    </div>
                    <label for="new_password" class="form-label">Mật khẩu :</label>
                    <div class="form-group">
                        <input type="password" name="password" class="form-control form-control-user" id="exampleInputPassword" >
                        @error('password') <div class="text-danger">{{ $message }}</div> @enderror
                    </div>
                    <div class="form-group">
                        <label for="role" class="form-label">Chọn vai trò:</label>
                        <select class="form-select" id="role" name="role">
                            <option selected disabled>Chọn vai trò</option>
                            <option value="0">Nhân Viên</option>
                            <option value="1">Admin</option>
                        </select>
                        @error('role') <div class="text-danger">{{ $message }}</div> @enderror
                    </div>

                    <button type="submit" class="btn btn-danger">Tạo</button>
                </form>
            </div>



        </div>
    </div>
</div>
<script>
    function togglePassword(inputId) {
        var passwordInput = document.getElementById(inputId);
        var button = document.querySelector('[data-target="' + inputId + '"]');

        if (passwordInput.type === "password") {
            passwordInput.type = "text";
            button.innerHTML = '<i class="fa-regular fa-eye-slash"></i> Hide';
        } else {
            passwordInput.type = "password";
            button.innerHTML = '<i class="fa-regular fa-eye"></i> Show';
        }
    }
</script>
@endsection