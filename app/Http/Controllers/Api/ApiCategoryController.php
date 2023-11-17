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
        return CategoryResource::collection($categories);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $category = Category::create($request->all());
        return response()->json(['message' => 'Them moi thanh cong'], 200);
        return new CategoryResource($category);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
    public function update(Request $request, string $id)
    {
        //
        $category = Category::find($id);
        if ($category) {
            $category->update($request->all());
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
        $category = Category::find($id);
        if ($category) {
            $category->delete();
            return response()->json(['message' => 'Xoa thanh cong'], 200);
        } else {
            return response()->json(['message' => 'Sach khong ton tai'], 404);
        }
    }
}
