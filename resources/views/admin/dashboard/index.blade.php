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
                <input hidden value="Table No" id="lblTableNo" />
                <input hidden value="1" id="lblRestaurantId" />
                <input hidden value="You have a new order!" id="lblNewOrderMessage" />
                <input hidden value="Have a new order" id="lblNewOrderNotification" />
                <input hidden value="The waiter has been called." id="lblCallWaiter" />
                <input hidden value="Invoice is requested" id="lblCallBill" />

                <h3 class="text-qrRest-dark text-center">Thống kê</h3>

                <hr />
                <div class="col-md-12">
                    <div class="title">
                        <p style="font-size: 25px" class="text-danger">Doanh thu</p>
                    </div>
                    <div class="row">

                        <a href="" class="text-white">
                            <div id="table-2" class="widget bg-danger p-lg text-center">

                                <div class="m-b-md">

                                    <p id="table-notification-2" style="font-size: 15px">Đơn đặt hàng hôm nay</p>

                                    <h3 class="font-bold no-margins">
                                        {{ $todaysOrder }}
                                    </h3>
                                </div>
                            </div>
                        </a>
                        <a href="" class="text-white">
                            <div id="table-2" class="widget bg-danger p-lg text-center">

                                <div class="m-b-md">

                                    <p id="table-notification-2" style="font-size: 15px">Đơn hàng đang chờ xử lý</p>

                                    <h3 class="font-bold no-margins">
                                        {{ $totalPendingOrders }}
                                    </h3>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="row">

                        <a href="" class="text-white">
                            <div id="table-2" class="widget bg-danger p-lg text-center">

                                <div class="m-b-md">

                                    <p id="table-notification-2" style="font-size: 15px">Thu nhập hôm nay</p>

                                    <h3 class="font-bold no-margins ">
                                        {{ formatNumberPrice($todaysEarnings) }} đ
                                    </h3>
                                </div>
                            </div>
                        </a>
                        <a href="" class="text-white">
                            <div id="table-2" class="widget bg-danger p-lg text-center">

                                <div class="m-b-md">

                                    <p id="table-notification-2" style="font-size: 15px">Thu nhập tháng này</p>

                                    <h3 class="font-bold no-margins ">
                                        {{  formatNumberPrice($monthEarnings) }}
                                    </h3>
                                </div>
                            </div>
                        </a>
                        <a href="" class="text-white">
                            <div id="table-2" class="widget bg-danger p-lg text-center">

                                <div class="m-b-md">

                                    <p id="table-notification-2" style="font-size: 15px">Thu nhập năm nay</p>

                                    <h3 class="font-bold no-margins ">
                                        {{ formatNumberPrice($yearEarnings) }}
                                    </h3>
                                </div>
                            </div>
                        </a>


                    </div>
                </div>
                <div class="col-md-12">
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
                </div>






                <div class="Order statistics mt-4 mb-4">
                    <div id="curve_chart" style="width: 100%; height: 500px"></div>
                </div>



                @if (count($statisticsMonth) > 0)
                    <div class="col-md-12 mt-4 mb-4">
                        <div class="title text-center">
                            <p style="font-size:20px">Doanh thu theo tháng trong năm nay</p>
                        </div>
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
                                        <td style="color: red;">{{ number_format($item->total_amount, 2) }} đ</td>
                                    </tr>
                                @endforeach


                            </tbody>
                        </table>
                    </div>
                @endif


                @if (count($statisticsYear) > 0)
                <div class="col-md-12 mt-4 mb-4">
                    <div class="title text-center">
                        <p style="font-size:20px">Doanh thu những năm gần đây</p>
                    </div>
                    <table class="table">
                        <thead>
                            <tr>

                                <th scope="col">Tháng</th>
                                <th scope="col">Tổng số đơn đặt hàng</th>
                                <th scope="col">Tổng cộng</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($statisticsYear as $item)
                                <tr>

                                    <td>{{ $item->year }}</td>
                                    <td>{{ $item->total_orders }}</td>
                                    <td style="color: red;">{{ number_format($item->total_amount, 2) }} đ</td>
                                </tr>
                            @endforeach


                        </tbody>
                    </table>
                </div>
            @endif

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
