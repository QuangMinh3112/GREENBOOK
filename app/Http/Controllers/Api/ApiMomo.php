<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class ApiMomo extends Controller
{
    public function execPostRequest($url, $data)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt(
            $ch,
            CURLOPT_HTTPHEADER,
            array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data)
            )
        );
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }
    public function momo_payment(Request $request, $order_id)
    {
        $order = Order::find($order_id);
        if ($order) {
            $endpoint = "https://test-payment.momo.vn/gw_payment/transactionProcessor";
            $partnerCode = "MOMOBKUN20180529";
            $accessKey = "klm05TvNBzhg7h7j";
            $secretKey = "at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa";
            $orderInfo = "Thanh toán qua MoMo";
            $amount = strval($order->total);
            $orderId = $order->order_code;
            $returnUrl = "http://127.0.0.1:8000/momo-response";
            $notifyurl = "http://localhost:8000/atm/ipn_momo.php";
            // Lưu ý: link notifyUrl không phải là dạng localhost
            $bankCode = "SML";
            $orderid = $order->order_code;
            $requestId = time() . "";
            $requestType = "payWithMoMoATM";
            $extraData = "";
            //before sign HMAC SHA256 signature
            $rawHashArr =  array(
                'partnerCode' => $partnerCode,
                'accessKey' => $accessKey,
                'requestId' => $requestId,
                'amount' => $amount,
                'orderId' => $orderid,
                'orderInfo' => $orderInfo,
                'bankCode' => $bankCode,
                'returnUrl' => $returnUrl,
                'notifyUrl' => $notifyurl,
                'extraData' => $extraData,
                'requestType' => $requestType
            );
            $rawHash = "partnerCode=" . $partnerCode . "&accessKey=" . $accessKey . "&requestId=" . $requestId . "&bankCode=" . $bankCode . "&amount=" . $amount . "&orderId=" . $orderid . "&orderInfo=" . $orderInfo . "&returnUrl=" . $returnUrl . "&notifyUrl=" . $notifyurl . "&extraData=" . $extraData . "&requestType=" . $requestType;
            $signature = hash_hmac("sha256", $rawHash, $secretKey);

            $data =  array(
                'partnerCode' => $partnerCode,
                'accessKey' => $accessKey,
                'requestId' => $requestId,
                'amount' => $amount,
                'orderId' => $orderid,
                'orderInfo' => $orderInfo,
                'returnUrl' => $returnUrl,
                'bankCode' => $bankCode,
                'notifyUrl' => $notifyurl,
                'extraData' => $extraData,
                'requestType' => $requestType,
                'signature' => $signature
            );
            $result = $this->execPostRequest($endpoint, json_encode($data));
            $jsonResult = json_decode($result, true);
            $url = $jsonResult['payUrl'];
            return response()->json(['url' => $url], 200);
        }
    }
    public function fallBack()
    {
        $secretKey = 'at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa';

        if (!empty($_GET)) {
            $secretKey = 'at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa';
            $partnerCode = request("partnerCode");
            $accessKey = request("accessKey");
            $orderId = request("orderId");
            $order = Order::where("order_code", "like", "%" . $orderId . "%")->first();
            $localMessage = request("localMessage");
            $message = request("message");
            $transId = request("transId");
            $orderInfo = request("orderInfo");
            $amount = request("amount");
            $errorCode = request("errorCode");
            $responseTime = request("responseTime");
            $requestId = request("requestId");
            $extraData = request("extraData");
            $payType = request("payType");
            $orderType = request("orderType");
            $extraData = request("extraData");
            $m2signature = request("signature"); //MoMo signature
            //Checksum
            $rawHash = "partnerCode=" . $partnerCode . "&accessKey=" . $accessKey . "&requestId=" . $requestId . "&amount=" . $amount . "&orderId=" . $orderId . "&orderInfo=" . $orderInfo .
                "&orderType=" . $orderType . "&transId=" . $transId . "&message=" . $message . "&localMessage=" . $localMessage . "&responseTime=" . $responseTime . "&errorCode=" . $errorCode .
                "&payType=" . $payType . "&extraData=" . $extraData;

            $partnerSignature = hash_hmac("sha256", $rawHash, $secretKey);

            echo "<script>console.log('Debug huhu Objects: " . $rawHash . "' );</script>";
            echo "<script>console.log('Debug huhu Objects: " . $secretKey . "' );</script>";
            echo "<script>console.log('Debug huhu Objects: " . $partnerSignature . "' );</script>";


            if ($m2signature == $partnerSignature) {
                if ($errorCode == '0') {
                    $result = 'Success';
                    $order->payment == "Paid";
                    $order->save();
                } else {
                    $result = '<div class="alert alert-danger"><strong>Payment status: </strong>' . $message . '/' . $localMessage . '</div>';
                }
            } else {
                $result = '<div class="alert alert-danger">This transaction could be hacked, please check your signature and returned signature</div>';
            }
        }
        return view('Client.Payment.momo', compact('partnerCode', 'accessKey', 'orderId', 'localMessage', 'message', 'transId', 'orderInfo', 'amount', 'errorCode', 'responseTime', 'requestId', 'extraData', 'payType', 'orderType', 'm2signature', 'result', 'secretKey', 'rawHash', 'partnerSignature'));
    }
}
