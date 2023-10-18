<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    private $category;

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
        $categories = $this->category::tree();
        return view('Admin.Categories.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {
        //
        if ($request->isMethod('POST')) {
            $newCategory = $this->category;
            $newCategory->name = $request->name;
            $newCategory->slug = Str::slug($request->name);
            $newCategory->parent_id = $request->parent_id;
            $newCategory->description = $request->description;
            $newCategory->save();
            if ($newCategory->save()) {
                return redirect()->route('admin.category.index')->with('category.add.success', 'Thêm danh mục thành công !!!');
            }
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $category = $this->category->find($id);
        return view('Admin.Categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        if ($id) {
            $category = $this->category::find($id);
            $categories = $this->category::tree();
            return view('Admin.Categories.edit', compact('category', 'categories'));
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        if ($id) {
            $updateCategory = $this->category::find($id);
            $updateCategory->name = $request->name;
            $updateCategory->slug = Str::slug($request->name);
            $updateCategory->parent_id = $request->parent_id;
            $updateCategory->description = $request->description;
            $updateCategory->save();
            if ($updateCategory->save()) {
                return redirect()->route('admin.category.index')->with('category.update.success', 'Cập nhập danh mục thành công !!!');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(string $id)
    {
        if ($id) {
            $archiveCategory = $this->category->where('id', $id);
            if ($archiveCategory->delete()) {
                return redirect()->route('admin.category.index')->with('category.archive.success', 'Danh mục đã được chuyển vào thùng rác !!!');
            }
        }
    }
    public function destroy(string $id)
    {
        //

    }
}
