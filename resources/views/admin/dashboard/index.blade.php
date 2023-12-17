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
                <input hidden value="Table No" id="lblTableNo" />
                <input hidden value="1" id="lblRestaurantId" />
                <input hidden value="You have a new order!" id="lblNewOrderMessage" />
                <input hidden value="Have a new order" id="lblNewOrderNotification" />
                <input hidden value="The waiter has been called." id="lblCallWaiter" />
                <input hidden value="Invoice is requested" id="lblCallBill" />

                <h3 class="text-qrRest-dark text-center">Thống kê</h3>

                <hr />
                <div class="col-md-12">
                    {{-- <h4 class="page-title">Doanh thu</h4> --}}
                    <div class="row">
                        <div class="col-sm-3 mt-2">
                            <div class="card widget-flat">
                                <div class="card-body">
                                    <div class="float-end">
                                        <i class="mdi mdi-account-multiple widget-icon"></i>
                                    </div>
                                    <h5 class="text-muted fw-normal mt-0" title="Number of Customers">Tổng đơn hôm nay</h5>
                                    <h3 class="mt-3 mb-3">{{ $todaysOrder }}</h3>
                                </div> <!-- end card-body-->
                            </div> <!-- end card-->
                        </div> <!-- end col-->

                        <div class="col-sm-3 mt-2">
                            <div class="card widget-flat">
                                <div class="card-body">
                                    <div class="float-end">
                                        <i class="mdi mdi-cart-plus widget-icon"></i>
                                    </div>
                                    <h5 class="text-muted fw-normal mt-0" title="Number of Orders">Đơn chờ xử lý</h5>
                                    <h3 class="mt-3 mb-3">{{ $totalPendingOrders }}</h3>
                                </div> <!-- end card-body-->
                            </div> <!-- end card-->
                        </div> <!-- end col-->

                        <div class="col-sm-3 mt-2">
                            <div class="card widget-flat">
                                <div class="card-body">
                                    <div class="float-end">
                                        <i class="mdi mdi-account-multiple widget-icon"></i>
                                    </div>
                                    <h5 class="text-muted fw-normal mt-0" title="Number of Customers">Đơn đã hoàn thành hôm nay</h5>
                                    <h3 class="mt-3 mb-3">{{ $totalCompleteOrders }}</h3>
                                </div> <!-- end card-body-->
                            </div> <!-- end card-->
                        </div> <!-- end col-->

                        <div class="col-sm-3 mt-2">
                            <div class="card widget-flat">
                                <div class="card-body">
                                    <div class="float-end">
                                        <i class="mdi mdi-cart-plus widget-icon"></i>
                                    </div>
                                    <h5 class="text-muted fw-normal mt-0" title="Number of Orders">Đơn hủy hôm nay</h5>
                                    <h3 class="mt-3 mb-3">{{ $totalCancelOrders }}</h3>
                                </div> <!-- end card-body-->
                            </div> <!-- end card-->
                        </div> <!-- end col-->

                    </div> <!-- end row -->

                    <div class="row mt-2 ">
                        <div class="col-sm-4 mt-2">
                            <div class="card widget-flat">
                                <div class="card-body">
                                    <div class="float-end">
                                        <i class="mdi mdi-account-multiple widget-icon"></i>
                                    </div>
                                    <h5 class="text-muted fw-normal mt-0" title="Number of Customers">Doanh thu hôm nay</h5>
                                    <h3 class="mt-3 mb-3">{{ formatNumberPrice($todaysEarnings) }}</h3>

                                </div> <!-- end card-body-->
                            </div> <!-- end card-->
                        </div> <!-- end col-->
                        <div class="col-sm-4 mt-2">
                            <div class="card widget-flat">
                                <div class="card-body">
                                    <div class="float-end">
                                        <i class="mdi mdi-account-multiple widget-icon"></i>
                                    </div>
                                    <h5 class="text-muted fw-normal mt-0" title="Number of Customers">Doanh thu tháng nay
                                    </h5>
                                    <h3 class="mt-3 mb-3"> {{ formatNumberPrice($monthEarnings) }}</h3>
                                </div> <!-- end card-body-->
                            </div> <!-- end card-->
                        </div> <!-- end col-->
                        <div class="col-sm-4 mt-2">
                            <div class="card widget-flat">
                                <div class="card-body">
                                    <div class="float-end">
                                        <i class="mdi mdi-account-multiple widget-icon"></i>
                                    </div>
                                    <h5 class="text-muted fw-normal mt-0" title="Number of Customers">Doanh thu năm nay</h5>
                                    <h3 class="mt-3 mb-3">{{ formatNumberPrice($yearEarnings) }}</h3>
                                </div> <!-- end card-body-->
                            </div> <!-- end card-->
                        </div> <!-- end col-->
                    </div> <!-- end row -->

                    {{-- <div class="col-md-12">
                        <div class="title">
                            <p style="font-size: 25px" class="text-danger">Số lượng sản phẩm và danh mục</p>
                        </div>
                        <div class="row">
                            <a href="" class="text-white">
                                <div id="table-2" class="widget bg-danger p-lg text-center">

                                    <div class="m-b-md">

                                        <p id="table-notification-2" style="font-size: 15px">Tổng số danh mục</p>

                                        <h3 class="font-bold no-margins ">
                                            {{ $totalCategories }}
                                        </h3>
                                    </div>
                                </div>
                            </a>


                            <a href="" class="text-white">
                                <div id="table-2" class="widget bg-danger p-lg text-center">

                                    <div class="m-b-md">

                                        <p id="table-notification-2" style="font-size: 15px">Tổng số sản phẩm</p>

                                        <h3 class="font-bold no-margins ">
                                            {{ $totalProducts }}
                                        </h3>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div> --}}
                    {{--
                    <div class="row mt-4">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="align-items-center">

                                <div class="card-body pt-0 mt-2 mb-2">
                                    <div id="curve_chart" style="width: 100%; height: 400px"></div>
                                </div>
                            </div>
                            </div> <!-- end card-->
                        </div> <!-- end col-->
                    </div>
 --}}
                    <div class="row mt-2">
                        @if (count($statisticsMonth) > 0)

                        <div class="col-xl-6 col-lg-6 order-lg-1 mt-2">
                            <div class="card">
                                <div class="d-flex card-header justify-content-between align-items-center">
                                    <h4 class="header-title">Doanh thu theo tháng trong năm nay</h4>
                                </div>

                                <div class="card-body pt-0">
                                    <table class="table">
                                        <thead>
                                            <tr>

                                                <th scope="col">Tháng</th>
                                                <th scope="col">Tổng số đơn đặt hàng</th>
                                                <th scope="col">Tổng cộng</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            @foreach ($statisticsMonth as $item)
                                                <tr>

                                                    <td>{{ $item->month }}</td>
                                                    <td>{{ $item->total_orders }}</td>
                                                    <td style="color: red;">{{ number_format($item->total_amount, 0) }} đ</td>
                                                </tr>
                                            @endforeach


                                        </tbody>
                                    </table>

                                </div>
                            </div> <!-- end card-->
                        </div> <!-- end col-->
                        @endif


                        @if (count($statisticsYear) > 0)
                        <div class="col-xl-6 col-lg-6 order-lg-1 mt-2">
                            <div class="card">
                                <div class="d-flex card-header justify-content-between align-items-center">
                                    <h4 class="header-title">Doanh thu những năm gần đây</h4>
                                </div>

                                <div class="card-body py-0 mb-3">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th scope="col">Năm</th>
                                                <th scope="col">Tổng số đơn đặt hàng</th>
                                                <th scope="col">Tổng cộng</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            @foreach ($statisticsYear as $item)
                                                <tr>

                                                    <td>{{ $item->year }}</td>
                                                    <td>{{ $item->total_orders }}</td>
                                                    <td style="color: red;">{{ number_format($item->total_amount, 0) }} đ</td>
                                                </tr>
                                            @endforeach


                                        </tbody>
                                    </table>
                                </div> <!-- end slimscroll -->
                            </div>
                            <!-- end card-->
                        </div>
                        <!-- end col -->
                        @endif

                    </div>

                </div>
            </div>

        </div>




        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <script type="text/javascript">
            google.charts.load('current', {
                'packages': ['corechart']
            });
            google.charts.setOnLoadCallback(drawChart);


            function drawChart() {


                var data = google.visualization.arrayToDataTable([
                    ['Day', 'Tổng cộng (đ)'],

                    <?php echo $chart_data; ?>


                ]);

                var options = {
                    title: 'Thống kê đơn hàng',
                    curveType: 'function',
                    legend: {
                        position: 'bottom'
                    }
                };

                var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

                chart.draw(data, options);
            }
        </script>
    @endsection
