<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\BookResource;
use App\Models\Book;
use Illuminate\Http\Request;

class ApiBookController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        $books = Book::all();
        return BookResource::collection($books);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $book = Book::create($request->all());
        return response()->json(['message' => 'Them moi thanh cong'], 200);
        return new BookResource($book);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $book = Book::find($id);
        if ($book) {
            return new BookResource($book);
        } else {
            return response()->json(['message' => 'Sach khong ton tai'], 404);
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
