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

                <h3 class="text-qrRest-dark text-center">TABLES</h3>
                <div class="text-center">
                    <span class="badge badge-dark mr-2"><i class="fa fa-cutlery"></i> : There are
                        customers</span>
                    <span class="badge badge-dark mr-2"> <i class="fa fa-minus"></i> : The table is
                        empty</span>
                    <span class="badge badge-dark mr-2"> <i class="fa fa-bell"></i> : Have a new
                        order</span>
                </div>

                <hr />
                <div class="col-md-12">
                    <div class="row">
                        <div id="table-2" class="widget black-bg p-lg text-center">
                            <a href="/restaurant/OrdersOfTable/2" class="text-white">
                                <div class="m-b-md">
                                    <i id="table-icon-2" class="fa fa-minus fa-4x"></i>
                                    <br />
                                    <small id="table-notification-2">The table is empty</small>

                                    <h3 class="font-bold no-margins">
                                        Table No : 68
                                    </h3>
                                </div>
                            </a>
                        </div>
                        <div id="table-5" class="widget black-bg p-lg text-center">
                            <a href="/restaurant/OrdersOfTable/5" class="text-white">
                                <div class="m-b-md">
                                    <i id="table-icon-5" class="fa fa-minus fa-4x"></i>
                                    <br />
                                    <small id="table-notification-5">The table is empty</small>

                                    <h3 class="font-bold no-margins">
                                        Table No : 4
                                    </h3>
                                </div>
                            </a>
                        </div>
                        <div id="table-6" class="widget black-bg p-lg text-center">
                            <a href="/restaurant/OrdersOfTable/6" class="text-white">
                                <div class="m-b-md">
                                    <i id="table-icon-6" class="fa fa-minus fa-4x"></i>
                                    <br />
                                    <small id="table-notification-6">The table is empty</small>

                                    <h3 class="font-bold no-margins">
                                        Table No : 5
                                    </h3>
                                </div>
                            </a>
                        </div>
                        <div id="table-7" class="widget black-bg p-lg text-center">
                            <a href="/restaurant/OrdersOfTable/7" class="text-white">
                                <div class="m-b-md">
                                    <i id="table-icon-7" class="fa fa-minus fa-4x"></i>
                                    <br />
                                    <small id="table-notification-7">The table is empty</small>

                                    <h3 class="font-bold no-margins">
                                        Table No : 111
                                    </h3>
                                </div>
                            </a>
                        </div>
                        <div id="table-8" class="widget black-bg p-lg text-center">
                            <a href="/restaurant/OrdersOfTable/8" class="text-white">
                                <div class="m-b-md">
                                    <i id="table-icon-8" class="fa fa-minus fa-4x"></i>
                                    <br />
                                    <small id="table-notification-8">The table is empty</small>

                                    <h3 class="font-bold no-margins">
                                        Table No : 103
                                    </h3>
                                </div>
                            </a>
                        </div>
                        <div id="table-11" class="widget black-bg p-lg text-center">
                            <a href="/restaurant/OrdersOfTable/11" class="text-white">
                                <div class="m-b-md">
                                    <i id="table-icon-11" class="fa fa-minus fa-4x"></i>
                                    <br />
                                    <small id="table-notification-11">The table is empty</small>

                                    <h3 class="font-bold no-margins">
                                        Table No : 86
                                    </h3>
                                </div>
                            </a>
                        </div>
                        <div id="table-12" class="widget black-bg p-lg text-center">
                            <a href="/restaurant/OrdersOfTable/12" class="text-white">
                                <div class="m-b-md">
                                    <i id="table-icon-12" class="fa fa-minus fa-4x"></i>
                                    <br />
                                    <small id="table-notification-12">The table is empty</small>

                                    <h3 class="font-bold no-margins">
                                        Table No : 10
                                    </h3>
                                </div>
                            </a>
                        </div>
                        <div id="table-13" class="widget black-bg p-lg text-center">
                            <a href="/restaurant/OrdersOfTable/13" class="text-white">
                                <div class="m-b-md">
                                    <i id="table-icon-13" class="fa fa-minus fa-4x"></i>
                                    <br />
                                    <small id="table-notification-13">The table is empty</small>

                                    <h3 class="font-bold no-margins">
                                        Table No : 90
                                    </h3>
                                </div>
                            </a>
                        </div>
                        <div id="table-15" class="widget black-bg p-lg text-center">
                            <a href="/restaurant/OrdersOfTable/15" class="text-white">
                                <div class="m-b-md">
                                    <i id="table-icon-15" class="fa fa-minus fa-4x"></i>
                                    <br />
                                    <small id="table-notification-15">The table is empty</small>

                                    <h3 class="font-bold no-margins">
                                        Table No : 50
                                    </h3>
                                </div>
                            </a>
                        </div>
                        <div id="table-16" class="widget black-bg p-lg text-center">
                            <a href="/restaurant/OrdersOfTable/16" class="text-white">
                                <div class="m-b-md">
                                    <i id="table-icon-16" class="fa fa-minus fa-4x"></i>
                                    <br />
                                    <small id="table-notification-16">The table is empty</small>

                                    <h3 class="font-bold no-margins">
                                        Table No : 6000
                                    </h3>
                                </div>
                            </a>
                        </div>
                        <div id="table-17" class="widget black-bg p-lg text-center">
                            <a href="/restaurant/OrdersOfTable/17" class="text-white">
                                <div class="m-b-md">
                                    <i id="table-icon-17" class="fa fa-minus fa-4x"></i>
                                    <br />
                                    <small id="table-notification-17">The table is empty</small>

                                    <h3 class="font-bold no-margins">
                                        Table No : 667
                                    </h3>
                                </div>
                            </a>
                        </div>
                        <div id="table-18" class="widget black-bg p-lg text-center">
                            <a href="/restaurant/OrdersOfTable/18" class="text-white">
                                <div class="m-b-md">
                                    <i id="table-icon-18" class="fa fa-minus fa-4x"></i>
                                    <br />
                                    <small id="table-notification-18">The table is empty</small>

                                    <h3 class="font-bold no-margins">
                                        Table No : 301
                                    </h3>
                                </div>
                            </a>
                        </div>
                        <div id="table-19" class="widget black-bg p-lg text-center">
                            <a href="/restaurant/OrdersOfTable/19" class="text-white">
                                <div class="m-b-md">
                                    <i id="table-icon-19" class="fa fa-minus fa-4x"></i>
                                    <br />
                                    <small id="table-notification-19">The table is empty</small>

                                    <h3 class="font-bold no-margins">
                                        Table No : 1234
                                    </h3>
                                </div>
                            </a>
                        </div>
                        <div id="table-20" class="widget black-bg p-lg text-center">
                            <a href="/restaurant/OrdersOfTable/20" class="text-white">
                                <div class="m-b-md">
                                    <i id="table-icon-20" class="fa fa-minus fa-4x"></i>
                                    <br />
                                    <small id="table-notification-20">The table is empty</small>

                                    <h3 class="font-bold no-margins">
                                        Table No : 11
                                    </h3>
                                </div>
                            </a>
                        </div>
                        <div id="table-21" class="widget black-bg p-lg text-center">
                            <a href="/restaurant/OrdersOfTable/21" class="text-white">
                                <div class="m-b-md">
                                    <i id="table-icon-21" class="fa fa-minus fa-4x"></i>
                                    <br />
                                    <small id="table-notification-21">The table is empty</small>

                                    <h3 class="font-bold no-margins">
                                        Table No : 332
                                    </h3>
                                </div>
                            </a>
                        </div>
                        <div id="table-22" class="widget black-bg p-lg text-center">
                            <a href="/restaurant/OrdersOfTable/22" class="text-white">
                                <div class="m-b-md">
                                    <i id="table-icon-22" class="fa fa-minus fa-4x"></i>
                                    <br />
                                    <small id="table-notification-22">The table is empty</small>

                                    <h3 class="font-bold no-margins">
                                        Table No : 123
                                    </h3>
                                </div>
                            </a>
                        </div>
                        <div id="table-23" class="widget black-bg p-lg text-center">
                            <a href="/restaurant/OrdersOfTable/23" class="text-white">
                                <div class="m-b-md">
                                    <i id="table-icon-23" class="fa fa-minus fa-4x"></i>
                                    <br />
                                    <small id="table-notification-23">The table is empty</small>

                                    <h3 class="font-bold no-margins">
                                        Table No : 101
                                    </h3>
                                </div>
                            </a>
                        </div>
                        <div id="table-24" class="widget black-bg p-lg text-center">
                            <a href="/restaurant/OrdersOfTable/24" class="text-white">
                                <div class="m-b-md">
                                    <i id="table-icon-24" class="fa fa-minus fa-4x"></i>
                                    <br />
                                    <small id="table-notification-24">The table is empty</small>

                                    <h3 class="font-bold no-margins">
                                        Table No : 5001
                                    </h3>
                                </div>
                            </a>
                        </div>
                        <div id="table-25" class="widget black-bg p-lg text-center">
                            <a href="/restaurant/OrdersOfTable/25" class="text-white">
                                <div class="m-b-md">
                                    <i id="table-icon-25" class="fa fa-minus fa-4x"></i>
                                    <br />
                                    <small id="table-notification-25">The table is empty</small>

                                    <h3 class="font-bold no-margins">
                                        Table No : 543
                                    </h3>
                                </div>
                            </a>
                        </div>
                        <div id="table-26" class="widget black-bg p-lg text-center">
                            <a href="/restaurant/OrdersOfTable/26" class="text-white">
                                <div class="m-b-md">
                                    <i id="table-icon-26" class="fa fa-minus fa-4x"></i>
                                    <br />
                                    <small id="table-notification-26">The table is empty</small>

                                    <h3 class="font-bold no-margins">
                                        Table No : 199
                                    </h3>
                                </div>
                            </a>
                        </div>
                        <div id="table-27" class="widget black-bg p-lg text-center">
                            <a href="/restaurant/OrdersOfTable/27" class="text-white">
                                <div class="m-b-md">
                                    <i id="table-icon-27" class="fa fa-minus fa-4x"></i>
                                    <br />
                                    <small id="table-notification-27">The table is empty</small>

                                    <h3 class="font-bold no-margins">
                                        Table No : 15
                                    </h3>
                                </div>
                            </a>
                        </div>
                        <div id="table-28" class="widget black-bg p-lg text-center">
                            <a href="/restaurant/OrdersOfTable/28" class="text-white">
                                <div class="m-b-md">
                                    <i id="table-icon-28" class="fa fa-minus fa-4x"></i>
                                    <br />
                                    <small id="table-notification-28">The table is empty</small>

                                    <h3 class="font-bold no-margins">
                                        Table No : 54
                                    </h3>
                                </div>
                            </a>
                        </div>
                        <div id="table-29" class="widget black-bg p-lg text-center">
                            <a href="/restaurant/OrdersOfTable/29" class="text-white">
                                <div class="m-b-md">
                                    <i id="table-icon-29" class="fa fa-minus fa-4x"></i>
                                    <br />
                                    <small id="table-notification-29">The table is empty</small>

                                    <h3 class="font-bold no-margins">
                                        Table No : 105
                                    </h3>
                                </div>
                            </a>
                        </div>
                        <div id="table-30" class="widget black-bg p-lg text-center">
                            <a href="/restaurant/OrdersOfTable/30" class="text-white">
                                <div class="m-b-md">
                                    <i id="table-icon-30" class="fa fa-minus fa-4x"></i>
                                    <br />
                                    <small id="table-notification-30">The table is empty</small>

                                    <h3 class="font-bold no-margins">
                                        Table No : 177
                                    </h3>
                                </div>
                            </a>
                        </div>
                        <div id="table-31" class="widget black-bg p-lg text-center">
                            <a href="/restaurant/OrdersOfTable/31" class="text-white">
                                <div class="m-b-md">
                                    <i id="table-icon-31" class="fa fa-minus fa-4x"></i>
                                    <br />
                                    <small id="table-notification-31">The table is empty</small>

                                    <h3 class="font-bold no-margins">
                                        Table No : 12
                                    </h3>
                                </div>
                            </a>
                        </div>
                        <div id="table-32" class="widget black-bg p-lg text-center">
                            <a href="/restaurant/OrdersOfTable/32" class="text-white">
                                <div class="m-b-md">
                                    <i id="table-icon-32" class="fa fa-minus fa-4x"></i>
                                    <br />
                                    <small id="table-notification-32">The table is empty</small>

                                    <h3 class="font-bold no-margins">
                                        Table No : 17
                                    </h3>
                                </div>
                            </a>
                        </div>
                        <div id="table-34" class="widget black-bg p-lg text-center">
                            <a href="/restaurant/OrdersOfTable/34" class="text-white">
                                <div class="m-b-md">
                                    <i id="table-icon-34" class="fa fa-minus fa-4x"></i>
                                    <br />
                                    <small id="table-notification-34">The table is empty</small>

                                    <h3 class="font-bold no-margins">
                                        Table No : 348
                                    </h3>
                                </div>
                            </a>
                        </div>
                        <div id="table-35" class="widget black-bg p-lg text-center">
                            <a href="/restaurant/OrdersOfTable/35" class="text-white">
                                <div class="m-b-md">
                                    <i id="table-icon-35" class="fa fa-minus fa-4x"></i>
                                    <br />
                                    <small id="table-notification-35">The table is empty</small>

                                    <h3 class="font-bold no-margins">
                                        Table No : 13
                                    </h3>
                                </div>
                            </a>
                        </div>
                        <div id="table-36" class="widget black-bg p-lg text-center">
                            <a href="/restaurant/OrdersOfTable/36" class="text-white">
                                <div class="m-b-md">
                                    <i id="table-icon-36" class="fa fa-minus fa-4x"></i>
                                    <br />
                                    <small id="table-notification-36">The table is empty</small>

                                    <h3 class="font-bold no-margins">
                                        Table No : 102
                                    </h3>
                                </div>
                            </a>
                        </div>
                        <div id="table-37" class="widget black-bg p-lg text-center">
                            <a href="/restaurant/OrdersOfTable/37" class="text-white">
                                <div class="m-b-md">
                                    <i id="table-icon-37" class="fa fa-minus fa-4x"></i>
                                    <br />
                                    <small id="table-notification-37">The table is empty</small>

                                    <h3 class="font-bold no-margins">
                                        Table No : 88
                                    </h3>
                                </div>
                            </a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
