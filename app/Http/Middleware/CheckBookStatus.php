<?php

namespace App\Http\Middleware;

use App\Models\Book;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckBookStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $book = Book::find($request->book_id);
        if (!$book) {
            return response()->json(['message' => 'Không tìm thấy sản phẩm'], 404);
        }
        if ($book->status === 0) {
            return response()->json(['message' => 'Sản phẩm ngừng hoạt động'], 422);
        }
        return $next($request);
    }
}
