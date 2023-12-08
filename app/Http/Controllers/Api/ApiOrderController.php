<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApiOrderController extends Controller
{
    protected $order;
    public function __construct(Order $order)
    {
        $this->order = $order;
    }
    public function index()
    {
        $user = Auth::user();
        $order = $this->order::where('email', $user->email)->get();
        if ($order) {
            return response()->json(['message' => 'Đã lấy đơn hàng', 'data' => $order], 200);
        } else {
            return response()->json(['message' => 'Không tìm thấy đơn hàng'], 404);
        }
    }
    public function orderDetail($order_id)
    {
        $detail = OrderDetail::where('order_id', $order_id)->get();
        if ($detail) {
            return response()->json(['message' => 'Đã lấy chi chi tiết đơn hàng', 'data' => $detail], 200);
        } else {
            return response()->json(['message' => 'Không tìm thấy đơn hàng'], 404);
        }
    }
}
