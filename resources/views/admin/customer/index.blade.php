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
                    Khách hàng
                    {{-- <a href="{{ route('create') }}" class="float-right">
                    <button class="btn btn-primary">+ Thêm mới</button>
                </a> --}}
                </h3>
                <hr />
                <input hidden value="Completed" id="lblCompleted" />
                <input hidden value="2" id="txtTableId" />

                <div class="col-md-12">
                    <div class="row table-responsive" id="nonPayOrder">
                        <table id="myTable" class="display ">
                            <thead class="thead-dark">
                                <tr>
                                    <th>STT</th>
                                    <th>Số điện thoại</th>
                                    <th>Số lần mua</th>
                                    <th>Tổng tiền</th>
                                    <th>Tổng điểm </th>
                                    <th>Hành Động</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($customer as $key => $item)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $item->phone }}</td>
                                        <td>
                                            @php
                                                $countPurchases = $item->orders->where('status', 5)->count();
                                            @endphp
                                            @if ($countPurchases > 0)
                                                {{ $countPurchases }}
                                            @else
                                                0
                                            @endif
                                        </td>
                                        <td>
                                            @php
                                                $totalAmount = $item->orders->where('status', 5)->sum('total_price');
                                            @endphp
                                            {{ $totalAmount }}
                                        </td>
                                        <td>{{ $item->point }}</td>
                                        <td>
                                            <a  href="{{ url('show-customer/' . $item->id)}}" class="btn btn-warning btn-sm float-end mx-1">
                                                <i class="fa-regular fa-eye"></i>
                                            </a>
                                            <a id="{{ $item->id }}" href=""
                                                class="btn btn-danger btn-sm float-end mx-1 deleteIcon">
                                                <i class="fa-solid fa-trash-can"></i>
                                            </a>
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

    <script>
        $(document).on('click', '.deleteIcon', function(e) {
            e.preventDefault();
            let id = $(this).attr('id');
            let csrf = '{{ csrf_token() }}';
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '{{ route('delete-customer') }}',
                        method: 'delete',
                        data: {
                            id: id,
                            _token: csrf
                        },
                        success: function(response) {
                            console.log(response);
                            Swal.fire(
                                'Deleted!',
                                'Your file has been deleted.',
                                'success'
                            )
                            window.location.reload();

                        }
                    });
                }
            })
        });
    </script>
@endpush
