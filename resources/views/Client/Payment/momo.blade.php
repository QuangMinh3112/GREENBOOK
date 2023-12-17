<!DOCTYPE html>
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
    {{-- <div class="container my-3">
        <div class="row mx-3">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h1 class="panel-title">Kết quả thanh toán</h1>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12">
                                Payment Status : {{ $result }}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 col-sm-12">
                                <div class="form-group">
                                    <label for="fxRate" class="col-form-label">PartnerCode</label>
                                    <div class='input-group date' id='fxRate'>
                                        <input type='text' name="partnerCode" value="{{ $partnerCode }}"
                                            class="form-control" disabled />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-12">
                                <div class="form-group">
                                    <label for="fxRate" class="col-form-label">AccessKey</label>
                                    <div class='input-group date' id='fxRate'>
                                        <input type='text' name="accessKey" value="{{ $accessKey }}"
                                            class="form-control" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-12">
                                <div class="form-group">
                                    <label for="fxRate" class="col-form-label">OrderId</label>
                                    <div class='input-group date' id='fxRate'>
                                        <input type='text' name="orderId" value="{{ $orderId }}"
                                            class="form-control" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 col-sm-12">
                                <div class="form-group">
                                    <label for="fxRate" class="col-form-label">transId</label>
                                    <div class='input-group date' id='fxRate'>
                                        <input type='text' name="transId" value="{{ $transId }}"
                                            class="form-control" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-12">
                                <div class="form-group">
                                    <label for="fxRate" class="col-form-label">OrderInfo</label>
                                    <div class='input-group date' id='fxRate'>
                                        <input type='text' name="orderInfo" value="{{ $orderInfo }}"
                                            class="form-control" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-12">
                                <div class="form-group">
                                    <label for="fxRate" class="col-form-label">orderType</label>
                                    <div class='input-group date' id='fxRate'>
                                        <input type='text' name="orderType" value="{{ $orderType }}"
                                            class="form-control" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 col-sm-12">
                                <div class="form-group">
                                    <label for="fxRate" class="col-form-label">Amount</label>
                                    <div class='input-group date' id='fxRate'>
                                        <input type='text' name="amount" value="{{ $amount }}"
                                            class="form-control" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-12">
                                <div class="form-group">
                                    <label for="fxRate" class="col-form-label">Message</label>
                                    <div class='input-group date' id='fxRate'>
                                        <input type='text' name="message" value="{{ $message }}"
                                            class="form-control" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-12">
                                <div class="form-group">
                                    <label for="fxRate" class="col-form-label">localMessage</label>
                                    <div class='input-group date' id='fxRate'>
                                        <input type='text' name="localMessage" value="{{ $localMessage }}"
                                            class="form-control" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 col-sm-12">
                                <div class="form-group">
                                    <label for="fxRate" class="col-form-label">payType</label>
                                    <div class='input-group date' id='fxRate'>
                                        <input type='text' name="payType" value="{{ $payType }}"
                                            class="form-control" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-12">
                                <div class="form-group">
                                    <label for="fxRate" class="col-form-label">ExtraData</label>
                                    <div class='input-group date' id='fxRate'>
                                        <input type='text' type="text" name="extraData"
                                            value="{{ $extraData }}" class="form-control" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-12">
                                <div class="form-group">
                                    <label for="fxRate" class="col-form-label">signature</label>
                                    <div class='input-group date' id='fxRate'>
                                        <input type='text' name="signature" value="{{ $m2signature }}"
                                            class="form-control" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <a href="/" class="btn btn-primary">Back to continue payment...</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
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

</html>
