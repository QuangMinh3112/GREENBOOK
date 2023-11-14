<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CategoryPost;
use App\Models\Post;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Str;


class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    private $post;
    private $category;
    public function __construct(CategoryPost $category, Post $post)
    {
        $this->post = $post;
        $this->category = $category;
    }
    public function index(Request $request)
    {
        $posts = $this->post->latest()->paginate(10);
        $categories = $this->category::tree();
        $query = $this->post::query();
        if ($request->isMethod('POST')) {
        }

        return view('Admin.Post.index', compact('posts', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $categories = $this->category::tree();
        return view('Admin.Post.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request);
        if ($request->isMethod('POST')) {
            if ($request->hasFile('image')) {
                $img = uploadFile('posts', $request->file('image'));
            }
            $this->post->title = $request->title;
            $this->post->slug = Str::slug($request->title);
            $this->post->category_id = $request->category_id;
            $this->post->status = $request->status;
            $this->post->content = $request->content;
            $this->post->image = $img;
            $this->post->save();
            if ($this->post->save()) {
                Alert::success('Thêm bài đăng thành công');
                return redirect()->route('admin.post.index');
            }
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        return view('Admin.Post.show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $post = $this->post::find($id);
        $categories = $this->category::tree();
        return view('Admin.Post.edit', compact('post', 'categories'));
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
