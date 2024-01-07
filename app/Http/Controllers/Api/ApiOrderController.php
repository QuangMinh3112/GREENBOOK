<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

class ApiOrderController extends Controller
{
    protected $order;
    protected $apiMomo;
    public function __construct(Order $order)
    {
        $this->order = $order;
    }
    public function index(Request $request)
    {
        $user = Auth::user();
        $query = $this->order::query();
        $payment = $request->input('payment');
        $status = $request->input('status');
        $create_at = $request->input('create_at');
        $order_code = $request->input('order_code');

        if ($payment !== null) {
            $query->where('payment', 'like', '%' . $payment . '%');
        }
        if ($status !== null) {
            $query->where('status', 'like', '%' . $status . '%');
        }
        if ($create_at !== null) {
            $create_at = Carbon::parse($create_at)->toDateString();
            $query->whereDate('created_at', $create_at);
        }
        if ($order_code) {
            $query->where('order_code', 'like', '%' . $order_code . '%');
        }
        $order = $query->where('user_id', $user->id)->get();
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
            if ($request->input('name')) {
                $order->name = $request->name;
            }
            if ($request->input('phone_number')) {
                $order->phone_number = $request->phone_number;
            }

            if ($request->input('address')) {
                $order->address = $request->address;
            }
            if ($request->input('ship_fee')) {
                $order->ship_fee = $request->ship_fee;
                $order->total = $order->total_product_amount + $request->ship_fee;
            }
            if ($request->input('payment') && $order->payment === "Watting") {
                $order->payment = "COD";
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
