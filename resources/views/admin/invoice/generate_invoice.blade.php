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
    <div class="d-flex justify-content-between">
        <div>
            <a href="/list-order" class="btn btn-outline btn-primary btn-sm ">
                <i class="fa fa-long-arrow-left mt-1">
                    Back
                </i>
            </a>
        </div>
        <div class="">
            <a href="{{ url('invoice/' . $order->id . '/generate') }}" class="btn btn-primary btn-sm float-end mx-2">
                Export
            </a>
            <a href="{{ url('print_order/' . $order->id) }}" class="btn btn-primary btn-sm float-end px-2 ">
                Print
            </a>
        </div>
    </div>
    <table class="order-details">
        <thead>
            <tr>
                <th width="50%" colspan="2">
                    <h2 class="text-start">Foodie</h2>
                </th>
                <th width="50%" colspan="2" class="text-end company-data">
                    <span>Invoice Id: {{ $order->id }}</span> <br>
                    <span>Date: {{ $todayDate->toDateTimeString() }}</span> <br>
                    <span>Address: Nam Từ Liêm, Hà Nội</span> <br>
                </th>
            </tr>
            <tr class="bg-blue">
                <th width="50%" colspan="2">Order Details</th>
                <th width="50%" colspan="2">User Details</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Order Id:</td>
                <td>{{ $order->id }}</td>
                <td>Full Name:</td>
                <td>{{ $order->customer_name }}</td>
            </tr>
            <tr>
                <td>Ordered Date:</td>
                <td>{{ $order->created_at }}</td>
                <td>Table name</td>
                <td>{{ $order->table->name }}</td>
            </tr>
            <tr>
                <td>Order Status:</td>
                <td>
                    @if ($order->status == 2)
                        Cancelled
                    @elseif ($order->status == 5)
                        Paid
                    @endif
                </td>
                <td>Note</td>
                <td>{{ $order->note }}</td>
            </tr>
        </tbody>
    </table>

    <table class="text-center">
        <thead>
            <tr>
                <th class="no-border text-start heading" colspan="5">
                    Order Items
                </th>
            </tr>
            <tr class="bg-blue">
                <th>ID</th>
                <th>Product</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($bill as $key => $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>
                        {{ $item->product->name }}
                    </td>
                    <td>
                        {{ $item->product->price }}
                    </td>
                    <td>
                        {{ $item->quantity }}
                    </td>
                    <td>
                        {{ $item->total_amount }}
                    </td>
                </tr>
            @endforeach
            <tr>
                <td colspan="4" class="total-heading">Total Amount - <small>Inc. all vat/tax</small> :</td>
                <td colspan="1" class="total-heading">{{ $order->total_price }}</td>
            </tr>
        </tbody>
    </table>

    <br>
    <p class="text-center">
        Thank you for using our service
    </p>
</body>

</html>
