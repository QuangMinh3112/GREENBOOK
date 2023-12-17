<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryPostResource;
use App\Models\CategoryPost;
use Illuminate\Http\Request;

class ApiCategoryPostController extends Controller
{
    //
    public function index()
    {
        $categories = CategoryPost::tree();
        if ($categories) {
            return response()->json(['message' => 'Success', 'data' => CategoryPostResource::collection($categories)], 200);
        } else {
            return response()->json(['message' => 'Not Found'], 404);
        }
    }
    public function show(string $id)
    {
        $category = CategoryPost::find($id);
        if ($category) {
            return new CategoryPostResource($category);
        } else {
            return response()->json(['message' => 'danh muc khong ton tai'], 404);
        }
    }
}
