<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Hoá đơn thanh toán</title>
    <script type="text/javascript" src="./statics/jquery/dist/jquery.min.js"></script>
    <script type="text/javascript" src="./statics/moment/min/moment.min.js"></script>
    <script type="text/javascript" src="./statics/bootstrap/dist/js/bootstrap.min.js"></script>
    <script type="text/javascript"
        src="./statics/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.4.1/css/bootstrap.min.css" />
    <link rel="stylesheet"
        href="./statics/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css" />
</head>

<body>
    <div class="container">
        @foreach ($orderDetail as $data)
            {{$data}}
        @endforeach
        <div class="row">
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
    </div>
</body>

</html>
