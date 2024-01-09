{{-- <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        * {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: deepskyblue;
            margin: 0;
            padding: 0;
        }

        .coupon {
            width: 100%;
            max-width: 500px;
            height: 200px;
            border-radius: 10px;
            overflow: hidden;
            margin: auto;
            filter: drop-shadow(0 3px 5px rgba(0, 0, 0, 0.5));
            display: flex;
            align-items: stretch;
            position: relative;
            text-transform: uppercase;
            color: #000;
            background-image: radial-gradient(circle at 0 50%, transparent 25px, gold 26px),
                radial-gradient(circle at 100% 50%, transparent 25px, gold 26px);
            background-size: 50% 100%;
            background-repeat: no-repeat;
            background-position: 0 0, 100% 0;
        }

        .coupon>div {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .left {
            width: 80px;
            border-right: 2px dashed rgba(0, 0, 0, 0.15);
        }

        .left div {
            transform: rotate(-90deg);
            white-space: nowrap;
            font-weight: bold;
            writing-mode: vertical-rl;
        }

        .center {
            flex-grow: 1;
            text-align: center;
            display: flex;
            align-items: center;
            justify-content: center;
            writing-mode: vertical-rl;
        }

        .right {
            width: 120px;
            background-image: radial-gradient(circle at 100% 50%, transparent 25px, #fff 26px);
            writing-mode: vertical-rl;
        }

        .right div {
            font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
            font-size: 2.5rem;
            transform: rotate(-90deg);
        }

        .center h2 {
            background-color: #111;
            color: gold;
            padding: 0 10px;
            font-size: 2.15rem;
            white-space: nowrap;
        }

        .center h3 {
            font-size: 1.5rem;
        }

        .center small {
            font-size: 0.625rem;
            font-weight: 600;
            letter-spacing: 2px;
        }
    </style>
</head>

<body>
    <div class="coupon">
        <div class="left">
            <div>Quà tặng</div>
        </div>
        <div class="center">
            <div>
                <h2>50% off</h2>
                <h3>Coupon</h3>
                <small>Ngày hết hạn {{ \Carbon\Carbon::parse($coupon->end_date)->format('d/m/Y') }}</small>
            </div>
        </div>
        <div class="right">
            <div>0123123123</div>
        </div>
    </div>
</body>
</html> --}}
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Discount Code</title>

    <style>
        body {
            font-family: 'Arial', sans-serif;
            text-align: center;
            margin: 50px;
            background-color: #f7f7f7;
        }

        h1 {
            color: #333;
            margin-bottom: 20px;
        }

        p {
            color: #555;
            margin-bottom: 10px;
        }

        strong {
            color: #333;
        }

        .qr-code {
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: #fff;
            padding: 10px;
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <h2>Chúc mừng bạn đã nhận được mã giảm giá</h2>
    <h3>Thông tin mã giảm giá</h3>

    <p><strong>Code:</strong> {{ $coupon->code }}</p>
    <p><strong>Ngày hết hạn:</strong> {{ $coupon->end_date }}</p>
    @if ($coupon->type === 'percent')
        - {{ $coupon->value }} % của giá trị đơn hàng với đơn hàng trên {{ $coupon->price_required }} VNĐ
    @elseif ($coupon->type === 'number')
        - {{ $coupon->value }} VNĐ tổng giá trị đơn hàng với đơn hàng trên {{ $coupon->price_required }} VNĐ
    @else
        - Miễn phí vận chuyển đơn hàng với đơn hàng trên {{ $coupon->price_required }} VNĐ
    @endif
    Vui lòng truy cập vào website để sử dụng mã giảm giá
</body>

</html>
