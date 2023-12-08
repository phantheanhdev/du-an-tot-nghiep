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

        .bought--item {
            background-color: #fff;
        }

        .component__combo-editor,
        .component__item-editor {

            /* -webkit-box-shadow: 1px 2px 12px 0 rgba(0, 0, 0, .1215686275);
                                                                                                                                                                        box-shadow: 1px 2px 12px 0 rgba(0, 0, 0, .1215686275); */
            main padding: 2px;
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

        .total-price__v2 {
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            margin-top: 12px;
            padding: 0 12px;
            -webkit-box-pack: justify;
            -ms-flex-pack: justify;
            justify-content: space-between;
        }

        .rating-point {
            color: yellow;
            font-weight: bolder;
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
                    {{-- <div class="navbar-collapse collapse d-sm-inline-flex justify-content-between">
                        <ul class="navbar-nav mx-auto">

                        </ul>

                        <ul class="nav navbar-top-links">
                                        <li class="dropdown-item">
                                            <a href="/Account/ChangePassword">Change Password</a>
                                        </li>
                                        <li class="divider"></li>
                                        <li class="dropdown-item"><a href="/Account/logout">Logout</a></li>
                                    </ul>
                                </div>
                            </li>

                        </ul>
                    </div> --}}
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

                                    {{-- <form id="orderForm" enctype="multipart/form-data">
                                        @csrf

                                        <input type="hidden" name="table_id" value="{{ $tableId }}">
                                        <input type="hidden" name="status" value="0">
                                        <input type="hidden" name="customer_name" value="BBB">
                                        <input type="hidden" name="phone" value="0">
                                        <input type="hidden" name="customer_phone" value="{{ Auth::guard('customer')->user()->phone }}">


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
                                                                    class="text-menu-description text-muted">fdf</span> </td>

                                                            <td><input onblur="updateQuantity()" id="cartquantity-3"
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
                                                        <h5>Tổng</h5>
                                                    </td>
                                                    <td></td>
                                                    <td class="cart-item"> <strong>{{ number_format($total) }} đ</strong>
                                                    </td>
                                                    <td></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <hr>
                                        <div class="form-group" id="txtOrderIsReady">
                                            <textarea class="form-control" name="note" maxlength="70" rows="2" placeholder="Ghi chú"></textarea>
                                        </div>
                                        <button type="button" id="placeOrder" onclick="submitOrder(<?= $tableNo ?>)"
                                            class="btn btn-primary btn-outline btn-block mt-4 btn-sm"> Đặt món</button>
                                    </form> --}}
                                    <form id="orderForm" enctype="multipart/form-data">
                                        @csrf

                                        <input type="hidden" name="table_id" value="{{ $tableId }}">
                                        <input type="hidden" name="status" value="0">
                                        <input type="hidden" name="customer_name" value="BBB">
                                        <input type="hidden" name="phone"
                                            value="{{ Auth::guard('customer')->user()->phone }}">
                                        <input type="hidden" name="customer_id"
                                            value="{{ Auth::guard('customer')->user()->id }}">
                                        <input type="hidden" name="customer_phone"
                                            value="{{ Auth::guard('customer')->user()->phone }}">
                                        @php $total = 0 @endphp


                                        <div class="component__cart-table" id="cartContentsHtml">
                                            @if (session('cart'))
                                                @foreach (session('cart') as $id => $details)
                                                    @php $total += $details['price'] * $details['quantity'] @endphp

                                                    <div class="bought--item">
                                                        <div class="component__item-editor">
                                                            <table class="table-rule">
                                                                <tbody>
                                                                    <tr>
                                                                        <td rowspan="2"
                                                                            style="width: 78px; vertical-align: top;">
                                                                            <div class="image__item-cart"
                                                                                style="background-image: url(&quot;/static/images/default_food.svg&quot;);">
                                                                            </div>
                                                                        </td>
                                                                        <td class="td--product-name"
                                                                            style="vertical-align: top;"><span
                                                                                style="font-weight: 500; color: #910400; font-size: 14px;">{{ $details['quantity'] }}
                                                                                x</span> <span class="name"
                                                                                style="font-size: 14px; font-weight: 500;">{{ $details['name'] }}</span><br>
                                                                            <div class="component__card-description-bound"
                                                                                style="color: rgb(54, 54, 54); margin-top: 4px;">
                                                                                <div
                                                                                    style="line-height: 1.2; margin-top: 5px;">
                                                                                    @php
                                                                                        $itemDetails = json_decode($details['item'], true);
                                                                                        if (is_array($itemDetails) && !empty($itemDetails)) {
                                                                                            foreach ($itemDetails as $item) {
                                                                                                $itemName = $item['name'] ?? '';
                                                                                                echo '- ' . $itemName . '<br>';
                                                                                            }
                                                                                        }
                                                                                    @endphp

                                                                                    {{-- {{ $itemName }} --}}
                                                                                </div> <!----> <!---->
                                                                            </div>
                                                                            <div class="price-and-edit-text__container"
                                                                                style="margin-top: 5px;">
                                                                                <div><span class="origin-price">
                                                                                        {{ number_format($details['price']) }}
                                                                                        đ
                                                                                    </span> <!----></div>
                                                                                {{-- <div class="edit-text"
                                                                                    style="color: rgb(247, 148, 30);">
                                                                                    <button class="btn btn-link" type="button" onclick="remove_product({{ $id }})">Xóa</button>

                                                                                </div> --}}
                                                                            </div>
                                                                            <div class="btn-remove-item-in-cart"><span
                                                                                    class="ti-close"></span></div>
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                    <hr>
                                                @endforeach
                                            @endif

                                            @if (auth()->check() && Auth::guard('customer')->user()->point > 0)
                                                <input type="hidden" value="{{ Auth::guard('customer')->user()->point }}"
                                                    id="point">
                                                <input type="hidden" value="" id="pointAdd" name="point">
                                                <div style="display: flex; justify-content: space-between;"
                                                    id="show-point-2">
                                                    <div class="">
                                                        <input type="checkbox" class="mr-2" id="buttonSubmit">
                                                        <label for="buttonSubmit" class=""
                                                            style="font-size: 14px">Dùng
                                                            {{ number_format(Auth::guard('customer')->user()->point) }}
                                                            điểm Foodie</label>
                                                    </div>
                                                    <div class="">
                                                        <p class="text-danger" style="font-size: 14px">
                                                            -{{ number_format(Auth::guard('customer')->user()->point) }} đ
                                                        </p>
                                                    </div>
                                                </div>
                                            @endif

                                            <div class="total-price__v2 mb-2">
                                                <input type="hidden" value="{{ $total }}" id="total_price"
                                                    name="total_price">
                                                <div>
                                                    <h3><b>Tổng tiền</b></h3>
                                                </div>
                                                <div>
                                                    <h3><b id="total">{{ number_format($total) }} đ</b></h3>
                                                </div>
                                            </div>


                                        </div>

                                        <div class="form-group" id="txtOrderIsReady">
                                            <textarea class="form-control" name="note" maxlength="70" rows="2" placeholder="Ghi chú"></textarea>
                                        </div>
                                        <button type="button" id="placeOrder" onclick="submitOrder(<?= $tableNo ?>)"
                                            class="btn btn-primary btn-outline btn-block mt-4 btn-sm"> Đặt món</button>
                                    </form>

                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-6" style="padding-right:7px">
                                    <button onclick="callTheWaiter(<?= $tableNo ?>)" id="btnCallWaiter"
                                        class="call-button btn-block"><img
                                            src="{{ asset('upload_file/call-waiter.png') }}">
                                        Gọi Nhân Viên</button>
                                </div>
                                <div class="col-6" style="padding-left:7px">
                                    <button onclick="callPayment(<?= $tableNo ?>)" id="btnCallBill"
                                        class="call-button btn-block"><img
                                            src="{{ asset('upload_file/get-money.png') }}">
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
                                            
                                            if ($currentHour >= 5 && $currentHour < 10) {
                                                $timeOfDay = 'buổi sáng';
                                            } elseif ($currentHour >= 10 && $currentHour < 13) {
                                                $timeOfDay = 'buổi trưa';
                                            } elseif ($currentHour >= 13 && $currentHour < 18) {
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
                                                                {{-- <input type="hidden"
                                                                    id="product-price-{{ $product->id }}"
                                                                    value="{{ $product->price }}"> --}}
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
                                                                        <button
                                                                            class="btn btn-sm btn-outline btn-primary ml-1"
                                                                            data-toggle="modal"
                                                                            data-target="#exampleModalScrollable-product-{{ $product->id }}">
                                                                            Thêm
                                                                            <i class="fa fa-long-arrow-right mt-1"></i>
                                                                        </button>
                                                                        <button
                                                                        class="btn btn-sm btn-outline btn-primary ml-1"
                                                                        data-toggle="modal"
                                                                        data-target="#exampleModalScrollable-product-review-{{ $product->id }}">
                                                                        Đánh giá

                                                                        <i class="fa-solid fa-star mt-1"></i>
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
                                                    id="exampleModalScrollable-product-{{ $product->id }}"
                                                    tabindex="-1" role="dialog"
                                                    aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
                                                    <div class="modal-dialog bd-example-modal-lg" role="document">
                                                        <form class="shopping-cart-form">

                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h3 class="modal-title"
                                                                        id="exampleModalScrollableTitle">
                                                                        {{ $product->name }}</h3>
                                                                    <button type="button" class="close"
                                                                        data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>

                                                                <div class="modal-body">
                                                                    {{-- <div class="row">
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
                                                                    </div> --}}

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
                                                                                <span class="px-2"
                                                                                    style="font-size: 20px;">
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
                                                                                                <input
                                                                                                    class="form-check-input"
                                                                                                    type="radio"
                                                                                                    name="variants_items[]"
                                                                                                    id="variants_item"
                                                                                                    value="{{ $variantItem->id }}"
                                                                                                    required>
                                                                                                <label
                                                                                                    class="form-check-label"
                                                                                                    for="exampleRadios1">
                                                                                                    {{ $variantItem->name }}
                                                                                                    :
                                                                                                    <span
                                                                                                        class="text-danger">{{ number_format($variantItem->price) }}đ</span>
                                                                                                </label>

                                                                                            </div>
                                                                                        @endforeach
                                                                                    @elseif($variant->multi_choice === 1)
                                                                                        @foreach ($variant->productVariantItems as $variantItem)
                                                                                            <div class="form-check">
                                                                                                <input
                                                                                                    class="form-check-input"
                                                                                                    type="checkbox"
                                                                                                    name="variants_items[]"
                                                                                                    id="variants_item"
                                                                                                    value="{{ $variantItem->id }}">
                                                                                                <label
                                                                                                    class="form-check-label"
                                                                                                    for="defaultCheck1">
                                                                                                    {{ $variantItem->name }}
                                                                                                    :
                                                                                                    <span
                                                                                                        class="text-danger">{{ number_format($variantItem->price) }}đ</span>
                                                                                                </label>
                                                                                            </div>
                                                                                        @endforeach
                                                                                    @endif
                                                                                </div>
                                                                            </div>
                                                                            <hr>
                                                                        @endforeach
                                                                    </div>
                                                                    <div class="numbers-row">
                                                                        <input type="text" value="1"
                                                                            id="txtQuantity-{{ $product->id }}"
                                                                            class="qty2 form-control" name="quantity">
                                                                        <div class="inc button_inc">+</div>
                                                                        <div class="dec button_inc">-</div>
                                                                    </div>
                                                                </div>
                                                                {{-- <div class="product_qty_wrapper">
                                                                    <div class="btn-minus btn btn-danger">-</div>
                                                                    <input type="number" class="product-qty"
                                                                        id="txtQuantity-{{ $product->id }}"
                                                                        value="1" name="quantity" readonly />
                                                                    <div class="btn-plus btn btn-danger">+</div>
                                                                </div> --}}
                                                                <div class="modal-footer">

                                                                    <button type="button"
                                                                        onclick="addToCart({{ $product->id }})"
                                                                        class="btn btn-primary">Thêm</button>

                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            @endforeach

                                              {{-- Đánh giá sản phẩm --}}
                                              @foreach ($products as $product)
                                              <div class="modal fade"
                                                  id="exampleModalScrollable-product-review-{{ $product->id }}"
                                                  tabindex="-1" role="dialog"
                                                  aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
                                                  <div class="modal-dialog bd-example-modal-lg" role="document">
                                                      <form action="{{ route('review.create') }}" method="post"
                                                          class="feedback-product-form">
                                                          @csrf
                                                          <div class="modal-content">
                                                              <div class="modal-header">
                                                                  <h3 class="modal-title"
                                                                      id="exampleModalScrollableTitle">
                                                                      Đánh giá từ khách hàng : {{ $product->name }}</h3>
                                                                  <button type="button" class="close"
                                                                      data-dismiss="modal" aria-label="Close">
                                                                      <span aria-hidden="true">&times;</span>
                                                                  </button>
                                                              </div>

                                                              <div class="modal-body">


                                                                  @if (Auth::guard('customer')->check())
                                                                      @php
                                                                          $isBrought = false;
                                                                          $orders = \App\Models\Order::where([
                                                                              'customer_id' => Auth::guard('customer')->user()->id,
                                                                          ])->get();
                                                                          foreach ($orders as $key => $order) {
                                                                              $exisItem = $order
                                                                                  ->orderdetails()
                                                                                  ->where('product_id', $product->id)
                                                                                  ->first();
                                                                              if ($exisItem) {
                                                                                  $isBrought = true;
                                                                              }
                                                                          }
                                                                      @endphp
                                                                      @if (Auth::guard('customer')->user()->isComment === 1 && $isBrought == true)
                                                                          <div class="product-review mb-4">
                                                                              <p class="rating">
                                                                                  <span>Số điểm (sao) : </span>
                                                                              </p>

                                                                              <div class="row">

                                                                                  <div class="col-xl-12 mb-4">
                                                                                      <select name="rating"
                                                                                          class="form-control">
                                                                                          <option value="">Chọn
                                                                                          </option>
                                                                                          <option value="1">1
                                                                                          </option>
                                                                                          <option value="2">2
                                                                                          </option>
                                                                                          <option value="3">3
                                                                                          </option>
                                                                                          <option value="4">4
                                                                                          </option>
                                                                                          <option value="5">5
                                                                                          </option>
                                                                                      </select>
                                                                                  </div>
                                                                                  <input type="hidden"
                                                                                      name="customer_id"
                                                                                      value="{{ Auth::guard('customer')->user()->id }}">
                                                                                  <input type="hidden"
                                                                                      name="product_id"
                                                                                      value="{{ $product->id }}">
                                                                                  <div class="col-xl-12">

                                                                                      <div class="wsus__single_com">
                                                                                          <textarea cols="3" rows="3" name="comment" class="form-control" placeholder="Đánh giá của bạn"
                                                                                              required>{{ old('comment') }}</textarea>
                                                                                      </div>

                                                                                  </div>
                                                                              </div>

                                                                          </div>
                                                                      @else
                                                                          <p>Hãy gọi món để đánh giá sản phẩm</p>
                                                                      @endif
                                                                  @endif





                                                                  <hr>

                                                                  <div class="list-product-review mt-4">


                                                                      @php
                                                                          $feedbacks = \App\Models\Feedback::where('product_id', $product->id)
                                                                              ->orderBy('id', 'desc')
                                                                              ->paginate(10);
                                                                          $countFeedback = \App\Models\Feedback::where('product_id', $product->id)->count();
                                                                      @endphp
                                                                      @if ($countFeedback > 0)
                                                                          <p class="text-center fs-3">Các đánh giá khác
                                                                          </p>

                                                                          @foreach ($feedbacks as $feedback)
                                                                              <div class=" mt-3">
                                                                                  <h5 style="font-size: 15px;">
                                                                                      {{ $feedback->customer->phone }}
                                                                                      <span>({{ date('d M Y', strtotime($feedback->created_at)) }})</span>
                                                                                  </h5>

                                                                                  <div>
                                                                                      {{-- Render kiểu này hơi đần --}}
                                                                                      <div class="rating-point">
                                                                                          @if ($feedback->rating == 1)
                                                                                              <i
                                                                                                  class="fa-solid fa-star"></i>
                                                                                          @elseif($feedback->rating == 2)
                                                                                              <i
                                                                                                  class="fa-solid fa-star"></i>
                                                                                              <i
                                                                                                  class="fa-solid fa-star"></i>
                                                                                          @elseif($feedback->rating == 3)
                                                                                              <i
                                                                                                  class="fa-solid fa-star"></i>
                                                                                              <i
                                                                                                  class="fa-solid fa-star"></i>
                                                                                              <i
                                                                                                  class="fa-solid fa-star"></i>
                                                                                          @elseif($feedback->rating == 4)
                                                                                              <i
                                                                                                  class="fa-solid fa-star"></i>
                                                                                              <i
                                                                                                  class="fa-solid fa-star"></i>
                                                                                              <i
                                                                                                  class="fa-solid fa-star"></i>
                                                                                              <i
                                                                                                  class="fa-solid fa-star"></i>
                                                                                          @else
                                                                                              <i
                                                                                                  class="fa-solid fa-star"></i>
                                                                                              <i
                                                                                                  class="fa-solid fa-star"></i>
                                                                                              <i
                                                                                                  class="fa-solid fa-star"></i>
                                                                                              <i
                                                                                                  class="fa-solid fa-star"></i>
                                                                                              <i
                                                                                                  class="fa-solid fa-star"></i>
                                                                                          @endif



                                                                                      </div>
                                                                                      <p>{{ $feedback->comment }}</p>
                                                                                  </div>
                                                                              </div>
                                                                          @endforeach
                                                                      @else
                                                                          <p class="text-center fs-3">Chưa có đánh giá
                                                                              nào !</p>
                                                                      @endif


                                                                  </div>








                                                              </div>

                                                              <div class="modal-footer">

                                                                  @if (Auth::guard('customer')->check())
                                                                      @if (Auth::guard('customer')->user()->isComment === 1)
                                                                          <button type="submit"
                                                                              class="btn btn-primary">Đánh
                                                                              giá</button>
                                                                      @else
                                                                          <button type="submit" disabled
                                                                              class="btn btn-primary">Hãy đặt món
                                                                              nào</button>
                                                                      @endif
                                                                  @endif


                                                              </div>
                                                          </div>
                                                      </form>


                                                  </div>
                                              </div>
                                          @endforeach
                                          {{-- ----------------- --}}
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <br />
                    <br />
                    <button id="scrollToTopBtn" title="Go to top">Top</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script>
        // $(document).ready(function() {
        $(".inc").on("click", function() {
            var currentValue = parseInt($(".qty2").val());
            $(".qty2").val(currentValue <= 10 ? currentValue + 1 : 10);
        });
        $(".dec").on("click", function() {
            var currentValue = parseInt($(".qty2").val());
            $(".qty2").val(currentValue > 1 ? currentValue - 1 : 1);
        });

        $(document).on('change', '#buttonSubmit', function() {
            if ($(this).prop('checked')) {
                isCheckedPoint = true;
                console.log('Checkbox đã được tích.');
                layDiem();
            } else {
                console.log('Checkbox chưa được tích.');
                isCheckedPoint = false;
                boDiem();
                // Add handling code when the checkbox is not checked here
            }
        });

        let isCheckedPoint = false;

        var daThucHienFunction = false;

        function layDiem() {
            if (!daThucHienFunction) {
                var diem = document.getElementById('point').value;
                if (diem > 0) {
                    var tong = document.getElementById('total_price').value;
                    tong = tong - diem;
                    document.getElementById('total_price').value = tong;
                    document.getElementById('pointAdd').value = diem;
                    document.getElementById('total').innerHTML = formatNumberWithCommas(tong) + " đ"
                    console.log(tong);
                    daThucHienFunction = true;
                    Command: toastr["success"]("Đã đổi POINT ");

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
            }
        }

        function boDiem() {
            if (daThucHienFunction) {
                var diem = document.getElementById('pointAdd').value;
                if (diem > 0) {
                    var tong = document.getElementById('total_price').value;
                    tong = parseFloat(tong) + parseFloat(diem); // Convert to float to handle decimals
                    document.getElementById('total_price').value = tong;
                    document.getElementById('pointAdd').value = "";
                    document.getElementById('total').innerHTML = formatNumberWithCommas(tong) + " đ";
                    console.log(tong);
                    daThucHienFunction = false;

                    Command: toastr["success"]("Đã bỏ POINT ");

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
            }
        }



        function getSelectedItemsInfo() {
            var selectedItemsInfo = [];

            // Lặp qua các phần tử input có name là 'variants_items[]'
            var variantItems = document.querySelectorAll('input[name="variants_items[]"]:checked');

            variantItems.forEach(function(item) {
                var label = item.parentElement; // Lấy phần tử label chứa thông tin
                var itemName = label.innerText.trim(); // Lấy tên mục
                var itemPriceText = label.querySelector('.text-danger').textContent; // Lấy giá mục
                var itemPrice = parseFloat(itemPriceText.replace('đ', '').replace(',',
                    '')); // Chuyển đổi giá thành số

                // Thêm thông tin vào mảng
                selectedItemsInfo.push({
                    name: itemName,
                    price: itemPrice
                });
            });

            // Trả về dữ liệu JSON
            return JSON.stringify(selectedItemsInfo);
        }
        var csrfToken = @json(csrf_token());

        function updateTotalPrice() {
            var totalPrice = 0;

            // Lặp qua từng biến thể
            $('.box').each(function() {
                var selectedVariantPrice = 0;

                // Lấy giá của biến thể được chọn
                $(this).find('input:checked').each(function() {
                    var variantPrice = $(this).siblings('label').find('.text-danger').text();
                    var itemPrice = parseFloat(variantPrice.replace('đ', '').replace(',',
                        '')); // Chuyển đổi giá thành số
                    selectedVariantPrice += itemPrice;

                });

                // Cộng giá biến thể vào tổng giá
                totalPrice += selectedVariantPrice;
            });


            return totalPrice
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
            console.log(productPrice);
            var quantity = currentQuantity; // Số lượng sản phẩm bạn muốn thêm

            // Lấy giá sản phẩm và giá các item được chọn
            var selectedItemsPrice = updateTotalPrice();
            var itemsInfo = getSelectedItemsInfo();
            // Cập nhật giá sản phẩm bằng cách cộng giá sản phẩm và giá các item được chọn
            var totalPrice = productPrice + selectedItemsPrice;

            $.ajax({
                type: 'POST',
                url: '/add-to-cart/' + productId,
                data: {
                    _token: csrfToken,
                    product_id: productId,
                    product_name: productName,
                    item: itemsInfo,
                    quantity: quantity,
                    price: totalPrice, // Sử dụng giá tính toán tổng cả sản phẩm và các item
                },
                success: function(response) {
                    console.log(response);

                    updateCartContentsHtml(response.cart);

                    Command: toastr["success"]("Đã thêm sản phẩm");

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

                    $('.box').each(function() {
                        var selectedVariantPrice = 0;
                        $(this).find('input:checked').each(function() {
                            $(this).prop('checked', false);
                        })
                    })
                    $('#exampleModalScrollable-product-' + productId).modal('hide');
                }
            });

            console.log('Đã thêm sản phẩm có ID ' + productId + ' vào giỏ hàng.');
        }


        function remove_product(id) {
            if (confirm("Are you sure want to remove? ")) {
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

                        if (isCheckedPoint) {
                            $('#show-point-2').hide();
                        }

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
                    console.log(response)
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

                        cartContentsHtml += '<div class="bought--item">' +
                            '<div class="component__item-editor">' +
                            '<table class="table-rule">' +
                            '<tbody>' +
                            '<tr>' +
                            '<td rowspan="2" style="width: 78px; vertical-align: top;">' +
                            '<div class="image__item-cart" style="background-image: url(&quot;/static/images/default_food.svg&quot;);"></div>' +
                            '</td>' +
                            '<td class="td--product-name" style="vertical-align: top;">' +
                            '<span style="font-weight: 500; color: #910400; font-size: 14px;">' +
                            details['quantity'] + ' x</span> ' +
                            '<span class="name" style="font-size: 14px; font-weight: 500;">' +
                            details['name'] + '</span><br>' +
                            '<div class="component__card-description-bound" style="color: rgb(54, 54, 54); margin-top: 4px;">';

                        // Assuming details['item'] is a JSON string
                        var itemDetails = JSON.parse(details['item']);
                        if (Array.isArray(itemDetails) && itemDetails.length > 0) {
                            cartContentsHtml += '<div style="line-height: 1.2; margin-top: 5px;">';
                            for (var i = 0; i < itemDetails.length; i++) {
                                cartContentsHtml += "- " + itemDetails[i]['name'] + '<br>';
                            }
                            cartContentsHtml += '</div>';
                        }

                        cartContentsHtml += '</div>' +
                            '<div class="price-and-edit-text__container" style="margin-top: 5px;">' +
                            '<div><span class="origin-price">' +
                            formatNumberWithCommas(details['price']) + ' đ</span></div>' +
                            '</div>' +
                            '<div class="btn-remove-item-in-cart"><span class="ti-close"></span></div>' +
                            '</td>' +
                            '</tr>' +
                            '</tbody>' +
                            '</table>' +
                            '</div>' +
                            '</div>' +
                            '<hr>';
                    }
                }
            }
            @if (auth()->check() && Auth::guard('customer')->user()->point > 0)
                cartContentsHtml +=
                    '<input type="hidden" value="{{ Auth::guard('customer')->user()->point }}" id="point">';
                cartContentsHtml += '<input type="hidden" value="" id="pointAdd" name="point">';
                cartContentsHtml += '<div style="display: flex; justify-content: space-between;" id="show-point-2">';
                cartContentsHtml += '<div class="">';
                cartContentsHtml += '<input type="checkbox" class="mr-2" id="buttonSubmit">';
                cartContentsHtml += '<label for="buttonSubmit" class="" style="font-size: 14px">Dùng ' +
                    '{{ number_format(Auth::guard('customer')->user()->point) }} điểm Foodie</label>';
                cartContentsHtml += '</div>';
                cartContentsHtml += '<div class="">';
                cartContentsHtml += '<p class="text-danger" style="font-size: 14px">' +
                    '-{{ number_format(Auth::guard('customer')->user()->point) }} đ</p>';
                cartContentsHtml += '</div>';
                cartContentsHtml += '</div>';
            @endif

            var formattedTotal = formatNumberWithCommas(total);

            cartContentsHtml += '<input type="hidden" value="' + total +
                '" name="total_price" id="total_price"><div class="total-price__v2 mb-2">' +
                '<div><h3><b >Tổng tiền</b></h3></div>' +
                '<div><h3><b id="total">' + formattedTotal + ' đ</b></h3></div>' +
                '</div></div>'; // Closing the outermost div for correct structure

            $('#cartContentsHtml').html(cartContentsHtml);

            // display none point if point = 0
            if (isCheckedPoint) {
                $('#show-point-2').hide();
            }
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
            var contentsData = "Bàn " + id + " có đơn mới !";

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

        // })
    </script>
@endsection
