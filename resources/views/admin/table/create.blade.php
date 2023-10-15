@extends('admin.layout.content')
@section('main-content')
    <div class="col-md-9">
        <div class="ibox float-e-margins" id="boxOrder">
            <div class="ibox-content">

                <form method="POST" action="{{ route('table.store') }}" enctype="multipart/form-data" id="create_table">
                    @method('POST')
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Tên bàn</label>
                        <input type="text" class="form-control" placeholder="Bàn 1" value="Bàn " name="name"
                            id="create_table_name" required>
                        <div class="form-text" id="create_table_er_name" style="color: red"></div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Loại bàn(người/bàn)</label>
                        <input type="number" min="1" max="50" class="form-control" placeholder="4"
                            name="type" id="create_table_type" required>
                        <div class="form-text" id="create_table_er_type" style="color: red"></div>
                    </div>
                    <button type="submit" class="btn btn-primary" id="btn_create_table">Submit</button>
                </form>
            </div>
        </div>
    </div>
@endsection
