<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;

class ApiCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $categories = Category::tree();
        if ($categories) {
            return response()->json(['message' => 'Success', 'data' => CategoryResource::collection($categories)], 200);
        } else {
            return response()->json(['message' => 'Not Found'], 404);
        }
    }

    /**
     * Store a newly created resource in storage.
     */

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $category = Category::find($id);
        if ($category) {
            return new CategoryResource($category);
        } else {
            return response()->json(['message' => 'danh muc khong ton tai'], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */

    /**
     * Remove the specified resource from storage.
     */
}
