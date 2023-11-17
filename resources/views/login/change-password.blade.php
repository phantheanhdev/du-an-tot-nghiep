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

                        <form action="{{ route('update.password') }}" method="post">
                            @csrf
                            <div class="mb-3">
                                <label for="current_password" class="form-label">Mật khẩu cũ:</label>
                                <input type="password" name="current_password" class="form-control" >
                                @error('current_password') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>

                            <div class="mb-3">
                                <label for="new_password" class="form-label">Mật khẩu mới:</label>
                                <input type="password" name="new_password" class="form-control" >
                                @error('new_password') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>

                            <div class="mb-3">
                                <label for="confirm_password" class="form-label">Nhập lại mật khẩu mới:</label>
                                <input type="password" name="confirm_password" class="form-control" >
                                @error('confirm_password') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>

                            <button type="submit" class="btn btn-primary">Đổi mật khẩu</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

