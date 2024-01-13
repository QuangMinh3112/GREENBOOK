<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrderRequest;
use App\Mail\OrderSuccess;
use App\Models\Book;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Coupon;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\UserCoupon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cookie;

class ApiCartController extends Controller
{
    protected $cart;
    protected $book;
    protected $apiMomo;
    protected $userId;
    public function __construct(Cart $cart, Book $book, ApiMomo $apiMomo)
    {
        $this->cart = $cart;
        $this->book = $book;
        $this->middleware('check.book.status')->only(['addToCart']);
        $this->apiMomo = $apiMomo;
        $this->userId = $this->checkUserId();
    }
    public function checkUserId()
    {
        if (Auth::guard('api')->check()) {
            return Auth::guard('api')->id();
        } else {
            return null;
        }
    }
    public function index()
    {
        $carts = $this->cart->where('user_id', $this->userId)->with(['book', 'warehouse' => function ($query) {
            $query->select('book_id', 'quantity', 'retail_price', 'wholesale_price');
        }])->latest('id')->get();
        return response()->json(['message' => 'Đã lấy ra giỏ hàng', 'data' => $carts], 200);
    }
    public function addToCart(Request $request, $book_id)
    {
        $book_id = $book_id;
        if ($request->input('quantity')) {
            $quantity = $request->input('quantity');
        } else {
            $quantity = 1;
        }
        $book = Book::with(['category', 'warehouse' => function ($query) {
            $query->select('book_id', 'quantity', 'retail_price', 'wholesale_price');
        }])->where('status', 1)->where('id', $book_id)->first();
        if ($book->warehouse->quantity == 0) {
            return response()->json(['message' => 'Sản phẩm đã hết hàng'], 200);
        }
        if ($book->warehouse->quantity < $quantity) {
            return response()->json(['message' => 'Sản phẩm có sẵn không đủ'], 200);
        }
        $cartItem = Cart::where('user_id', $this->userId)->where('book_id', $book_id)->first();
        if ($cartItem) {
            $cartItem->quantity += $quantity;
            if ($cartItem->quantity > $book->warehouse->quantity) {
                return response()->json(['message' => 'Sản phẩm có sẵn không đủ'], 200);
            } else {
                $cartItem->save();
            }
        } else {
            $this->cart->create([
                'user_id' => $this->userId,
                'book_id' => $book_id,
                'quantity' => $quantity,
                'added_date' => now()
            ]);
        }
        return response()->json(['message' => 'Thêm sản phẩm thành công'], 200);
    }
    public function update(Request $request, $cart_id)
    {
        $userId = $this->checkUserId();
        $cart = $this->cart->where('id', $cart_id)->where('user_id', $userId)->first();
        if (!$cart) {
            return response()->json(['message' => 'Không tìm thấy sản phẩm']);
        } else {
            $newQuantity = $request->input('quantity');
            $book = Book::with(['category', 'warehouse' => function ($query) {
                $query->select('book_id', 'quantity', 'retail_price', 'wholesale_price');
            }])->where('status', 1)->where('id', $cart->book_id)->first();
            if ($newQuantity > $book->warehouse->quantity) {
                return response()->json(['message' => 'Số lượng sản phẩm có sẵn không đủ'], 404);
            }
            $cart->quantity = $newQuantity;
            $cart->update();
            return response()->json(['message' => 'Cập nhật thành công', 'data' => $cart], 200);
        }
    }
    public function removeCart($id_cart)
    {
        $cart = $this->cart::where('id', $id_cart)->first();
        if ($cart) {
            $cart->delete();
            return response()->json(['message' => 'Sản phẩm đã được xoá khỏi giỏ hàng'], 200);
        } else {
            return response()->json(['message' => 'Không tìm thấy sản phẩm'], 404);
        }
    }
    public function removeAll()
    {
        $userId = $this->checkUserId();
        $carts = $this->cart::where('user_id', $userId)->get();

        if ($carts->isEmpty()) {
            return response()->json(['message' => 'Không tìm thấy giỏ hàng'], 404);
        } else {
            $carts->each(function ($cart) {
                $cart->delete();
            });
            return response()->json(['message' => 'Xoá toàn bộ sản phẩm trong giỏ hàng thành công'], 200);
        }
    }

    public function createOrder(OrderRequest $request)
    {
        $invalidBook = [];
        $outStock = [];
        $userId = $this->checkUserId();
        $payment = $request->input('payment');
        $email = $request->input('email');
        $name = $request->input('name');
        $phone_number = $request->input('phone_number');
        $address = $request->input('address');
        $ship_fee = $request->input('ship_fee');
        $service_id = $request->input('service_id');
        $district_id = $request->input('district_id');
        $province_id = $request->input('province_id');
        $ward_id = $request->input('ward_id');
        $carts = $this->cart::where('user_id', $userId)->get();
        if (count($carts) == 0) {
            return response()->json(['message' => 'Không có sản phẩm nào trong giỏ hàng'], 400);
        } else {
            $total_product_amount = 0;
            foreach ($carts as $cart) {
                $book = Book::where('id', $cart->book_id)->with('warehouse')->first();
                if ($book->status == 0) {
                    $invalidBook[] = $book;
                }
                if ($book->warehouse->quantity < $cart->quantity) {
                    $outStock[] = $book;
                }
            }
            if (count($invalidBook) > 0) {
                return response()->json(['message' => 'Tồn tại sản phẩm không hoạt động', 'invalid_book' => $invalidBook], 422);
            } else if (count($outStock) > 0) {
                return response()->json(['message' => 'Tồn tại sản phẩm hết hàng', 'out_stock' => $outStock], 422);
            } else {
                $id = Str::uuid();
                $order = Order::create([
                    'id' => $id,
                    'status' => 'pending',
                    'name' => $name,
                    'phone_number' => $phone_number,
                    'address' => $address,
                    'total_product_amount' => 0,
                    'total' => 0,
                    'email' => $email,
                    'coupon' => "",
                    'user_id' => $userId,
                    'service_id' => $service_id,
                    'district_id' => $district_id,
                    'province_id' => $province_id,
                    'ward_id' => $ward_id,
                    'ship_fee' => $ship_fee,
                    'added_date' => now(),
                ]);
                foreach ($carts as $cart) {
                    $book = $this->book::where('id', $cart->book_id)->with('warehouse')->first();
                    if ($cart->quantity > 20) {
                        $price = $book->warehouse->wholesale_price;
                    } else {
                        $price = $book->warehouse->retail_price;
                    }
                    OrderDetail::create([
                        'order_id' =>  $order->id,
                        'book_id' => $cart->book_id,
                        'quantity' => $cart->quantity,
                        'book_name' => $book->name,
                        'book_image' => $book->image,
                        'book_price' => $price,
                    ]);
                    if ($cart->quantity > 20) {
                        $total_product_amount += ($cart->quantity * $book->warehouse->wholesale_price);
                    } else {
                        $total_product_amount += ($cart->quantity * $book->warehouse->retail_price);
                    }
                }
                $coupon_id = $request->input('coupon_id');
                $coupon = "";
                if ($coupon_id) {
                    $user_coupon = UserCoupon::where('id', $coupon_id)->first();
                    if ($user_coupon) {
                        if ($user_coupon->is_used == 1) {
                            return response()->json(["message" => "Mã giảm giá đã được dùng"], 422);
                        }
                        $coupon = Coupon::find($user_coupon->coupon_id);
                        if ($coupon->price_required > $total_product_amount) {
                            return response()->json(["message" => "Tổng giá tiền chưa đạt tiêu chuẩn"], 422);
                        } else if ($coupon->is_activate == 0) {
                            return response()->json(["message" => "Mã giảm giá đã ngừng hoạt động"], 404);
                        } else {
                            $user_coupon->update(['is_used' => 1]);
                        }
                    }
                }
                if ($coupon != null) {
                    if ($coupon->type === "number") {
                        $total_product_amount = $total_product_amount - $coupon->value;
                    }
                    if ($coupon->type === "percent") {
                        $total_product_amount = $total_product_amount - ($total_product_amount * ($coupon->value / 100));
                    }
                    if ($coupon->type === "free_ship") {
                        $order->ship_fee = 0;
                    }
                    $order->coupon = $coupon->code;
                    $order->total_product_amount = $total_product_amount;
                    $order->total = $total_product_amount + $order->ship_fee;
                    $order->save();
                } else {
                    $order->total_product_amount = $total_product_amount;
                    $order->total = $total_product_amount + $order->ship_fee;
                    $order->save();
                }
                $this->cart::where('user_id', $userId)->delete();
                $orderDetail = OrderDetail::where('order_id', $order->id)->get();
                if ($payment === "COD") {
                    $order->update([
                        "payment" => "COD"
                    ]);
                    $trangThai = "Thanh toán khi nhận hàng";
                    $result = Mail::to($email)->send(new OrderSuccess($order, $orderDetail, $trangThai));
                    if ($result) {
                        return response()->json(['message' => 'Đặt hàng thành công', 'data' => $order]);
                    } else {
                        return response()->json(['message' => 'Gửi email thất bại'], 500);
                    }
                    return response()->json(['message' => 'Đặt hàng thành công', 'data' => $order]);
                } else if ($payment === "MOMO") {
                    $url = $this->apiMomo->momo_payment($order->id, $email);
                    return response()->json(['message' => 'Vui lòng thực hiện thanh toán', 'data' => $order, 'url' => $url]);
                }
            }
        }
    }
}
