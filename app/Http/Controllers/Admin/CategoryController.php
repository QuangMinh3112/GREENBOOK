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
        $categories = $this->category->where('parent_id', null)->with('children')->paginate(5);
        $title = "Danh mục sản phẩm";
        if ($request->post() && $request->search) {
            $categories = Category::where('name', 'like', '%' . $request->search . '%')->paginate(10);
        }
        return view('Admin.Categories.index', compact('categories', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $title = 'Thêm danh mục';
        $categories = $this->category::tree();
        return view('Admin.Categories.create', compact('categories', 'title'));
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
        $title = 'Chi tiết danh mục';
        $category = $this->category->find($id);
        return view('Admin.Categories.show', compact('category', 'title'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $title = 'Chỉnh sửa danh mục';
        if ($id) {
            $category = $this->category::find($id);
            $categories = $this->category::tree();
            return view('Admin.Categories.edit', compact('category', 'categories', 'title'));
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
