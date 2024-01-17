<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
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
    public function searchOrder(Request $request)
    {
        $id = $request->input('id');
        if ($id) {
            $order = Order::find($id);
            if ($order) {
                return response()->json(["message" => "Success", "data" => $order], 200);
            } else {
                return response()->json(["message" => "Không tìm thấy đơn hàng"], 404);
            }
        } else {
            return response()->json(["message" => "Vui lòng nhập mã đơn hàng"], 500);
        }
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
        $order = Order::find($order_id);
        $detail = OrderDetail::where('order_id', $order_id)->get();
        if ($detail) {
            return response()->json(['message' => 'Đã lấy chi chi tiết đơn hàng', 'data' => $detail, 'order' => $order], 200);
        } else {
            return response()->json(['message' => 'Không tìm thấy đơn hàng'], 404);
        }
    }
    public function updateOrder(Request $request, $order_id)
    {
        $order = Order::findOrFail($order_id);
        $name = $request->input('name');
        $address = $request->input('address');
        $phone_number = $request->input('phone_number');
        $ship_fee = $request->input('ship_fee');
        $service_id = $request->input('service_id');
        $province_id = $request->input('province_id');
        $ward_id = $request->input('ward_id');
        $district_id = $request->input('district_id');
        if ($order->status === 'Chờ xử lý') {
            if ($name) {
                $order->name = $name;
            }
            if ($phone_number) {
                $order->phone_number = $phone_number;
            }
            if ($address != null) {
                $order->address = $address;
            }
            if ($province_id) {
                $order->province_id = $province_id;
            }
            if ($service_id) {
                $order->service_id = $service_id;
            }
            if ($district_id) {
                $order->district_id = $district_id;
            }
            if ($ward_id) {
                $order->ward_id = $ward_id;
            }
            if ($ship_fee) {
                if ($order->coupon != null) {
                    $coupon = Coupon::where('code', 'like', $order->coupon)->first();
                    if ($coupon->type === "free_ship") {
                        $ship_fee = 0;
                    }
                }
                $order->ship_fee = $ship_fee;
                $order->total = $order->total_product_amount + $ship_fee;
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
    public function payment($id)
    {
        $order = Order::find($id);
        if ($order) {
            if ($order->payment != "Watting") {
                return response()->json(['message' => 'Đơn hàng đã thanh toán'], 200);
            } else {
                if ($order->payment_url != "") {
                    return response()->json(['message' => 'Success', 'url' => $order->payment_url], 200);
                } else {
                    return response()->json(['message' => 'Không tồn tại đường link thanh toán'], 404);
                }
            }
        } else {
            return response()->json(['message' => 'Không tìm thấy đơn hàng'], 404);
        }
    }
}
