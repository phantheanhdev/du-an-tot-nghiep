@extends('admin.layout.content')
@section('main-content')
    <div class="col-md-9">
        <div class="ibox float-e-margins" id="boxOrder">
            <div class="ibox-content">

                <div class="text-qr Rest-dark text-center p-2 ">
                    <a href="{{ route('table.index') }}" class="btn btn-outline btn-primary btn-sm float-left">
                        <i class="fa fa-long-arrow-left mt-1"></i>
                    </a>
                    <h4 class="">Add table</h4>
                </div>

                <div class="">
                    <form method="POST" action="{{ route('table.store') }}" enctype="multipart/form-data"
                        id="create_table">
                        @method('POST')
                        @csrf

                        <div class="mb-3">
                            <label class="form-label">Number of tables</label>
                            <input type="number" class="form-control" placeholder="1" name="name" id="create_table_name"
                                required>
                            <div class="form-text" id="create_table_er_name" style="color: red"></div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Table type(person/table)</label>
                            <input type="number" min="1" max="50" class="form-control" placeholder="4"
                                name="type" id="create_table_type" required>
                            <div class="form-text" id="create_table_er_type" style="color: red"></div>
                        </div>
                        <button type="submit" class="btn btn-primary" id="btn_create_table">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
