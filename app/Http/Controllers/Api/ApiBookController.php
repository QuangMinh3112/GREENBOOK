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
        $books = Book::with('category')->where('status', 1)->paginate(10);
        return response()->json(['message' => 'Success', 'data' => BookResource::collection($books)], 200);
    }
    public function show(string $id)
    {
        //
        $book = Book::find($id);
        if ($book && $book->status == 1) {
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
        $books = Book::orderByDesc('view')->where('status', 1)->take(10)->get();
        return response()->json(['message' => 'Success', 'data' => BookResource::collection($books)]);
    }
    /**
     * Find product as field
     */
    // SẢN PHẨM LIÊN QUAN
    public function relatedBook($bookId)
    {
        $currentBook = Book::find($bookId);
        if (!$currentBook || $currentBook->status == 0) {
            return response()->json(['message' => 'Không tìm thấy sách có liên quan'], 404);
        }
        $relatedBook = Book::where('id', '!=', $currentBook->id)->where('category_id', $currentBook->category_id)->where('status', 1)->with('category')->latest()->paginate(5);
        if ($relatedBook) {
            return response()->json(['message' => 'Success', 'data' => BookResource::collection($relatedBook)], 200);
        } else if ($relatedBook->isEmty()) {
            return response()->json(['message' => 'Không tìm thấy sách có liên quan'], 404);
        }
    }
    // TÌM THEO TRƯỜNG & LỌC GIÁ
    public function search(Request $request)
    {
        $query = Book::query();
        $name_field = $request->input('name_field');
        $name = $request->input('name');
        $author_field = $request->input('author_field');
        $author = $request->input('author');
        $published_company_field = $request->input('published_company_field');
        $published_company = $request->input('published_company');
        $published_year_field = $request->input('published_year_field');
        $published_year = $request->input('published_year');
        $minPrice = $request->input('min_price');
        $maxPrice = $request->input('max_price');
        $sortName = $request->input('sort_name', '');
        $sortPrice = $request->input('sort_price', '');
        $sortDate = $request->input('sort_date', '');
        if (!empty($name_field) && $name) {
            if ($name_field === "category_id") {
                $query->orWhere($name_field, $name);
            } else {
                $query->orWhere($name_field, 'LIKE', '%' . $name . '%');
            }
        }
        if (!empty($author_field) && $author) {
            if ($author_field === "category_id") {
                $query->orWhere($author_field, $author);
            } else {
                $query->orWhere($author_field, 'LIKE', '%' . $author . '%');
            }
        }
        if (!empty($published_company_field) && $published_company) {
            if ($published_company_field === "category_id") {
                $query->orWhere($published_company_field, $published_company);
            } else {
                $query->orWhere($published_company_field, 'LIKE', '%' . $published_company . '%');
            }
        }
        if (!empty($published_year_field) && $published_year) {
            if ($published_year_field === "category_id") {
                $query->orWhere($published_year_field, $published_year);
            } else {
                $query->orWhere($published_year_field, 'LIKE', '%' . $published_year . '%');
            }
        }
        if ($minPrice) {
            $query->where('price', '>=', $minPrice);
        }
        if ($maxPrice) {
            $query->where('price', '<=', $maxPrice);
        }

        if ($sortName !== '') {
            $query->orderBy('name', $sortName);
        }
        if ($sortPrice !== '') {
            $query->orderBy('price', $sortPrice);
        }
        if ($sortDate !== '') {
            if ($sortDate === 'new') {
                $query->latest('created_at');
            } elseif ($sortDate === 'old') {
                $query->oldest('created_at');
            }
        }
        $query->with('category')->where('status', 1);
        $books = $query->paginate(10);
        if ($books->isEmpty()) {
            return response()->json(['message' => 'Không tìm thấy sách phù hợp'], 404);
        } else {
            return response()->json(['message' => 'Success', 'data' => BookResource::collection($books)]);
        }
    }
}
