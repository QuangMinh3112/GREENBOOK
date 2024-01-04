<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrderRequest;
use App\Http\Resources\CartResource;
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

class ApiCartController extends Controller
{
    //
    protected $cart;
    protected $book;
    public function __construct(Cart $cart, Book $book)
    {
        $this->cart = $cart;
        $this->book = $book;
        $this->middleware('auth:api');
        $this->middleware('check.book.status')->only(['addToCart']);
    }

    public function index()
    {
        $user = Auth()->user();
        $carts = $this->cart->where('user_id', $user->id)->with(['book'])->latest('id')->get();
        if (count($carts) > 0) {
            return response()->json(['message' => 'Đã lấy ra giỏ hàng', 'data' => $carts], 200);
        } else {
            return response()->json(['message' => 'Không có sản phẩm nào trong giỏ hàng'], 200);
        }
    }
    public function addToCart(Request $request, $book_id)
    {
        $user = Auth::user();
        $book_id = $book_id;
        if ($request->input('quantity')) {
            $quantity = $request->input('quantity');
        } else {
            $quantity = 1;
        }
        $book = Book::find($book_id);
        if ($book->quantity == 0) {
            return response()->json(['message' => 'Sản phẩm đã hết hàng'], 200);
        }
        if ($book->quantity < $quantity) {
            return response()->json(['message' => 'Sản phẩm có sẵn không đủ'], 200);
        }
        $cartItem = Cart::where('user_id', $user->id)->where('book_id', $book_id)->first();
        if ($cartItem) {
            $cartItem->quantity += $quantity;
            if ($cartItem->quantity > $book->quantity) {
                return response()->json(['message' => 'Sản phẩm có sẵn không đủ'], 200);
            } else {
                $cartItem->save();
            }
        } else {
            $this->cart->create([
                'user_id' => $user->id,
                'book_id' => $book_id,
                'quantity' => $quantity,
                'added_date' => now()
            ]);
        }
        return response()->json(['message' => 'Thêm sản phẩm thành công'], 200);
    }
    public function update(Request $request, $cart_id)
    {
        $user_id = Auth()->user()->id;
        $cart = $this->cart->where('id', $cart_id)->where('user_id', $user_id)->first();
        if (!$cart) {
            return response()->json(['message' => 'Không tìm thấy sản phẩm']);
        } else {
            $newQuantity = $request->input('quantity');
            $book = Book::find($cart->book_id);
            if ($newQuantity > $book->quantity) {
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
        $user = Auth::user();
        $carts = $this->cart::where('user_id', $user->id)->get();

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
        $user = Auth::user();
        $payment = $request->input('payment');
        if ($user->is_vertify != 1) {
            return response()->json(['message' => 'Bạn cần phải xác minh tài khoản trước khi đặt hàng']);
        } else {
            $user_id = Auth::user()->id;
            $carts = $this->cart::where('user_id', $user_id)->get();
            if (count($carts) == 0) {
                return response()->json(['message' => 'Không có sản phẩm nào trong giỏ hàng'], 400);
            } else {
                $total_product_amount = 0;
                foreach ($carts as $cart) {
                    $book = $this->book::find($cart->book_id);
                    if ($book->status == 0) {
                        $invalidBook[] = $book;
                    }
                }
                foreach ($carts as $cart) {
                    $book = $this->book::find($cart->book_id);
                    if ($book->quantity == 0) {
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
                        'name' => $request->input('name'),
                        'phone_number' => $request->input('phone_number'),
                        'address' => $request->input('address'),
                        'total_product_amount' => 0,
                        'total' => 0,
                        'coupon' => "",
                        'user_id' => $user_id,
                        'ship_fee' => $request->input('ship_fee'),
                        'added_date' => now(),
                    ]);
                    foreach ($carts as $cart) {
                        $book = $this->book::find($cart->book_id);
                        OrderDetail::create([
                            'order_id' =>  $order->id,
                            'book_id' => $cart->book_id,
                            'quantity' => $cart->quantity,
                            'book_name' => $book->name,
                            'book_image' => $book->image,
                            'book_price' => $book->price,
                        ]);
                        $total_product_amount += ($cart->quantity * $book->price);
                    }
                    $coupon = null;
                    if ($request->input('coupon_id')) {
                        $user_coupon = UserCoupon::where('user_id', $user->id)
                            ->where('coupon_id', $request->input('coupon_id'))
                            ->where('is_used', 0)
                            ->first();
                        if ($user_coupon) {
                            $coupon = Coupon::find($user_coupon->coupon_id);
                            if ($coupon->price_required > $total_product_amount) {
                                return response()->json(["message" => "Tổng giá tiền chưa đạt tiêu chuẩn"], 422);
                            } else {
                                $user_coupon->update(['is_used' => 1]);
                            }
                        }
                    }
                    if ($coupon != null) {
                        if ($coupon->type === "number") {
                            $order->total_product_amount = $total_product_amount - $coupon->value;
                        }
                        if ($coupon->type === "percent") {
                            $order->total_product_amount = $total_product_amount - ($total_product_amount * ($coupon->value / 100));
                        }
                        if ($coupon->type === "free_ship") {
                            $order->ship_fee = 0;
                        }
                        $order->coupon = $coupon->code;
                        $order->total = $order->total_product_amount + $order->ship_fee;
                    } else {
                        $order->total_product_amount = $total_product_amount;
                        $order->total = $total_product_amount + $order->ship_fee;
                    }
                    $order->save();
                    $this->cart::where('user_id', $user_id)->delete();
                    $orderDetail = OrderDetail::where('order_id', $order->id)->get();
                    Mail::to($user->email)->send(new OrderSuccess($order, $orderDetail));
                    if ($payment === "COD") {
                        $order->update([
                            "payment" => "COD"
                        ]);
                        return response()->json(['message' => 'Đặt hàng thành công', 'data' => $order]);
                    } else if ($payment === "MOMO") {
                        $url =  route('momo_payment', ['order_id' => $order->id]);
                        return response()->json(['message' => 'Vui lòng thực hiện thanh toán', 'data' => $order, 'url' => $url]);
                    }
                }
            }
        }
    }
}
