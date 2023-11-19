<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CartResource;
use App\Models\Book;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Coupon;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Support\Facades\Auth;

class ApiCartController extends Controller
{
    //
    protected $cart;
    protected $book;
    public function __construct(Cart $cart, Book $book)
    {
        $this->cart = $cart;
        $this->book = $book;
    }

    public function index($user_id)
    {
        $carts = $this->cart->where('user_id', $user_id)->with(['book', 'user'])->latest('id')->get();
        if (count($carts) > 0) {
            return response()->json(['message' => 'Đã lấy ra giỏ hàng', 'data' => CartResource::collection($carts)], 200);
        } else {
            return response()->json(['message' => 'Không có sản phẩm nào trong giỏ hàng'], 200);
        }
    }
    public function addToCart(Request $request)
    {
        $data = $request->all();
        $user_id = $data['user_id'];
        $book_id = $data['book_id'];
        $cartItem = Cart::where('user_id', $user_id)->where('book_id', $book_id)->first();

        if ($cartItem) {
            $cartItem->increment('quantity', $request->input('quantity'));
            $cartItem->save();
        } else {
            $this->cart->create($data);
        }
        return response()->json(['message' => 'Tạo thành công'], 200);
    }
    public function update(Request $request, $id)
    {
        $cart = $this->cart::find($id);
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
    public function removeAll($user_id)
    {
        $carts = $this->cart::where('user_id', $user_id)->get();
        if ($carts->isEmpty()) {
            return response()->json(['message' => 'Không tìm thấy giỏ hàng'], 404);
        } else {
            $carts->each()->delete();
            return response()->json(['message' => 'Xoá toàn bộ sản phẩm trong giỏ hàng thành công'], 200);
        }
    }
    public function createOrder(Request $request)
    {
        $user_id = Auth::user()->id;
        $carts = $this->cart::where('user_id', $user_id)->get();
        if ($carts->isEmpty()) {
            return response()->json(['message' => 'Không có sản phẩm nào trong giỏ hàng'], 400);
        } else {
            $total = 0;
            if ($request->input('coupon')) {
                $coupon = Coupon::where('code', $request->input('coupon'))->first();
            } else {
                $coupon = null;
            }
            $order = Order::create([
                'status' => 'pending',
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'phone_number' => $request->input('phone_number'),
                'address' => $request->input('address'),
                'payment' => $request->input('payment'),
                'total' => 0,
                'coupon' => $coupon,
                'user_id' => $user_id,
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
                    $order->total = $total * ($coupon->discount / 100);
                }
            } else {
                $order->total = $total;
            }
            $order->save();

            $this->cart::where('user_id', $user_id)->delete();
            return response()->json(['message' => 'Đặt hàng thành công', 'data' => $order]);
        }
    }
}
