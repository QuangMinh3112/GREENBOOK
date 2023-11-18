<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CartResource;
use App\Models\Book;
use Illuminate\Http\Request;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

class ApiCartController extends Controller
{
    //
    public function index()
    {
        $cart = Cart::where('user_id', Auth::id())->get();
        if (count($cart) > 0) {
            return response()->json(['message' => 'Lấy ra tất cả sách thành công', 'data' => CartResource::collection($cart)], 200);
        } else {
            return response()->json(['message' => 'Không có sản phẩm nào trong giỏ hàng'], 200);
        }
    }
    public function addToCard($id)
    {
        $cartItem = Cart::create([
            'user_id' => Auth::id(),
            'book_id' => $id,
            'quantity' => 1,
            'added_date' =>
        ]);
    }
}
