@extends('admin.layout.content')

@section('main-content')

<div style="width: 800px;" class="">
    <div class="  justify-content-center">
        <div class="">
            <div class="card">
                <div class="card-header">
                    <h1 class="text-center">Change Password</h1>
                </div>
                <div class="card-body">
                    @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="form-group">
                            <input type="text" name="username" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder=" Tên Đăng Nhập...">
                            @error('username') <div class="text-danger">{{ $message }}</div> @enderror

                        </div>
                        <div class="form-group">
                            <input type="password" name="password" class="form-control form-control-user" id="exampleInputPassword" placeholder="Mật Khẩu....">
                            @error('password') <div class="text-danger">{{ $message }}</div> @enderror
                        </div>
                        <button type="submit" class="btn btn-danger">Đăng ký</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endsection