<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Http\Requests\CategoryPostRequest;
use App\Models\CategoryPost;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;

class CategoryPostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    private $category;
    public function __construct(CategoryPost $category)
    {
        $this->category = $category;
    }
    public function index()
    {
        $categoryPost = $this->category->where('parent_id', null)->with('children')->get();
        return view('Admin.CategoryPosts.index', compact('categoryPost'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $categories = $this->category::tree();
        return view('Admin.CategoryPosts.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryPostRequest $request)
    {
        if ($request->isMethod('POST')) {
            $newCategory = $this->category;
            $newCategory->name = $request->name;
            $newCategory->slug = Str::slug($request->name);
            $newCategory->parent_id = $request->parent_id;
            $newCategory->description = $request->description;
            $newCategory->save();
            if ($newCategory->save()) {
                Alert::success('Thêm danh mục thành công');
                return redirect()->route('admin.category-post.index');
            } else {
                Alert::error('Đã sảy ra một số vấn đề');
                return back();
            }
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $category = $this->category->find($id);
        return view('Admin.CategoryPosts.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        if ($id) {
            $category = $this->category::find($id);
            $categories = $this->category::tree();
            return view('Admin.CategoryPosts.edit', compact('category', 'categories'));
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if ($id) {
            $updateCategory = $this->category::find($id);
            $updateCategory->name = $request->name;
            $updateCategory->slug = Str::slug($request->name);
            $updateCategory->parent_id = $request->parent_id;
            $updateCategory->description = $request->description;
            $updateCategory->save();
            if ($updateCategory->save()) {
                Alert::success('Cập nhật danh mục thành công !!!');
                return redirect()->route('admin.category-post.index');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(string $id)
    {
        if ($id) {
            $rootCategory = $this->category->find($id);
            if ($rootCategory) {
                foreach ($rootCategory->children as $child) {
                    $this->delete($child->id);
                }
            }
            if ($rootCategory->delete()) {
                Alert::success('Đã di chuyển vào thùng rác');
                return back();
            }
        }
    }
}
