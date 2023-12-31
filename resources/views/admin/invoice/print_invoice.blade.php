<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Invoice {{ $order->id }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        html,
        body {
            margin: 10px;
            padding: 10px;
            font-family: sans-serif;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6,
        p,
        span,
        label {
            font-family: sans-serif;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 0px !important;
        }

        table thead th {
            height: 28px;

            font-size: 16px;
            font-family: sans-serif;
        }

        table,
        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            font-size: 14px;
        }

        .heading {
            font-size: 24px;
            margin-top: 12px;
            margin-bottom: 12px;
            font-family: sans-serif;
        }

        .small-heading {
            font-size: 18px;
            font-family: sans-serif;
        }

        .total-heading {
            font-size: 18px;
            font-weight: 700;
            font-family: sans-serif;
        }

        .order-details tbody tr td:nth-child(1) {
            width: 20%;
        }

        .order-details tbody tr td:nth-child(3) {
            width: 20%;
        }

        .text-start {
            text-align: left;
        }

        .text-end {
            text-align: right;
        }

        .text-center {
            text-align: center;
        }

        .company-data span {
            margin-bottom: 4px;
            display: inline-block;
            font-family: sans-serif;
            font-size: 14px;
            font-weight: 400;
        }

        .no-border {
            border: 1px solid #fff !important;
        }

        .bg-blue {
            background-color: #414ab1;
            color: #fff;
        }
    </style>
</head>

<body>

    <table class="order-details">
        <thead>
            <tr>
                <th width="50%" colspan="2">
                    <h2 class="text-start">Foodie</h2>
                </th>
                <th width="50%" colspan="2" class="text-end company-data">
                    <span>Hoa don: {{ $order->id }}</span> <br>
                    <span>Ngay xuat: {{ $todayDate->toDateTimeString() }}</span> <br>
                    <span>Dia chi: Nam Tu Liem , Ha Noi</span> <br>
                </th>
            </tr>
            <tr class="bg-blue">
                <th width="50%" colspan="2">Chi tiet don hang</th>
                <th width="50%" colspan="2">Thong tin khach hang</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Hoa don:</td>
                <td>{{ $order->id }}</td>
                <td>SDT:</td>
                <td>{{ $order->phone }}</td>
            </tr>
            <tr>
                <td>Ngay mua:</td>
                <td>{{ $order->created_at }}</td>
                <td>Ban</td>
                <td>{{ $order->table->name }}</td>
            </tr>
            <tr>
                <td>Trang thai:</td>
                <td>
                    @if ($order->status == 2)
                        Da huy
                    @elseif ($order->status == 5)
                        Da thanh toan
                    @endif
                </td>
                <td>Ghi chu :</td>
                <td>{{ $order->note }}</td>
            </tr>
        </tbody>
    </table>

    <table class="text-center">
        <thead>
            <tr>
                <th class="no-border text-start heading" colspan="5">
                    Don hang
                </th>
            </tr>
            <tr class="bg-blue">
                <th>STT</th>
                <th>San pham</th>
                <th>Gia</th>
                <th>So luong</th>
                <th>Thanh tien</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($bill as $key => $orderDetail)
                <tr>
                    <td>{{ $orderDetail->id }}</td>
                    <td>
                        @if ($orderDetail->product == null)
                            <p style="padding: 5px;color:#910400;text-align:left;">
                                @php
                                    $name = 'Không xác định';
                                @endphp
                                {{ convertVietnameseToEnglish($name) }}
                            </p>
                        @else
                            {{ convertVietnameseToEnglish($orderDetail->product->name) }} <br>
                            @if (!empty($orderDetail->item))
                                @php
                                    $items = json_decode($orderDetail->item, true);
                                    $item1 = json_decode($items);
                                @endphp
                                @if ($item1 != null)
                                    @foreach ($item1 as $item)
                                        - {{ convertVietnameseToEnglish($item->name) }} <br>
                                    @endforeach
                                @endif
                            @endif

                        @endif
                    </td>
                    <td>
                        {{ $orderDetail->product_price }}
                    </td>
                    <td>
                        {{ $orderDetail->quantity }}
                    </td>
                    <td>
                        {{ $orderDetail->total_amount }}
                    </td>
                </tr>
            @endforeach
            <tr>

                <td colspan="4" class="total-heading">Tong Tien <small></small> :</td>
                <td colspan="1" class="total-heading">{{ $order->total_price }}</td>
            </tr>
        </tbody>
    </table>

    <br>
    <p class="text-center">
        Cam on ban da su dung dich vu cua chung toi
    </p>
</body>

</html>
@if (session('open_new_tab'))
    <script>
        window.open('{{ url('/print_order/' . $order->id) }}', '_blank');
    </script>
@endif
