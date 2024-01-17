<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\BookResource;
use App\Models\Book;
use App\Models\Category;
use App\Models\OrderDetail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ApiBookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // SHOW TẤT CẢ SÁCH
    public function index()
    {
        $books = Book::with(['category', 'warehouse' => function ($query) {
            $query->select('book_id', 'quantity', 'retail_price', 'wholesale_price', 'delivery_quantity');
        }])->whereHas('warehouse', function ($query) {
            $query->whereNotNull('book_id');
        })->where('status', 1)->paginate(12);
        return response()->json(['message' => 'Success', 'data' => $books], 200);
    }
    public function show(string $id)
    {
        //
        $book = Book::with(['category', 'warehouse' => function ($query) {
            $query->select('book_id', 'quantity', 'retail_price', 'wholesale_price', 'delivery_quantity');
        }])->where('status', 1)->where('id', $id)->first();
        if ($book && $book->status == 1) {
            $book->view += 1;
            $book->save();
            return response()->json(['message' => 'Success', 'data' => $book], 200);
        } else {
            return response()->json(['message' => 'Not Found'], 404);
        }
    }
    // TOP 10 SÁCH XEM NHIỀU NHẤT
    public function topBook()
    {
        $books = Book::orderByDesc('view')->where('status', 1)->with(['category', 'warehouse' => function ($query) {
            $query->select('book_id', 'quantity', 'retail_price', 'wholesale_price', 'delivery_quantity');
        }])->whereHas('warehouse', function ($query) {
            $query->whereNotNull('book_id');
        })
            ->paginate(12);
        return response()->json(['message' => 'Success', 'data' => $books]);
    }
    /**
     * Find product as field
     */
    // TOP SẢN PHẨM MUA TRONG THÁNG
    public function topBuyMonth()
    {
        $books = Book::where('status', 1)
            ->with(['category', 'warehouse' => function ($query) {
                $query->select('book_id', 'quantity', 'retail_price', 'wholesale_price', 'delivery_quantity');
            }])
            ->whereHas('warehouse', function ($query) {
                $query->whereNotNull('book_id');
            })
            ->join('warehouses', 'books.id', '=', 'warehouses.book_id')
            ->orderByDesc('warehouses.delivery_quantity')
            ->select('books.*')
            ->paginate(10);

        return response()->json(['message' => 'Success', 'data' => $books]);
    }
    // SẢN PHẨM LIÊN QUAN
    public function relatedBook($bookId)
    {
        $currentBook = Book::find($bookId);
        if (!$currentBook || $currentBook->status == 0) {
            return response()->json(['message' => 'Không tìm thấy sách có liên quan'], 404);
        }
        $relatedBook = Book::where('id', '!=', $currentBook->id)->where('category_id', $currentBook->category_id)->where('status', 1)->with(['category', 'warehouse' => function ($query) {
            $query->select('book_id', 'quantity', 'retail_price', 'wholesale_price');
        }])->whereHas('warehouse', function ($query) {
            $query->whereNotNull('book_id');
        })->latest()->paginate(5);
        if ($relatedBook) {
            return response()->json(['message' => 'Success', 'data' => $relatedBook], 200);
        } else if ($relatedBook->isEmty()) {
            return response()->json(['message' => 'Không tìm thấy sách có liên quan'], 404);
        }
    }
    // TÌM THEO TRƯỜNG & LỌC GIÁ
    public function search(Request $request)
    {
        $query = Book::query()->with(['category', 'warehouse' => function ($query) {
            $query->select('book_id', 'quantity', 'retail_price', 'wholesale_price', 'supplier_id');
        }])->whereHas('warehouse', function ($query) {
            $query->whereNotNull('book_id');
        })->where('status', 1);
        $category_slug = $request->input('category_slug');
        $name = $request->input('name');
        $author = $request->input('author');
        $publisher = $request->input('published_company');
        $published_year = $request->input('published_year');
        $minPrice = $request->input('min_price');
        $maxPrice = $request->input('max_price');
        $sortName = $request->input('sort_name', '');
        $sortPrice = $request->input('sort_price', '');
        $sortDate = $request->input('sort_date', '');
        if (!empty($category_slug) && $category_slug) {
            $category = Category::where('slug', $category_slug)->first();
            if ($category) {
                $categoryIds = $category->children()->pluck('id')->prepend($category->id);
                $query->whereHas('category', function ($query) use ($categoryIds) {
                    $query->whereIn('id', $categoryIds);
                });
            }
        }
        if (!empty($name) && $name) {
            $query->where('name', $name);
        }
        if (!empty($author) && $author) {
            $query->where('author', 'like', '%' . $author . '%');
        }
        if (!empty($publisher) && $publisher) {
            $query->whereHas('warehouse.supplier', function ($query) use ($publisher) {
                $query->where('name', $publisher);
            });
        }
        if (!empty($published_year) && $published_year) {
            $query->where('published_year', $published_year);
        }
        if ($minPrice || $maxPrice) {
            $query->whereHas('warehouse', function ($query) use ($minPrice, $maxPrice) {
                if ($minPrice) {
                    $query->where('retail_price', '>=', $minPrice);
                }
                if ($maxPrice) {
                    $query->where('retail_price', '<=', $maxPrice);
                }
            });
        }
        if ($sortName !== '') {
            $query->orderBy('name', $sortName);
        }
        if ($sortPrice !== '') {
            $query->leftJoin('warehouses', 'books.id', '=', 'warehouses.book_id')
                ->orderBy('warehouses.retail_price', $sortPrice)
                ->select('books.*');
        }
        if ($sortDate !== '') {
            if ($sortDate === 'asc') {
                $query->leftJoin('warehouses', 'books.id', '=', 'warehouses.book_id')
                    ->orderBy('warehouses.updated_at', 'asc')
                    ->select('books.*');
            } elseif ($sortDate === 'desc') {
                $query->leftJoin('warehouses', 'books.id', '=', 'warehouses.book_id')
                    ->orderBy('warehouses.retail_price', 'desc')
                    ->select('books.*');
            }
        }
        $books = $query->paginate(12);
        if ($books->isEmpty()) {
            return response()->json(['message' => 'Không tìm thấy sách phù hợp'], 404);
        } else {
            return response()->json(['message' => 'Success', 'data' => $books]);
        }
    }
}
