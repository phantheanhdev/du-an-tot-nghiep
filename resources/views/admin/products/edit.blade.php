@extends('admin.layout.content')

@section('main-content')
    <div class="col-md-9">
        <div class="ibox float-e-margins" id="boxOrder">
            <div class="ibox-content">
                <h3 class="text-qr Rest-dark text-center p-2">
                    <a href="/product" class="btn btn-outline btn-primary btn-sm float-left">
                        <i class="fa fa-long-arrow-left mt-1"></i>
                    </a>
                    Food updates
                </h3>
                <hr>
                <form method="POST" action="{{ route('product.edit', ['id' => $product->id]) }}"
                    enctype="multipart/form-data" id="edit_product">
                    @method('POST')
                    @csrf

                    <div class="row">
                        <div class="mb-3 col-12 col-md-6">
                            <label class="font-weight-bold" class="form-label">Name</label>
                            <input type="text" name="name" class="form-control" placeholder="Enter food name..." value="{{ $product->name }}">
                            <div class="form-text" id="name" style="color: red"></div>
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3 col-12 col-md-6">
                            <label class="font-weight-bold" class="form-label">Price</label>
                            <input type="number" name="price" placeholder="0" min="0" step="any" class="form-control"
                                value="{{ $product->price }}">
                            <div class="form-text" id="price" style="color: red"></div>
                            @error('price')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="font-weight-bold" class="form-label">Description</label>
                        <textarea name="description" class="form-control">{{ $product->description }}</textarea>
                        <div class="form-text" id="description" style="color: red"></div>
                        @error('description')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="mb-3 col-6">
                            <label class="font-weight-bold" class="form-label" for="category_id">Category</label>
                            <select id="category_id" name="category_id" class="form-control"1>
                                <option value="">Choose...</option>
                                @foreach ($category as $category)
                                    <option value="{{ $category->id }}"
                                        {{ $product->category_id == $category->id ? 'selected' : '' }}>
                                        {{ $category->category_name }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="form-text" id="category_id" style="color: red"></div>
                            @error('category_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3 col-6">
                            <label class="font-weight-bold" class="form-label" for="status">Status</label>
                            <select id="status" name="status" class="form-control">
                                <option value="">Choose...</option>
                                <option value="active" {{ $product->status == 'active' ? 'selected' : '' }}>Active</option>
                                <option value="inactive" {{ $product->status == 'inactive' ? 'selected' : '' }}>Inactive
                                </option>
                            </select>
                            <div class="form-text" id="status" style="color: red"></div>
                            @error('status')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="font-weight-bold" class="form-label">Image</label>
                        <input id="image" type="file"
                            class="form-control image-file @error('image') is-invalid @enderror" name="image"
                            accept="image/*">
                        <br>
                        <img id="image_preview"
                            src="{{ $product->image ? Storage::url($product->image) : 'https://www.freeiconspng.com/uploads/img-landscape-photo-photography-picture-icon-12.png' }}"
                            alt="" width="100px" height="100px"> <br>
                        @error('image')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary mr-2" id="btn_edit_product">Update</button>
                    <button type="reset" class="btn btn-primary">Reset</button>
                </form>
            </div>
        </div>
    </div>
@endsection
