@extends('user.layout.content')
@section('main-content')
    <div id="wrapper">
        <div id="page-wrapper" class="gray-bg">
            <nav class="navbar navbar-expand-sm navbar-toggleable-sm navbar-dark bg-primary box-shadow mb-3">
                <div class="container">
                    <a class="navbar-brand" href="/Account/Login">QR MENU</a>
                    <button class="custom-toggler navbar-toggler" type="button" data-toggle="collapse"
                        data-target=".navbar-collapse" aria-controls="navbarSupportedContent" aria-expanded="false"
                        aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"><i class="fa fa-bars"
                                style="color:#fafafa; font-size:28px;"></i></span>
                    </button>
                    <div class="navbar-collapse collapse d-sm-inline-flex justify-content-between">
                        <ul class="navbar-nav mx-auto">

                        </ul>

                        <ul class="nav navbar-top-links">

                            <li class="nav-item">

                                <div class="dropdown profile-element">
                                    <a class="nav-link" data-toggle="dropdown" aria-expanded="false">
                                        <span>
                                            <i class="fa fa-cutlery mr-2"></i><i class="fa fa-chevron-down ml-1"></i>
                                        </span>
                                    </a>
                                    <ul class="dropdown-menu animated fadeInRight m-t-xs">
                                        <li class="dropdown-item">
                                            <a href="/restaurant/restaurantmanager">Management Panel</a>
                                        </li>

                                        <li class="dropdown-item">
                                            <a href="/Account/ChangePassword">Change Password</a>
                                        </li>
                                        <li class="divider"></li>
                                        <li class="dropdown-item"><a href="/Account/logout">Logout</a></li>
                                    </ul>
                                </div>
                            </li>

                        </ul>
                    </div>
                </div>
            </nav>
            <div class="wrapper wrapper-content">
                <div class="container" style="height: 100%;">

                    <div class="row">
                        <div class="col-md-4">
                            <div class="ibox float-e-margins" id="fboxSf">
                                <div class="ibox-title">
                                    <h3 class="col-md-12">MY CART <i class="fa fa-cart-arrow-down float-right"></i></h3>
                                    <input hidden value="&#x20AB;" id="txtCurrency" />
                                    <input hidden value="TOTAL" id="txtTotal" />
                                    <input hidden value="Your cart is empty yet." id="txtEmptyCart" />
                                    <input hidden value="Please complete your selections." id="txtSelectOptions" />
                                </div>
                                <div class="ibox-content ibox-br">
                                    <form method="post" action="/Order/AddOrder">
                                        <table class="table table-borderless">
                                            <tbody id="cartContentsHtml">
                                                @php $total = 0 @endphp
                                                @if (session('cart'))
                                                    @foreach (session('cart') as $id => $details)
                                                        @php $total += $details['price'] * $details['quantity'] @endphp
                                                        <tr>
                                                            <td style="width:60%" class="cart-item">
                                                                {{ $details['name'] }}<br> <span
                                                                    class="text-menu-description text-muted"></span> </td>
                                                            <td><input onblur="updateQuantity(3)" id="cartquantity-3"
                                                                    class="quantity-input"
                                                                    value="{{ $details['quantity'] }}"></td>
                                                            <td style="width:28%;" class="cart-item">
                                                                ${{ number_format($details['price']) }}</td>
                                                            <td><a onclick="remove_product({{ $details['id'] }})"
                                                                    class="float-right"><i
                                                                        class="fa fa-times text-qrRestremove-from-cart"></i></a>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @endif
                                                <tr class="spacer">
                                                    <td class="cart-item">
                                                        <h5>TOTAL</h5>
                                                    </td>
                                                    <td></td>
                                                    <td class="cart-item"> <strong>$ {{ number_format($total) }}</strong>
                                                    </td>
                                                    <td></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <hr>
                                        <div class="form-group" id="txtOrderIsReady">
                                            <textarea class="form-control" name="OrderNote" maxlength="70" rows="2"
                                                placeholder="Indicate if you have a note for the order"></textarea>
                                        </div>
                                        <button type="submit" onclick="startOrder()" id="placeOrder"
                                            class="btn btn-primary btn-outline btn-block mt-4 btn-sm"> Place the
                                            Order</button>
                                    </form>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-6" style="padding-right:7px">
                                    <button onclick="callTheWaiter(<?= $table ?>)" id="btnCallWaiter" class="call-button btn-block"><img
                                            src="/images/call-waiter.png" /> Gọi nhân viên</button>
                                </div>
                                <div class="col-6" style="padding-left:7px">
                                    <button onclick="callPayment()" id="btnCallBill" class="call-button btn-block"><img
                                            src="/images/get-money.png" /> Gọi thanh toán</button>
                                </div>
                            </div>

                        </div>
                        <div class="col-md-8">
                            <div class="ibox-content m-b-sm border-bottom" id="welcome-lg">
                                <div class="p-xs">
                                    {{-- <div class="float-left m-r-md">
                                    <img alt="image" class="img-md"
                                        src="/images/logos/80735333-a467-43a8-ad98-36c55b23711b.jpg">
                                </div> --}}
                                    <div class="float-right m-r-md">
                                        <button onclick="changeView(1)"
                                            class="btn btn-primary btn-outline btn-flat btn-sm"><i
                                                class="fa fa-list-ul mt-1"></i></button>
                                        <button onclick="changeView(0)"
                                            class="btn btn-primary btn-outline btn-flat btn-sm"><i
                                                class="fa  fa-th-large mt-1"></i></button>
                                    </div>
                                    <h3 class="text-qrRest-dark font-weight-bold text-styling">Chào
                                        <b>
                                            <?php
                                            
                                            date_default_timezone_set('Asia/Ho_Chi_Minh');
                                            $currentHour = date('G');
                                            
                                            if ($currentHour >= 5 && $currentHour < 12) {
                                                $timeOfDay = 'buổi sáng';
                                            } elseif ($currentHour >= 12 && $currentHour < 17) {
                                                $timeOfDay = 'buổi trưa';
                                            } elseif ($currentHour >= 17 && $currentHour < 20) {
                                                $timeOfDay = 'buổi chiều';
                                            } else {
                                                $timeOfDay = 'buổi tối';
                                            }
                                            
                                            echo "$timeOfDay";
                                            ?>
                                        </b> Linh
                                    </h3>
                                    <span>
                                        Bạn đang ngồi bàn <b>
                                            <?= $table ?>
                                        </b>
                                    </span>
                                </div>
                            </div>




                            <div id="isList">
                                @foreach ($productsByCategory as $categoryName => $products)
                                    <div class="ibox float-e-margins">
                                        <div class="ibox-title">
                                            <h3 class="col-md-12"> <i
                                                    class="fa fa-star-o text-qrRest"></i>{{ $categoryName }}
                                            </h3>
                                        </div>
                                        <div class="ibox-content ibox-br">

                                            <table class="table table-hover">
                                                @foreach ($products as $product)
                                                    <tbody>
                                                        <tr>
                                                            <td class="actionOfMenu">
                                                                <div class="row">
                                                                    <input class="menu-quantity-input ml-3"
                                                                        id="txtQuantity-{{ $product->id }}"
                                                                        value="0" />
                                                                    <div onclick="addToCart({{ $product->id }}, true)"
                                                                        class="menu-button ml-1">
                                                                        <i class="fa fa-plus" style="margin-top:5px"></i>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td style="width:70%;" class="cart-item-upFont"
                                                                id="product-name-{{ $product->id }}">
                                                                {{ $product->name }}<br />
                                                            </td>
                                                            <td class="cart-item-upFont"
                                                                id="product-price-{{ $product->id }}">
                                                                {{ number_format($product->price) }} &#x20AB;
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                @endforeach
                                            </table>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <br />
                    <br />
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
                        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
                        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
                    <script>
                        var csrfToken = @json(csrf_token());

                        function addToCart(productId, action) {
                            var inputElement = document.getElementById('txtQuantity-' + productId);
                            var currentQuantity = parseInt(inputElement.value);

                            if (action) {
                                currentQuantity++;
                            } else {
                                currentQuantity--;
                            }

                            if (currentQuantity < 0) {
                                currentQuantity = 0;
                            }

                            inputElement.value = currentQuantity;

                            var productNameElement = document.getElementById('product-name-' + productId);
                            var productPriceElement = document.getElementById('product-price-' + productId);

                            if (productNameElement && productPriceElement) {
                                var productName = productNameElement.textContent;
                                var productPrice = parseFloat(productPriceElement.textContent);
                            } else {
                                console.log('Không tìm thấy phần tử sản phẩm với ID ' + productId);
                            }
                            var quantity = 1; // Số lượng sản phẩm bạn muốn thêm

                            $.ajax({
                                type: 'POST',
                                url: '/add-to-cart/' + productId, // Đường dẫn đến API route bạn đã tạo
                                data: {
                                    _token: csrfToken,
                                    product_id: productId,
                                    product_name: productName,
                                    quantity: quantity,
                                    price: productPrice,
                                },
                                success: function(response) {
                                    // alert(response.message);
                                    window.location.reload();
                                }
                            });
                            console.log('Đã thêm sản phẩm có ID ' + productId + ' vào giỏ hàng.');

                        }


                        function remove_product(id) {
                            if (confirm("Are you sure want to remove? " + id)) {
                                $.ajax({
                                    url: '/remove-from-cart',
                                    method: "DELETE",
                                    data: {
                                        _token: csrfToken,
                                        id: id
                                    },
                                    success: function(response) {
                                        window.location.reload();
                                    }
                                });
                            }
                        };

                        
                    </script>
                    <script>
                        function callTheWaiter(id) {
                            var contentsData = "Bàn "+ id +" gọi nhân viên";

                            var postData = {
                                contents: contentsData
                            };

                            $.ajax({
                                url: '/pusher', // Đường dẫn tới trang xử lý
                                type: 'GET', // Phương thức HTTP POST
                                data: postData, // Dữ liệu POST
                                // dataType: 'json', // Loại dữ liệu bạn mong muốn nhận được từ máy chủ
                                success: function(response) {
                                    alert("Yêu cầu đã được gửi đi");
                                },
                                error: function(xhr, status, error) {
                                    console.error(error);
                                }
                            });

                        }
                    </script>
                    <div class="modal inmodal" id="modal-dialog" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content animated fadeIn">
                                <div class="modal-header">
                                    <h4 id="txtMenuName" class="modal-title mx-auto"></h4>
                                </div>
                                <div class="ibox no-margins" id="boxBA">
                                    <div class="first ibox-content" style="border-top:none;padding:0">
                                        <div class="sk-spinner sk-spinner-wave">
                                            <div class="sk-rect1"></div>
                                            <div class="sk-rect2"></div>
                                            <div class="sk-rect3"></div>
                                            <div class="sk-rect4"></div>
                                            <div class="sk-rect5"></div>
                                        </div>

                                        <div class="content">
                                            <div class="numbers-row">
                                                <input type="text" value="1" id="qty_1"
                                                    class="qty2 form-control" name="quantity">
                                            </div>
                                            <span id="txtFeatureValidation" class="text-danger"></span>
                                            <div id="menuFeatureList">
                                            </div>

                                        </div>
                                        <div class="footer" style="position:inherit">
                                            <div class="row small-gutters">
                                                <div class="col-4">
                                                    <button onclick="cancelModal()"
                                                        class="btn btn-sm btn-outline btn-default btn-block">
                                                        Cancel
                                                        <i class="fa fa-times mt-1"></i>
                                                    </button>
                                                </div>
                                                <div class="col-8">
                                                    <button onclick="addTocart(0, false)"
                                                        class="btn btn-sm btn-outline btn-primary btn-block">
                                                        add
                                                        <i class="fa fa-long-arrow-right mt-1"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            <!-- /Row -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
