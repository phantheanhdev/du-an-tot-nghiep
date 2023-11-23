@extends('user.layout.content')
@section('main-content')
    <style>
        #scrollToTopBtn {
            display: none;
            position: fixed;
            bottom: 30px;
            right: 40px;
            background-color: #fab4b1;
            color: #fafafa;
            border: none;
            border-radius: 5px;
            padding: 10px;
            cursor: pointer;
        }
    </style>
    <div id="wrapper">
        <div id="page-wrapper" class="gray-bg">
            <nav class="navbar navbar-expand-sm navbar-toggleable-sm navbar-dark bg-primary box-shadow mb-3">
                <div class="container">
                    <a class="navbar-brand" href="#">FOODIE MENU</a>
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



                            <li class="dropdown-item">
                                <a href="/Account/ChangePassword">Change Password</a>
                            </li>
                            <li class="divider"></li>
                            <li class="dropdown-item">
                                <form
                                    action="{{ route('customer.logout', ['tableNo' => $tableNo, 'tableId' => $tableId]) }}"
                                    method="post">
                                    @csrf
                                    <button type="submit" class="btn btn-danger">Logout</button>
                                </form>
                            </li>
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
                                <h3 class="col-md-12">Giỏ hàng <i class="fa fa-cart-arrow-down float-right"></i></h3>
                                <input hidden value="&#x20AB;" id="txtCurrency" />
                                <input hidden value="TOTAL" id="txtTotal" />
                                <input hidden value="Your cart is empty yet." id="txtEmptyCart" />
                                <input hidden value="Please complete your selections." id="txtSelectOptions" />
                            </div>
                            <div class="ibox-content ibox-br">

                                <form id="orderForm" enctype="multipart/form-data">
                                    @csrf

                                    <input type="hidden" name="table_id" value="{{ $tableId }}">
                                    <input type="hidden" name="status" value="0">
                                    <input type="hidden" name="phone" value="0">
                                    {{-- <input type="hidden" name="customer_phone" value="0"> --}}


                                    <table class="table table-borderless">
                                        <tbody id="cartContentsHtml">

                                            @php $total = 0 @endphp

                                            @if (session('cart'))
                                                @foreach (session('cart') as $id => $details)
                                                    @php $total += $details['price'] * $details['quantity'] @endphp
                                                    <input type="hidden" value="{{ $total }}" id="total_price"
                                                        name="total_price">

                                                    <tr>
                                                        <td style="width:60%" class="cart-item">
                                                            {{ $details['name'] }}<br> <span
                                                                class="text-menu-description text-muted"></span> </td>

                                                        <td><input onblur="updateQuantity()" id="cartquantity-3"
                                                                class="quantity-input" value="{{ $details['quantity'] }}">
                                                        </td>

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
                                                    <h5>Tổng</h5>
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
                                        <textarea class="form-control" name="note" maxlength="70" rows="2" placeholder="Ghi chú"></textarea>
                                    </div>
                                    <button type="button" id="placeOrder" onclick="submitOrder(<?= $tableId ?>)"
                                        class="btn btn-primary btn-outline btn-block mt-4 btn-sm"> Order</button>
                                </form>
                                {{-- <style>
                                        .bought--item {
                                            background-color: #fff;
                                        }

                                        .component__combo-editor,
                                        .component__item-editor {
                                            -webkit-box-shadow: 1px 2px 12px 0 rgba(0, 0, 0, .1215686275);
                                            box-shadow: 1px 2px 12px 0 rgba(0, 0, 0, .1215686275);
                                            padding: 12px;
                                            border-radius: 8px;
                                            margin-bottom: 10px;
                                            position: relative;
                                        }

                                        .component__item-editor {
                                            background-color: #fff;
                                        }

                                        .component__item-editor .table-rule {
                                            width: 100%;
                                            font-size: 1.2em;
                                        }

                                        .image__item-cart {
                                            width: 70px;
                                            height: 70px;
                                            background-size: cover;
                                            background-repeat: no-repeat;
                                            background-position: 50%;
                                            border-radius: 5px;
                                            background-color: #f5f5f5;
                                        }

                                        .td--product-name {
                                            color: #363636;
                                            font-weight: 400;
                                            font-size: 14px;
                                            padding-left: 5px;
                                        }

                                        .component__card-description-bound {
                                            min-height: 20px !important;
                                        }

                                        .component__card-description-bound {
                                            font-weight: 400;
                                            position: relative;
                                            color: grey !important;
                                        }

                                        .price-and-edit-text__container {
                                            display: -webkit-box;
                                            display: -ms-flexbox;
                                            display: flex;
                                            -webkit-box-pack: justify;
                                            -ms-flex-pack: justify;
                                            justify-content: space-between;
                                        }

                                        .origin-price,
                                        .component__item-editor .origin-price {
                                            font-size: 14px;
                                            color: #363636;
                                            font-weight: 400;
                                        }

                                        .price-and-edit-text__container .edit-text {
                                            font-size: 13px;
                                            font-weight: 500;
                                            line-height: 16px;
                                            letter-spacing: 0;
                                        }

                                        .price-and-edit-text__container>div {
                                            display: -webkit-box;
                                            display: -ms-flexbox;
                                            display: flex;
                                            -webkit-box-align: center;
                                            -ms-flex-align: center;
                                            align-items: center;
                                        }
                                    </style>
                                    <div class="component__cart-table">
                                        <div class="bought--item">
                                            <div class="component__item-editor">
                                                <table class="table-rule">
                                                    <tbody>
                                                        <tr>
                                                            <td rowspan="2" style="width: 78px; vertical-align: top;">
                                                                <div class="image__item-cart"
                                                                    style="background-image: url(&quot;/static/images/default_food.svg&quot;);">
                                                                </div>
                                                            </td>
                                                            <td class="td--product-name" style="vertical-align: top;"><span
                                                                    style="font-weight: 500; color: rgb(247, 148, 30); font-size: 14px;">1
                                                                    x</span> <span class="name"
                                                                    style="font-size: 14px; font-weight: 500;">Sữa
                                                                    đặc</span><br>
                                                                <div class="component__card-description-bound"
                                                                    style="color: rgb(54, 54, 54); margin-top: 4px;">
                                                                    <!---->
                                                                    <div style="line-height: 1.2; margin-top: 5px;">

                                                                    </div> <!----> <!---->
                                                                </div>
                                                                <div class="price-and-edit-text__container"
                                                                    style="margin-top: 5px;">
                                                                    <div><span class="origin-price">
                                                                            5.000 đ
                                                                        </span> <!----></div>
                                                                    <div class="edit-text"
                                                                        style="color: rgb(247, 148, 30);">
                                                                        Chỉnh sửa
                                                                    </div>
                                                                </div>
                                                                <div class="btn-remove-item-in-cart"><span
                                                                        class="ti-close"></span></div>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="bought--item">
                                            <div class="component__item-editor">
                                                <table class="table-rule">
                                                    <tbody>
                                                        <tr>
                                                            <td rowspan="2" style="width: 78px; vertical-align: top;">
                                                                <div class="image__item-cart"
                                                                    style="background-image: url(&quot;/static/images/default_food.svg&quot;);">
                                                                </div>
                                                            </td>
                                                            <td class="td--product-name" style="vertical-align: top;"><span
                                                                    style="font-weight: 500; color: rgb(247, 148, 30); font-size: 14px;">1
                                                                    x</span> <span class="name"
                                                                    style="font-size: 14px; font-weight: 500;">Sữa
                                                                    đặc</span><br>
                                                                <div class="component__card-description-bound"
                                                                    style="color: rgb(54, 54, 54); margin-top: 4px;">
                                                                    <!---->
                                                                    <div style="line-height: 1.2; margin-top: 5px;">

                                                                    </div> <!----> <!---->
                                                                </div>
                                                                <div class="price-and-edit-text__container"
                                                                    style="margin-top: 5px;">
                                                                    <div><span class="origin-price">
                                                                            5.000 đ
                                                                        </span> <!----></div>
                                                                    <div class="edit-text"
                                                                        style="color: rgb(247, 148, 30);">
                                                                        Chỉnh sửa
                                                                    </div>
                                                                </div>
                                                                <div class="btn-remove-item-in-cart"><span
                                                                        class="ti-close"></span></div>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div> --}}

                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-6" style="padding-right:7px">
                                <button onclick="callTheWaiter(<?= $tableId ?>)" id="btnCallWaiter"
                                    class="call-button btn-block"><img src="{{ asset('upload_file/call-waiter.png') }}">
                                    Gọi Nhân Viên</button>
                            </div>
                            <div class="col-6" style="padding-left:7px">
                                <button onclick="callPayment(<?= $tableId ?>)" id="btnCallBill"
                                    class="call-button btn-block"><img src="{{ asset('upload_file/get-money.png') }}">
                                    Thanh toán</button>
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
                                <h3 class=" d-flex text-qrRest-dark font-weight-bold text-styling">Chào
                                    <b class="mx-1">
                                        <?php
                                        
                                        date_default_timezone_set('Asia/Ho_Chi_Minh');
                                        $currentHour = date('G');
                                        
                                        if ($currentHour >= 5 && $currentHour < 12) {
                                            $timeOfDay = 'buổi sáng';
                                        } elseif ($currentHour >= 12 && $currentHour < 17) {
                                            $timeOfDay = 'buổi chiều';
                                        } elseif ($currentHour >= 17 && $currentHour < 20) {
                                            $timeOfDay = 'buổi chiều';
                                        } else {
                                            $timeOfDay = 'buổi tối';
                                        }
                                        
                                        echo "$timeOfDay";
                                        ?>
                                        @if (auth()->check())
                                            {{ Auth::guard('customer')->user()->phone }}
                                        @endif
                                    </b>
                                </h3>
                                <span>
                                    Bạn đang ngồi ở bàn: <b>
                                        <?= $tableNo ?>
                                    </b>
                                </span>
                            </div>
                        </div>
                        <div id="isNotList" style="display: block;">
                            <div>
                                @foreach ($productsByCategory as $categoryName => $products)
                                    <h3 class="mt-4"> <i class="fa fa-star-o text-qrRest"></i>{{ $categoryName }}
                                    </h3>
                                    <hr>
                                    <div class="row">
                                        @foreach ($products as $product)
                                            <div class="col-md-4">
                                                <div class="ibox">
                                                    <div class="ibox-content product-box" style="height:370px;">
                                                        {{-- <div class="product-imitation"
                                                                style="background-image:url('{{ asset($product->image) }}'); background-size:cover;">
                                                            </div> --}}

                                                        <div class="product-imitation"
                                                            style="background-image:url({{ Storage::url($product->image) }}); background-size:cover;">
                                                        </div>

                                                        <div class="product-desc">
                                                            <span class="product-price">
                                                                {{ number_format($product->price) }} đ
                                                            </span>
                                                            <input type="hidden" id="product-price-{{ $product->id }}"
                                                                value="{{ $product->price }}">
                                                            <small class="text-muted"> {{ $categoryName }} </small>
                                                            <a class="product-name"
                                                                id="product-name-{{ $product->id }}">
                                                                {{ $product->name }}</a>
                                                            <div class="small m-t-xs" style="height:28px">
                                                                {{ $product->description }} </div>
                                                            <div class="m-t mx-auto">
                                                                <div class="row">
                                                                    {{-- <input id="txtQuantity-{{ $product->id }}"
                                                                            class="product-quantity-input ml-3"
                                                                            value="1" max="99"> --}}
                                                                    {{-- <button onclick="addToCart({{ $product->id }})"
                                                                            class="btn btn-sm btn-outline btn-primary ml-1">
                                                                            Thêm
                                                                            <i class="fa fa-long-arrow-right mt-1"></i>
                                                                        </button> --}}
                                                                    <button class="btn btn-sm btn-outline btn-primary ml-1"
                                                                        data-toggle="modal"
                                                                        data-target="#exampleModalScrollable-product-{{ $product->id }}">
                                                                        Thêm
                                                                        <i class="fa fa-long-arrow-right mt-1"></i>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach

                                        @foreach ($products as $product)
                                            <div class="modal fade"
                                                id="exampleModalScrollable-product-{{ $product->id }}" tabindex="-1"
                                                role="dialog" aria-labelledby="exampleModalScrollableTitle"
                                                aria-hidden="true">
                                                <div class="modal-dialog bd-example-modal-lg" role="document">
                                                    <form class="shopping-cart-form">

                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h3 class="modal-title" id="exampleModalScrollableTitle">
                                                                    {{ $product->name }}</h3>
                                                                <button type="button" class="close"
                                                                    data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>

                                                            <div class="modal-body">
                                                                <div class="row">
                                                                    <div class="product-image">
                                                                        <img src="{{ Storage::url($product->image) }}"
                                                                            class="img-fluid" alt="Responsive image">
                                                                    </div>
                                                                </div>
                                                                <div class="row bg-danger">
                                                                    <div class="product-name p-2 text-white">
                                                                        <h3 class="text-center">{{ $product->name }}
                                                                        </h3>
                                                                    </div>
                                                                </div>

                                                                <div class="row bg-danger">
                                                                    <div class="">
                                                                        @if ($product->flashSale === 1)
                                                                            @php
                                                                                $saleProduct = \App\Models\FlashSaleItem::where('product_id', $product->id)->first();

                                                                                $start_date = $saleProduct->start_date;

                                                                                $end_date = $saleProduct->end_date;

                                                                                $discount_rate = $saleProduct->discount_rate;

                                                                            @endphp
                                                                            @if ($product->flashSale === 1 && now()->between($start_date, $end_date))
                                                                                @php

                                                                                    $newPrice = newPrice($product->price, $discount_rate);
                                                                                @endphp
                                                                                <span class=""
                                                                                    style="font-size: 20px;">
                                                                                    <del class="px-2 bg-danger">
                                                                                        {{ number_format($product->price) }}
                                                                                        đ</del>
                                                                                    {{ number_format($newPrice) }}
                                                                                    đ
                                                                                    <input type="hidden"
                                                                                        id="product-price-{{ $product->id }}"
                                                                                        value="{{ $newPrice }}">
                                                                                </span>
                                                                            @else
                                                                                <span class="px-2"
                                                                                    style="font-size: 20px;">
                                                                                    {{ number_format($product->price) }}
                                                                                    đ
                                                                                    <input type="hidden"
                                                                                        id="product-price-{{ $product->id }}"
                                                                                        value="{{ $product->price }}">
                                                                                </span>
                                                                            @endif
                                                                        @else
                                                                            <span class="px-2" style="font-size: 20px;">
                                                                                {{ number_format($product->price) }} đ
                                                                                <input type="hidden"
                                                                                    id="product-price-{{ $product->id }}"
                                                                                    value="{{ $product->price }}">
                                                                            </span>
                                                                        @endif

                                                                    </div>
                                                                </div>
                                                                <div class="row properties mt-4">
                                                                    @foreach ($product->variants as $variant)
                                                                        <div class="box col-md-12 mb-4">
                                                                            <span>{{ $variant->name }}</span>
                                                                            <div class="choose">
                                                                                @if ($variant->multi_choice === 0)
                                                                                    @foreach ($variant->productVariantItems as $variantItem)
                                                                                        <div class="form-check">
                                                                                            <input class="form-check-input"
                                                                                                type="radio"
                                                                                                name="variants_items[]"
                                                                                                id="variants_item"
                                                                                                value="{{ $variantItem->id }}"
                                                                                                required>
                                                                                            <label class="form-check-label"
                                                                                                for="exampleRadios1">
                                                                                                {{ $variantItem->name }}
                                                                                                :
                                                                                                <span
                                                                                                    class="text-danger">{{ $variantItem->price }}đ</span>
                                                                                            </label>
                                                                                        </div>
                                                                                    @endforeach
                                                                                @elseif($variant->multi_choice === 1)
                                                                                    @foreach ($variant->productVariantItems as $variantItem)
                                                                                        <div class="form-check">
                                                                                            <input class="form-check-input"
                                                                                                type="checkbox"
                                                                                                name="variants_items[]"
                                                                                                id="variants_item"
                                                                                                value="{{ $variantItem->id }}">
                                                                                            <label class="form-check-label"
                                                                                                for="defaultCheck1">
                                                                                                {{ $variantItem->name }}
                                                                                                :
                                                                                                <span
                                                                                                    class="text-danger">{{ $variantItem->price }}đ</span>
                                                                                            </label>
                                                                                        </div>
                                                                                    @endforeach
                                                                                @endif
                                                                            </div>
                                                                        </div>
                                                                        <hr>
                                                                    @endforeach
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">


                                                                <div class="product_qty_wrapper">
                                                                    <div class="btn-minus btn btn-danger">-</div>
                                                                    <input type="number" class="product-qty"
                                                                        id="txtQuantity-{{ $product->id }}"
                                                                        value="1" name="quantity" readonly />
                                                                    <div class="btn-plus btn btn-danger">+</div>
                                                                </div>

                                                                <button type="button"
                                                                    onclick="addToCart({{ $product->id }})"
                                                                    class="btn btn-primary">Thêm</button>

                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <br />
                <br />
                <button id="scrollToTopBtn" title="Go to top">Top</button>

                <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
                    integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
                    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
                <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
                <script>
                    $(document).ready(function() {

                        $(".btn-plus").on("click", function() {
                            var currentValue = parseInt($(".product-qty").val());
                            $(".product-qty").val(currentValue <= 10 ? currentValue + 1 : 10);
                        });
                        $(".btn-minus").on("click", function() {
                            var currentValue = parseInt($(".product-qty").val());
                            $(".product-qty").val(currentValue > 1 ? currentValue - 1 : 1);
                        });
                    });
                </script>

                <script>
                    var csrfToken = @json(csrf_token());

                    function updateTotalPrice() {
                        var totalPrice = 0;

                        // Lặp qua từng biến thể
                        $('.box').each(function() {
                            var selectedVariantPrice = 0;

                            // Lấy giá của biến thể được chọn
                            $(this).find('input:checked').each(function() {
                                var variantPrice = parseFloat($(this).siblings('label').find('.text-danger').text());
                                selectedVariantPrice += variantPrice;
                            });

                            // Cộng giá biến thể vào tổng giá
                            totalPrice += selectedVariantPrice;
                        });

                        return totalPrice
                        // Bạn có thể cập nhật giao diện người dùng với giá mới ở đây
                    }

                    // Hàm để thêm sản phẩm vào giỏ hàng
                    function addToCart(productId) {
                        var inputElement = document.getElementById('txtQuantity-' + productId);
                        var currentQuantity = parseFloat(inputElement.value);

                        var productNameElement = document.getElementById('product-name-' + productId);

                        if (productNameElement) {
                            var productName = productNameElement.textContent;
                        } else {
                            console.log('Không tìm thấy phần tử sản phẩm với ID ' + productId);
                            return; // Thoát khỏi hàm nếu phần tử sản phẩm không được tìm thấy
                        }
                        var productPriceElement = document.getElementById('product-price-' + productId);
                        var productPrice = parseFloat(productPriceElement.value);

                        var quantity = currentQuantity; // Số lượng sản phẩm bạn muốn thêm

                        // Lấy giá sản phẩm và giá các item được chọn
                        var selectedItemsPrice = updateTotalPrice();

                        // Cập nhật giá sản phẩm bằng cách cộng giá sản phẩm và giá các item được chọn
                        var totalPrice = productPrice + selectedItemsPrice;

                        $.ajax({
                            type: 'POST',
                            url: '/add-to-cart/' + productId,
                            data: {
                                _token: csrfToken,
                                product_id: productId,
                                product_name: productName,
                                item: quantity: quantity,
                                price: totalPrice, // Sử dụng giá tính toán tổng cả sản phẩm và các item
                            },
                            success: function(response) {
                                updateCartContentsHtml(response.cart);

                                Command: toastr["success"]("Đã thêm sản phẩm vào giỏ hàng");

                                toastr.options = {
                                    "closeButton": false,
                                    "debug": false,
                                    "newestOnTop": false,
                                    "progressBar": false,
                                    "positionClass": "toast-top-right",
                                    "preventDuplicates": false,
                                    "onclick": null,
                                    "showDuration": "300",
                                    "hideDuration": "1000",
                                    "timeOut": "5000",
                                    "extendedTimeOut": "1000",
                                    "showEasing": "swing",
                                    "hideEasing": "linear",
                                    "showMethod": "fadeIn",
                                    "hideMethod": "fadeOut"
                                };
                            }
                        });

                        console.log('Đã thêm sản phẩm có ID ' + productId + ' vào giỏ hàng.');
                    }

                    // function addToCart(productId) {
                    //     var inputElement = document.getElementById('txtQuantity-' + productId);
                    //     var currentQuantity = parseFloat(inputElement.value);

                    //     var productNameElement = document.getElementById('product-name-' + productId);
                    //     var productPriceElement = document.getElementById('product-price-' + productId);

                    //     if (productNameElement && productPriceElement) {
                    //         var productName = productNameElement.textContent;
                    //         var productPrice = parseFloat(productPriceElement.value);
                    //     } else {
                    //         console.log('Không tìm thấy phần tử sản phẩm với ID ' + productId);
                    //     }
                    //     var quantity = currentQuantity; // Số lượng sản phẩm bạn muốn thêm

                    //     $.ajax({
                    //         type: 'POST',
                    //         url: '/add-to-cart/' + productId, // Đường dẫn đến API route bạn đã tạo
                    //         data: {
                    //             _token: csrfToken,
                    //             product_id: productId,
                    //             product_name: productName,
                    //             quantity: quantity,
                    //             price: productPrice,
                    //         },
                    //         success: function(response) {
                    //             // alert();
                    //             updateCartContentsHtml(response.cart);

                    //             Command: toastr["success"]("Đã thêm sản phẩm vào giỏ hàng")

                    //             toastr.options = {
                    //                 "closeButton": false,
                    //                 "debug": false,
                    //                 "newestOnTop": false,
                    //                 "progressBar": false,
                    //                 "positionClass": "toast-top-right",
                    //                 "preventDuplicates": false,
                    //                 "onclick": null,
                    //                 "showDuration": "300",
                    //                 "hideDuration": "1000",
                    //                 "timeOut": "5000",
                    //                 "extendedTimeOut": "1000",
                    //                 "showEasing": "swing",
                    //                 "hideEasing": "linear",
                    //                 "showMethod": "fadeIn",
                    //                 "hideMethod": "fadeOut"
                    //             }
                    //         }
                    //     });
                    //     console.log('Đã thêm sản phẩm có ID ' + productId + ' vào giỏ hàng.');

                    // }


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
                                    updateCartContentsHtml(response.cart)
                                }
                            });
                        }
                    };
                </script>
                <script>
                    function submitOrder(id) {
                        updateCart()
                        var total_price = document.getElementById('total_price')
                        if (total_price.value > 0) {
                            Command: toastr["warning"]("Đang gửi yêu cầu đặt món")

                            toastr.options = {
                                "closeButton": false,
                                "debug": false,
                                "newestOnTop": false,
                                "progressBar": false,
                                "positionClass": "toast-top-right",
                                "preventDuplicates": false,
                                "onclick": null,
                                "showDuration": "300",
                                "hideDuration": "1000",
                                "timeOut": "5000",
                                "extendedTimeOut": "1000",
                                "showEasing": "swing",
                                "hideEasing": "linear",
                                "showMethod": "fadeIn",
                                "hideMethod": "fadeOut"
                            }
                            var formData = new FormData(document.getElementById('orderForm'));
                            $.ajax({
                                type: 'POST',
                                url: '/order', // Đặt đường dẫn đúng
                                data: formData,
                                contentType: false,
                                processData: false,
                                success: function(response) {
                                    Command: toastr["success"]("Đặt món thành công")

                                    toastr.options = {
                                        "closeButton": false,
                                        "debug": false,
                                        "newestOnTop": false,
                                        "progressBar": false,
                                        "positionClass": "toast-top-right",
                                        "preventDuplicates": false,
                                        "onclick": null,
                                        "showDuration": "300",
                                        "hideDuration": "1000",
                                        "timeOut": "5000",
                                        "extendedTimeOut": "1000",
                                        "showEasing": "swing",
                                        "hideEasing": "linear",
                                        "showMethod": "fadeIn",
                                        "hideMethod": "fadeOut"
                                    }
                                    pusher_order(id);
                                    updateCart();
                                },
                                error: function(error) {
                                    console.log('Error submitting order:', error);
                                }
                            })
                        }
                        else {
                            Command: toastr["warning"]("Giỏ hàng trống !")

                            toastr.options = {
                                "closeButton": false,
                                "debug": false,
                                "newestOnTop": false,
                                "progressBar": false,
                                "positionClass": "toast-top-right",
                                "preventDuplicates": false,
                                "onclick": null,
                                "showDuration": "300",
                                "hideDuration": "1000",
                                "timeOut": "5000",
                                "extendedTimeOut": "1000",
                                "showEasing": "swing",
                                "hideEasing": "linear",
                                "showMethod": "fadeIn",
                                "hideMethod": "fadeOut"
                            }
                        }
                    }

                    function updateCart() {
                        $.ajax({
                            type: 'GET',
                            url: '/get-cart',
                            success: function(response) {
                                updateCartContentsHtml(response.cart, response.total);
                            },
                            error: function(error) {
                                console.log('Error updating cart:', error);
                            }
                        });
                    }

                    function formatNumberWithCommas(number) {
                        return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                    }


                    function updateCartContentsHtml(cart) {
                        var total = 0;
                        var cartContentsHtml = '';

                        if (cart) {
                            for (var id in cart) {
                                if (cart.hasOwnProperty(id)) {
                                    var details = cart[id];
                                    total += details['price'] * details['quantity'];
                                    var price_id = formatNumberWithCommas(details['price']);
                                    cartContentsHtml += '<tr>' +
                                        '<td style="width:60%" class="cart-item">' + details['name'] + '<br>' +
                                        '<span class="text-menu-description text-muted"></span></td>' +
                                        '<td><input onblur="updateQuantity(' + id + ')" id="cartquantity-' + id + '" ' +
                                        'class="quantity-input" value="' + details['quantity'] + '"></td>' +
                                        '<td style="width:28%;" class="cart-item">$' + price_id + '</td>' +
                                        '<td><a onclick="remove_product(' + id + ')" class="float-right">' +
                                        '<i class="fa fa-times text-qrRestremove-from-cart"></i></a></td>' +
                                        '</tr>';
                                }
                            }
                        }

                        var formattedTotal = formatNumberWithCommas(total);

                        cartContentsHtml += ' <input type="hidden" value="' + total +
                            '" name="total_price" id="total_price"><tr class="spacer">' +
                            '<td class="cart-item"><h5>TOTAL</h5></td>' +
                            '<td></td>' +
                            '<td class="cart-item"><strong>$ ' + formattedTotal + '</strong></td>' +
                            '<td></td>' +
                            '</tr>';

                        $('#cartContentsHtml').html(cartContentsHtml);
                    }

                    function callTheWaiter(id) {
                        var contentsData = "Bàn " + id + " gọi nhân viên";

                        var postData = {
                            contents: contentsData,
                            id: id

                        };

                        $.ajax({
                            url: '/pusher',
                            type: 'GET',
                            data: postData,
                            success: function(response) {
                                Command: toastr["success"]("Yêu cầu đã được gửi đi")

                                toastr.options = {
                                    "closeButton": false,
                                    "debug": false,
                                    "newestOnTop": false,
                                    "progressBar": true,
                                    "positionClass": "toast-top-right",
                                    "preventDuplicates": false,
                                    "onclick": null,
                                    "showDuration": "300",
                                    "hideDuration": "1000",
                                    "timeOut": "5000",
                                    "extendedTimeOut": "1000",
                                    "showEasing": "swing",
                                    "hideEasing": "linear",
                                    "showMethod": "fadeIn",
                                    "hideMethod": "fadeOut"
                                }
                            },
                            error: function(xhr, status, error) {
                                console.error(error);
                            }
                        });

                    }

                    function pusher_order(id) {
                        var contentsData = "Bàn " + id + " có đơn order mới !";

                        var postData = {
                            contents: contentsData,
                            id: id
                        };

                        $.ajax({
                            url: '/pusher',
                            type: 'GET',
                            data: postData,
                            success: function(response) {
                                console.log("Đã gửi yêu cầu pusher");
                            },
                            error: function(xhr, status, error) {
                                console.error(error);
                            }
                        });

                    }

                    function callPayment(id) {
                        var contentsData = "Bàn " + id + " gọi thanh toán";

                        var postData = {
                            contents: contentsData,
                            id: id

                        };

                        $.ajax({
                            url: '/pusher', // Đường dẫn tới trang xử lý
                            type: 'GET', // Phương thức HTTP POST
                            data: postData, // Dữ liệu POST
                            // dataType: 'json', // Loại dữ liệu bạn mong muốn nhận được từ máy chủ
                            success: function(response) {
                                Command: toastr["success"]("Yêu cầu đã được gửi đi")

                                toastr.options = {
                                    "closeButton": false,
                                    "debug": false,
                                    "newestOnTop": false,
                                    "progressBar": true,
                                    "positionClass": "toast-top-right",
                                    "preventDuplicates": false,
                                    "onclick": null,
                                    "showDuration": "300",
                                    "hideDuration": "1000",
                                    "timeOut": "5000",
                                    "extendedTimeOut": "1000",
                                    "showEasing": "swing",
                                    "hideEasing": "linear",
                                    "showMethod": "fadeIn",
                                    "hideMethod": "fadeOut"
                                }
                            },
                            error: function(xhr, status, error) {
                                console.error(error);
                            }
                        });

                    }
                </script>
                <script>
                    // Wait for the DOM to be ready
                    document.addEventListener("DOMContentLoaded", function() {
                        // Get the button element
                        var scrollToTopBtn = document.getElementById("scrollToTopBtn");

                        // Show the button when the user scrolls down 20px from the top of the document
                        window.onscroll = function() {
                            if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
                                scrollToTopBtn.style.display = "block";
                            } else {
                                scrollToTopBtn.style.display = "none";
                            }
                        };

                        // Scroll to the top when the button is clicked
                        scrollToTopBtn.onclick = function() {
                            document.body.scrollTop = 0; // For Safari
                            document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE, and Opera
                        };
                    });
                </script>
            </div>
        </div>
    </div>
    </div>
@endsection
