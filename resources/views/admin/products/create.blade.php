@extends('admin.layout.content')

@section('main-content')
    <div class="col-md-9">
        <div class="ibox float-e-margins" id="boxOrder">
            <div class="ibox-content">
                <div class="sk-spinner sk-spinner-wave">
                    <div class="sk-rect1"></div>
                    <div class="sk-rect2"></div>
                    <div class="sk-rect3"></div>
                    <div class="sk-rect4"></div>
                    <div class="sk-rect5"></div>
                </div>
                <h3 class="text-qr Rest-dark text-center p-2">
                    <a href="/restaurant-manager" class="btn btn-outline btn-primary btn-sm float-left">
                        <i class="fa fa-long-arrow-left mt-1"></i>
                    </a>
                   Thêm menu đồ ăn
                </h3>
                <hr />
                <input hidden value="Completed" id="lblCompleted" />
                <input hidden value="2" id="txtTableId" />

                <div class="col-md-12">
                    <form action="{{ route('product.create') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" name="name" id="name" class="form-control" >
                         @error('name')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                        </div>
                        <div class="form-group">
                            <label for="price">Price</label>
                            <input type="number" name="price" id="price" class="form-control" >
                         @error('price')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                        </div>
                        <div class="form-group">
                            <label for="item">Item</label>
                            <input type="text" name="item" id="item" class="form-control" >
                            @error('item')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea name="description" id="description" class="form-control" ></textarea>
                            @error('description')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="category">Category</label>
                            <select name="category_id" id="category" class="form-control" >
                                <option value=""></option>
                                @foreach ($category as $detail)
                                <option value="{{ $detail->id }}">{{ $detail->name }}</option>
                                @endforeach
                            </select>
                            @error('category_id')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="status">Status</label>
                            <select name="status" id="status" class="form-control" >
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                            @error('status')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Image</label>
                            <img id="image_preview" src="https://www.freeiconspng.com/uploads/img-landscape-photo-photography-picture-icon-12.png" alt="Product image" style="height:100px" >
                            <input type="file" name="image" accept="image/*" class="@error('image') is-invalid @enderror" id="image"> <br>
                            @error('image')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Add Product</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
