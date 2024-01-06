<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;

class ApiReviewController extends Controller
{
    //
    public function show($id)
    {
        $reviews = Review::where('book_id', $id)->paginate(5);
        if (count($reviews) > 0) {
            return response()->json(["message" => "Success", "data" => $reviews], 200);
        } else {
            return response()->json(["message" => "Chưa có đánh giá"], 200);
        }
    }
    // public function filter()
}
