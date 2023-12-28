{{-- <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Hoá đơn thanh toán</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>

    <div class="container">
        <div class="my-3">
            <div class="card">
                <div class="card-header">
                    <h1>Kết quả thanh toán</h1>
                </div>
                <div class="card-body">
                    <div class="d-flex">
                        <h5>Trạng thái thanh toán :</h5>
                        @if ($result === 'Success')
                            <h5 class="text-success mx-3">Thành công</h5>
                        @endif
                    </div>
                    <div class="d-flex">
                        <h5>
                            Mã đơn hàng : {{ $order->order_code }}
                        </h5>
                    </div>
                    <div>
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">STT</th>
                                    <th scope="col">Tên sách</th>
                                    <th scope="col">Số tiền</th>
                                    <th scope="col">Số lượng</th>
                                    <th scope="col">Tổng tiền</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i = 1;
                                @endphp
                                @foreach ($orderDetail as $data)
                                    <tr>
                                        <td> {{ $i }}</td>
                                        <td>{{ $data->book_name }}</td>
                                        <td>{{ $data->book_price }} VNĐ</td>
                                        <td>{{ $data->quantity }}</td>
                                        <td>{{ $data->book_price * $data->quantity }} VNĐ</td>
                                    </tr>
                                    @php
                                        $i++;
                                    @endphp
                                @endforeach
                                <tr class="">
                                    <td colspan="4"><b>Tổng tiền</b></td>
                                    <td>
                                        <h5>{{ $order->total }} VNĐ</h5>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer text-body-secondary">
                </div>
            </div>
        </div>
    </div>
</body>

</html> --}}

<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Thanh toán thành công</title>
    <link href='https://fonts.googleapis.com/css?family=Lato:300,400|Montserrat:700' rel='stylesheet' type='text/css'>
    <style>
        @import url(//cdnjs.cloudflare.com/ajax/libs/normalize/3.0.1/normalize.min.css);
        @import url(//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css);
    </style>
    <link rel="stylesheet" href="https://2-22-4-dot-lead-pages.appspot.com/static/lp918/min/default_thank_you.css">
    <script src="https://2-22-4-dot-lead-pages.appspot.com/static/lp918/min/jquery-1.9.1.min.js"></script>
    <script src="https://2-22-4-dot-lead-pages.appspot.com/static/lp918/min/html5shiv.js"></script>
    <style>
        /* CSS */
        button {
            margin-top: 10px;
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
            border-radius: 4px;
            border: 1px solid #4CAF50;
        }

        button:hover {
            background-color: #45a049;
        }
    </style>
</head>

<body>
    <header class="site-header" id="header">
        <h4 class="site-header__title" data-lead-id="site-header-title">Thanh toán thành công!</h4>
    </header>

    <div class="main-content">
        <i class="fa fa-check main-content__checkmark" id="checkmark"></i>
        <p class="main-content__body" data-lead-id="main-content-body">Đơn hàng của bạn đang chờ để xác nhận, vui lòng
            kiểm tra mail để theo dõi đơn hàng !!!.</p>
    </div>
    <br>
    <br>
    <button id="#close">
        Quay lại trang chủ
    </button>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelector('#close').addEventListener('click', function() {
                window.open('', '_self').close();
            });
        });
    </script>

</body>


</html>
