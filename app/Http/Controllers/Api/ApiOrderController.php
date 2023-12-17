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
        $order = $this->order::where('user_id', $user->id)->get();
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
    public function updateOrder(Request $request, $order_id)
    {
        $order = Order::findOrFail($order_id);
        if ($order->status === 'Chờ xử lý') {
            if ($request->filled('name')) {
                $order->name = $request->name;
            }

            if ($request->filled('phone_number')) {
                $order->phone_number = $request->phone_number;
            }

            if ($request->filled('address')) {
                $order->address = $request->address;
            }
            $order->save();
            return response()->json(['message' => 'Cập nhật đơn hàng thành công', 'data' => $order], 200);
        } else {
            return response()->json(['message' => 'Bạn không thể thay đổi thông tin đơn hàng'], 404);
        }
    }
    public function cancelOrder($order_id)
    {
        $order = Order::find($order_id);
        if ($order && $order->status === "Chờ xử lý") {
            $order->status = "cancel";
            $order->save();
            return response()->json(['message' => 'Huỷ đơn hàng thành công', 'data' => $order], 200);
        } else {
            return response()->json(['message' => 'Bạn không thể hủy đơn hàng'], 404);
        }
    }
}
