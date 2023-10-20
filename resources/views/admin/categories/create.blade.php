@extends('admin.layout.content')

@section('main-content')
    <div class="col-md-9">
        <div class="ibox float-e-margins" id="boxOrder">
            <div class="ibox-content">
                <h3 class="text-qr Rest-dark text-center p-2">
                    <a href="/category" class="btn btn-outline btn-primary btn-sm float-left">
                        <i class="fa fa-long-arrow-left mt-1"></i>
                    </a>
                    Thêm danh mục
                </h3>
                <hr>
                <form method="POST" action="{{ route('category.store') }}" enctype="multipart/form-data" id="create_categories">
                    @method('POST')
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Name</label>
                        <input type="text" name="name" class="form-control">
                        <div class="form-text" id="name" style="color: red"></div>
                        @error('name')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Note</label>
                        <input type="text" name="note" class="form-control">
                        <div class="form-text" id="note" style="color: red"></div>
                        @error('note')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="status">Status</label>
                        <select id="status" name="status">
                            <option value=""></option>
                            <option value="active">Active</option>
                            <option value="inactive">inactive</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Image</label>
                        <img id="image_preview" src="https://www.freeiconspng.com/uploads/img-landscape-photo-photography-picture-icon-12.png" alt="Product image" style="height:100px" >
                        <input type="file" name="image" accept="image/*" class="@error('image') is-invalid @enderror" id="image"> <br>
                        @error('image')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary mr-2" id="btn_create_category">Submit</button>
                    <button type="reset" class="btn btn-primary">Reset</button>
                </form>
            </div>
        </div>
    </div>
@endsection
