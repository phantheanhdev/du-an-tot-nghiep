<!DOCTYPE html>
<html>
<head>
    <title>Order Bill</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <div class="card mt-5">
            <div class="card-header">
                <h1 class="text-center">Order Bill</h1>
                <h4>Số bàn: 12</h4>
                <h5>Thời gian order: </h5>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Tên thức ăn / uống</th>
                            <th scope="col">Số lượng</th>
                            <th scope="col">Đơn giá</th>
                        </tr>
                    </thead>
                    <tbody id="billItems">
                        <!-- Đây là nơi bạn sẽ thêm các hàng món ăn vào hóa đơn -->
                    </tbody>
                </table>
            </div>
            <div class="card-footer text-center">
                <button class="btn btn-primary" onclick="printBill()">Print</button>
            </div>
        </div>
    </div>

    <script>
        function printBill() {
            window.print();
        }

        // Đoạn mã dưới đây là ví dụ về cách thêm các món ăn vào hóa đơn
        var billItems = document.getElementById('billItems');
        var items = [
            { name: 'Hamburger', quantity: 2, price: 10 },
            { name: 'French Fries', quantity: 1, price: 5 },
            { name: 'Coke', quantity: 3, price: 2 }
        ];

        items.forEach(function(item) {
            var row = document.createElement('tr');
            var nameCell = document.createElement('td');
            var quantityCell = document.createElement('td');
            var priceCell = document.createElement('td');

            nameCell.textContent = item.name;
            quantityCell.textContent = item.quantity;
            priceCell.textContent = '$' + (item.quantity * item.price);

            row.appendChild(nameCell);
            row.appendChild(quantityCell);
            row.appendChild(priceCell);

            billItems.appendChild(row);
        });
    </script>
</body>
</html>
