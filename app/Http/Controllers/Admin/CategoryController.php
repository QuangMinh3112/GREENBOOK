<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;

class CategoryController extends Controller
{
    private $category;

    public function __construct(Category $category)
    {
        $this->category = $category;
    }
    public function index(Request $request)
    {
        $categories = $this->category->latest()->paginate(10);
        if ($request->post() && $request->search) {
            $categories = Category::where('name', 'like', '%' . $request->search . '%')->paginate(10);
        }
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
                Alert::success('Thêm danh mục thành công');
                return redirect()->route('admin.category.index');
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
                Alert::success('Cập nhật danh mục thành công !!!');
                return redirect()->route('admin.category.index');
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
                Alert::success('Đã di chuyển vào thùng rác');
                return redirect()->route('admin.category.index');
            }
        }
    }
    public function archive()
    {
        $archiveCategory = $this->category->onlyTrashed()->paginate(10);
        return view('Admin.Categories.archive', compact('archiveCategory'));
    }
    public function restore(string $id)
    {
        $category = $this->category->withTrashed()->find($id);
        $category->restore();
        if ($category->restore()) {
            Alert::success('Khôi phục thành công');
            return back();
        }
    }
    public function destroy(string $id)
    {
        $category = $this->category->withTrashed()->find($id);
        $category->forceDelete();
        if ($category->forceDelete()) {
            Alert::success('Xoá thành công');
            return back();
        }
    }
}
