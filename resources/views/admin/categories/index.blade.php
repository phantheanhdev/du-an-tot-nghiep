@extends('admin.layout.content')
@section('main-content')
    <div class="col-12 col-lg-9">
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
                    Danh Mục Thực Đơn
                    <a href="{{ route('category.create') }}" class="float-right">
                        <button class="btn btn-primary">+ Thêm Mới</button>
                    </a>

                </h3>
                <hr />
                <input hidden value="Completed" id="lblCompleted" />
                <input hidden value="2" id="txtTableId" />

                <div class="col-md-12">
                    <div class="card-body" id="nonPayOrder">
                        <table id="myTable" class="display ">
                            <thead class="thead-dark">
                                <tr>
                                    <th>STT</th>
                                    <th>Hình Ảnh</th>
                                    <th>Tên Danh Mục</th>
                                    <th>Số sản phẩm</th>
                                    <th>Ghi Chú</th>
                                    <th>Trạng Thái</th>
                                    <th>Hành Động</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($category as $key => $item)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td><img width="100px" height="100px"
                                                src="{{ $item->image ? '' . Storage::url($item->image) : 'https://www.freeiconspng.com/uploads/img-landscape-photo-photography-picture-icon-12.png' }}"
                                                alt=""></td>
                                        <td>{{ $item->category_name }}</td>
                                        <td>{{ count($item->products) }}</td>
                                        <td>{{ $item->note }}</td>
                                        <td>
                                            @if ($item->status == 'active')
                                                <span class="badge badge-success">Active</span>
                                            @else
                                                <span class="badge badge-danger">Inactive</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a id="edit" href="{{ route('category.edit', ['id' => $item->id]) }}">
                                                <button class="btn btn-success"><i class="fa-solid fa-pen"></i></button>
                                            </a>
                                            @if (count($item->products) > 0)
                                                <a href="{{ route('show_product_in_category', $item->id) }}"
                                                    class="btn btn-primary">
                                                    <i class="fa-solid fa-eye"></i>
                                                </a>
                                                <a id="delete"
                                                    href="{{ route('category.delete', ['id' => $item->id]) }}">
                                                    <button class="btn btn-danger" disabled><i
                                                            class="fa-solid fa-trash-can"></i></button>
                                                </a>
                                            @else
                                                <a href="{{ route('show_product_in_category', $item->id) }}">
                                                    <button class="btn btn-primary" disabled>
                                                        <i class="fa-solid fa-eye"></i>
                                                    </button>

                                                </a>
                                                <a id="delete"
                                                    href="{{ route('category.delete', ['id' => $item->id]) }}">
                                                    <button class="btn btn-danger"><i
                                                            class="fa-solid fa-trash-can"></i></button>
                                                </a>
                                            @endif

                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        let table = new DataTable('#myTable', {
            responsive: true
        });
    </script>
@endpush
