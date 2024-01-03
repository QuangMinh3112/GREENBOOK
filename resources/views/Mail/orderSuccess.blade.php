<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Đặt hàng thành công</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            line-height: 1.6;
            color: #333;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f4f4f4;
        }

        h2 {
            color: #333;
        }

        p {
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .total {
            font-weight: bold;
        }

        @media only screen and (max-width: 600px) {
            table {
                font-size: 12px;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div>
            <h2>Đặt hàng thành công</h2>
            <p>Cảm ơn bạn đã mua hàng của chúng tôi</p>
        </div>
        <div>
            <h4>Mã số đơn hàng : {{ $order->code_id }}</h4>
            <h5>Tất cả sản phẩm</h5>
            <table>
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Tên sách</th>
                        <th>Số tiền</th>
                        <th>Số lượng</th>
                        <th>Tổng tiền</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $i = 1;
                    @endphp
                    @foreach ($orderDetail as $data)
                        <tr>
                            <td>{{ $i }}</td>
                            <td>{{ $data->book_name }}</td>
                            <td>{{ $data->book_price }} VNĐ</td>
                            <td>{{ $data->quantity }}</td>
                            <td>{{ $data->book_price * $data->quantity }} VNĐ</td>
                        </tr>
                        @php
                            $i++;
                        @endphp
                    @endforeach
                    <tr class="total">
                        <td colspan="4"><b>Tổng tiền sản phẩm</b></td>
                        <td>
                            <h5>{{ $order->total_product_amount }} VNĐ</h5>
                        </td>
                    </tr>
                    <tr class="total">
                        <td colspan="4"><b>Phí vận chuyển</b></td>
                        <td>
                            <h5>{{ $order->ship_fee }} VNĐ</h5>
                        </td>
                    </tr>
                    <tr class="total">
                        <td colspan="4"><b>Tổng thanh toán</b></td>
                        <td>
                            <h5>{{ $order->total }} VNĐ</h5>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>
