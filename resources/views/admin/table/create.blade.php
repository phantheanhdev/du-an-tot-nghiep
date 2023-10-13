@extends('admin.layout.content')
@section('main-content')
    <div class="col-md-9">
        <div class="ibox float-e-margins" id="boxOrder">
            <div class="ibox-content">

                <form method="POST" action="{{ route('table.store') }}" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label class="form-label">Tên bàn</label>
                        <input type="text" class="form-control" placeholder="Bàn 1" value="Bàn " name="name">
                        <div class="form-text">thông báo lỗi</div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Loại bàn(người/bàn)</label>
                        <input type="text" class="form-control" placeholder="4" name="type">
                        <div class="form-text">thông báo lỗi</div>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
@endsection
