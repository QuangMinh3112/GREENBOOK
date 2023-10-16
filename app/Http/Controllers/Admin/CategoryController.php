<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    private $category;
    // protected $append = [
    //     'getParentsTree'
    // ];

    // public static function getParentsTree($category, $title)
    // {
    //     if ($category->parent_id == null) {
    //         return $title;
    //     }
    //     $parent = Category::find($category->parent_id);
    //     $title = $parent->title . ' > ' . $title;
    //     return CategoryController::getParentsTree($parent, $title);
    // }

    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    public function index()
    {
        $categories = $this->category->paginate(10);
        return view('Admin.Categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('Admin.Categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $category = $this->category->find($id);
        return response()->json([
            'status' => 200,
            'category' => $category,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
