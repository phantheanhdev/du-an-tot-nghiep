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
                    <a href="{{ route('products-variant.index', ['product' => request()->product]) }}"
                        class="btn btn-outline btn-primary btn-sm float-left">
                        <i class="fa fa-long-arrow-left mt-1"></i>
                    </a>
                    Thêm Biến Thể
                </h3>
                <hr />
                <input hidden value="Completed" id="lblCompleted" />
                <input hidden value="2" id="txtTableId" />

                <div class="col-md-12">
                    <form action="{{ route('products-variant.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <input type="hidden" class="form-control" name="product" value="{{ request()->product }}">
                        </div>
                        <div class="row">
                            <div class="form-group col-12 col-md-6">
                                <label class="font-weight-bold" for="name">Name</label>
                                <input type="text" name="name" id="name" class="form-control">
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                        </div>
                        <div class="form-group">
                            <label class="font-weight-bold" for="description">Multi choice</label>
                            <input type="checkbox" name="multi_choice" value="1" class="form-control">

                        </div>




                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Thêm</button>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
