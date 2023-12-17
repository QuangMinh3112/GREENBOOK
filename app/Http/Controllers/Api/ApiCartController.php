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
        $this->middleware('auth.api');
        $this->middleware('check.book.status')->only(['addToCart']);
    }

    public function index()
    {
        $user = Auth()->user();
        $carts = $this->cart->where('user_id', $user->id)->with(['book'])->latest('id')->get();
        if (count($carts) > 0) {
            return response()->json(['message' => 'Đã lấy ra giỏ hàng', 'data' => CartResource::collection($carts)], 200);
        } else {
            return response()->json(['message' => 'Không có sản phẩm nào trong giỏ hàng'], 200);
        }
    }
    public function addToCart(Request $request, $book_id)
    {
        $user_id = Auth()->user()->id;
        $book_id = $book_id;

        $book = Book::find($book_id);
        if ($book->quantity == 0) {
            return response()->json(['message' => 'Sản phẩm đã hết hàng'], 200);
        }
        $cartItem = Cart::where('user_id', $user_id)->where('book_id', $book_id)->first();
        if ($cartItem) {
            $cartItem->quantity++;
            $cartItem->save();
        } else {
            $this->cart->create([
                'user_id' => $user_id,
                'book_id' => $book_id,
                'quantity' => 1,
                'added_date' => now()
            ]);
        }
        return response()->json(['message' => 'Thêm sản phẩm thành công'], 200);
    }
    public function update(Request $request, $book_id)
    {
        $user_id = Auth()->user()->id;
        $cart = $this->cart->where('book_id', $book_id)->where('user_id', $user_id)->first();
        if (!$cart) {
            return response()->json(['message' => 'Không tìm thấy sản phẩm']);
        } else {
            $newQuantity = $request->input('quantity');
            $cart->quantity = $newQuantity;
            $cart->update();
            return response()->json(['message' => 'Cập nhật thành công', 'data' => $cart]);
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
            $carts->each()->delete();
            return response()->json(['message' => 'Xoá toàn bộ sản phẩm trong giỏ hàng thành công'], 200);
        }
    }
    public function createOrder(OrderRequest $request)
    {
        $invalidBook = [];
        $outStock = [];
        if (Auth::user()->is_vertify != 1) {
            return response()->json(['message' => 'Bạn cần phải xác minh tài khoản trước khi đặt hàng']);
        } else {
            $user_id = Auth::user()->id;
            $carts = $this->cart::where('user_id', $user_id)->get();
            if ($carts->isEmpty()) {
                return response()->json(['message' => 'Không có sản phẩm nào trong giỏ hàng'], 400);
            } else {
                $total = 0;
                if ($request->input('coupon')) {
                    $coupon = Coupon::where('code', 'LIKE', '%' . $request->input('coupon') . '%')->first();

                    if ($coupon && !$coupon->qualified(auth()->user()->point)) {
                        return response()->json(['message' => 'Không đủ điểm để sử dụng mã giảm giá này'], 422);
                    }
                    if (!$coupon) {
                        return response()->json(['message' => 'Không tồn tại mã giảm giá'], 422);
                    }
                } else {
                    $coupon = null;
                }
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
                        'payment' => 'COD',
                        'total' => 0,
                        'coupon' => $coupon,
                        'user_id' => $user_id,
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
                        $total += ($cart->quantity * $book->price);
                    }
                    if ($coupon != null) {
                        if ($coupon->value === 'number') {
                            $order->total = $total - $coupon->discount;
                        } else {
                            $order->total = $total - ($total * ($coupon->discount / 100));
                        }
                    } else {
                        $order->total = $total;
                    }
                    $order->save();
                    $this->cart::where('user_id', $user_id)->delete();
                    $orderDetail = OrderDetail::where('order_id', $order->id)->get();
                    Mail::to(Auth::user()->email)->send(new OrderSuccess($order, $orderDetail));
                    return response()->json(['message' => 'Đặt hàng thành công', 'data' => $order]);
                }
            }
        }
    }
}
