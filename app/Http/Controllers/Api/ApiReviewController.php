<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Review;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Support\Facades\Auth;

class ApiReviewController extends Controller
{
    //
    public function show($id, Request $request)
    {
        $query = Review::query();
        $rating = $request->input('rating');
        if ($rating) {
            $query->where('rating', $rating);
        }
        $reviews = $query->where('book_id', $id)->with('user')->paginate(5);
        if ($reviews->isNotEmpty()) {
            return response()->json(["message" => "Success", "data" => $reviews], 200);
        } else {
            return response()->json(["message" => "Chưa có đánh giá"], 200);
        }
    }
    public function addReview(Request $request, $id)
    {
        $user = Auth::user();
        $book = Book::find($id);
        $avaiable = 0;
        $reviewed = Review::where('user_id', $user->id)
            ->where('book_id', $book->id)
            ->first();
        if ($reviewed) {
            return response()->json(['message' => 'Bạn đã đánh giá sản phẩm này rồi.'], 403);
        }
        $orders = Order::where('user_id', $user->id)->where('status', 'completed')->get();
        if ($orders) {
            foreach ($orders as $order) {
                $order_details = OrderDetail::where('order_id', $order->id)->get();
                if ($order_details) {
                    foreach ($order_details as $order_detail) {
                        if ($order_detail->book_id == $book->id) {
                            $avaiable++;
                        }
                    }
                }
            }
        }
        if ($avaiable > 0) {
            $review = new Review([
                'user_id' => $user->id,
                'book_id' => $book->id,
                'comment' => $request->input('comment'),
                'rating' => $request->input('rating'),
            ]);
            $review->save();
            return response()->json(['message' => 'Đánh giá đã được thêm thành công.'], 200);
        } else {
            return response()->json(['message' => 'Bạn không có quyền đánh giá sản phẩm này.'], 403);
        }
    }
}
