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

                <h3 class="text-qrRest-dark text-center">DASHBOARD</h3>

                <hr />
                <div class="col-md-12">
                    <div class="title">
                        <p style="font-size: 25px" class="text-danger">Revenue</p>
                    </div>
                    <div class="row">

                        <a href="" class="text-white">
                            <div id="table-2" class="widget bg-danger p-lg text-center">

                                <div class="m-b-md">

                                    <p id="table-notification-2" style="font-size: 15px">Todays Orders</p>

                                    <h3 class="font-bold no-margins">
                                        {{ $todaysOrder }}
                                    </h3>
                                </div>
                            </div>
                        </a>
                        <a href="" class="text-white">
                            <div id="table-2" class="widget bg-danger p-lg text-center">

                                <div class="m-b-md">

                                    <p id="table-notification-2" style="font-size: 15px">Todays Peding</p>

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

                                    <p id="table-notification-2" style="font-size: 15px">Todays Earnings</p>

                                    <h3 class="font-bold no-margins ">
                                        ${{ $todaysEarnings }}
                                    </h3>
                                </div>
                            </div>
                        </a>
                        <a href="" class="text-white">
                            <div id="table-2" class="widget bg-danger p-lg text-center">

                                <div class="m-b-md">

                                    <p id="table-notification-2" style="font-size: 15px">This Month Earnings</p>

                                    <h3 class="font-bold no-margins ">
                                        ${{ $monthEarnings }}
                                    </h3>
                                </div>
                            </div>
                        </a>
                        <a href="" class="text-white">
                            <div id="table-2" class="widget bg-danger p-lg text-center">

                                <div class="m-b-md">

                                    <p id="table-notification-2" style="font-size: 15px">This Years Earnings</p>

                                    <h3 class="font-bold no-margins ">
                                        ${{ $yearEarnings }}
                                    </h3>
                                </div>
                            </div>
                        </a>






                    </div>
                </div>
                <div class="col-md-12">
                    <div class="title">
                        <p style="font-size: 25px" class="text-danger">Number of products and categories</p>
                    </div>
                    <div class="row">
                        <a href="" class="text-white">
                            <div id="table-2" class="widget bg-danger p-lg text-center">

                                <div class="m-b-md">

                                    <p id="table-notification-2" style="font-size: 15px">Total categories</p>

                                    <h3 class="font-bold no-margins ">
                                        {{ $totalCategories }}
                                    </h3>
                                </div>
                            </div>
                        </a>


                        <a href="" class="text-white">
                            <div id="table-2" class="widget bg-danger p-lg text-center">

                                <div class="m-b-md">

                                    <p id="table-notification-2" style="font-size: 15px">Total products</p>

                                    <h3 class="font-bold no-margins ">
                                        {{ $totalProducts }}
                                    </h3>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>



                <div class="Order statistics">
                    <div id="curve_chart" style="width: 100%; height: 500px"></div>
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
                ['Day', 'Total Amount ($)'],

                <?php echo $chart_data; ?>


            ]);

            var options = {
                title: 'Order statistics',
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
