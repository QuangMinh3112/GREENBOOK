<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\FavoriteBook;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApiFavoriteBookController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth.api');
        $this->middleware('check.book.status')->only('addFavorite');
    }
    public function showFavorite()
    {
        $user = Auth::user();
        if ($user) {
            $favoriteBook = FavoriteBook::where('user_id', $user->id)->with('book')->latest()->paginate(10);
            if (count($favoriteBook) > 0) {
                return response()->json(['message' => 'Lấy ra sản phẩm thành công', 'data' => $favoriteBook], 200);
            } else {
                return response()->json(['message' => 'Không có sản phẩm trong giỏ hàng'], 200);
            }
        }
    }
    public function addFavorite($book_id)
    {
        $user = Auth::user();
        $book = Book::find($book_id);
        if ($book && $user) {
            $favoriteBook = new FavoriteBook();
            $favoriteBook->user_id = $user->id;
            $favoriteBook->book_id = $book->id;
            $favoriteBook->save();
            if ($favoriteBook) {
                return response()->json(['message' => 'Thêm sản phẩm thành công'], 200);
            } else {
                return response()->json(['message' => 'Thêm sản phẩm thất bại'], 404);
            }
        } else {
            return response()->json(['message' => 'Lỗi khi thêm sản phẩm yêu thích'], 404);
        }
    }
}
