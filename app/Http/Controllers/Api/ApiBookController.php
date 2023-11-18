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
    public function test()
    {
        return view('welcome');
    }
    public function index()
    {
        $books = Book::with('category')->get();
        return response()->json(['message' => 'Lấy ra tất cả sách thành công', 'data' => BookResource::collection($books)], 200);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $book = Book::create($request->all());
        return response()->json(['message' => 'Them moi thanh cong', 'data' => new BookResource($book)], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $book = Book::find($id);
        $category = Category::find($book->id);
        if ($book) {
            return new BookResource($book, $category);
        } else {
            return response()->json(['message' => 'Sach khong ton tai'], 404);
        }
    }

    /**
     * Find product as field
     */
    public function searchByFiled($field, $name)
    {
        $book = Book::where($field, 'LIKE', '%' . $name . '%')->get();
        if ($book) {
            return response()->json(['message' => 'Đã tìm thấy sản phẩm', 'data' => new BookResource($book)], 200);
        } else {
            return response()->json(['message' => 'Không tìm thấy sản phẩm phù hợp'], 404);
        }
    }

    public function searchByCategory($id)
    {
        $book = Book::where('category_id', $id)->get();
        if ($book) {
            return response()->json(['message' => 'Đã tìm thấy sản phẩm', 'data' => new BookResource($book)], 200);
        } else {
            return response()->json(['message' => 'Không tìm thấy sản phẩm phù hợp'], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $book = Book::find($id);
        if ($book) {
            $book->update($request->all());
            return response()->json(['message' => 'Cap nhat thanh cong'], 200);
        } else {
            return response()->json(['message' => 'Sach khong ton tai'], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $book = Book::find($id);
        if ($book) {
            $book->delete();
            return response()->json(['message' => 'Xoa thanh cong'], 200);
        } else {
            return response()->json(['message' => 'Sach khong ton tai'], 404);
        }
    }
}
