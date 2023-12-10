<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\BookResource;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;

class ApiBookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // SHOW TẤT CẢ SÁCH
    public function index()
    {
        $books = Book::with('category')->where('status', 1)->latest()->paginate(10);
        return response()->json(['message' => 'Success', 'data' => BookResource::collection($books)], 200);
    }
    public function show(string $id)
    {
        //
        $book = Book::find($id);
        if ($book) {
            $book->view += 1;
            $book->save();
            $category = Category::find($book->id);
            return response()->json(['message' => 'Success', 'data' => new BookResource($book, $category)], 200);
        } else {
            return response()->json(['message' => 'Not Found'], 404);
        }
    }
    // TOP 10 SÁCH XEM NHIỀU NHẤT
    public function topBook()
    {
        $book = Book::orderByDesc('view')->take(10)->get();
        return response()->json(['message' => 'Success', 'data' => $book]);
    }
    /**
     * Find product as field
     */
    // TÌM THEO TRƯỜNG
    public function searchByFiled($field, $name)
    {
        $book = Book::where($field, 'LIKE', '%' . $name . '%')->get();
        if ($book) {
            return response()->json(['message' => 'Đã tìm thấy sản phẩm', 'data' => new BookResource($book)], 200);
        } else {
            return response()->json(['message' => 'Không tìm thấy sản phẩm phù hợp'], 404);
        }
    }
    // TÌM THEO CATEGORY
    public function searchByCategory($id)
    {
        $book = Book::with('category')->where('category_id', $id)->get();
        if ($book) {
            return response()->json(['message' => 'Đã tìm thấy sản phẩm', 'data' => new BookResource($book)], 200);
        } else {
            return response()->json(['message' => 'Không tìm thấy sản phẩm phù hợp'], 404);
        }
    }
}
