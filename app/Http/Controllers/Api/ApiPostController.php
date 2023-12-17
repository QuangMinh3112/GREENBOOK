<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Models\CategoryPost;
use App\Models\Post;
use Illuminate\Http\Request;

class ApiPostController extends Controller
{
    //
    public function index()
    {
        $posts = Post::with('category')->where('status', 1)->paginate(10);
        return response()->json(['message' => 'Success', 'data' => PostResource::collection($posts)], 200);
    }
    public function show(string $id)
    {
        //
        $post = Post::find($id);
        if ($post && $post->status === 'Công bố') {
            $post->view += 1;
            $post->save();
            return response()->json(['message' => 'Success', 'data' => new PostResource($post)], 200);
        } else {
            return response()->json(['message' => 'Not Found'], 404);
        }
    }
    public function searchByFiled($field, $name)
    {
        if ($field === "category_id") {
            $post = Post::where('category_id', $name)->where('status', 1)->get();
            if ($post) {
                return response()->json(['message' => 'Đã tìm thấy sản phẩm', 'data' => PostResource::collection($post)], 200);
            } else {
                return response()->json(['message' => 'Không tìm thấy sản phẩm phù hợp'], 404);
            }
        } else {
            $post = Post::where($field, 'LIKE', '%' . $name . '%')->where('status', 1)->get();
            if ($post) {
                return response()->json(['message' => 'Đã tìm thấy sản phẩm', 'data' => PostResource::collection($post)], 200);
            } else {
                return response()->json(['message' => 'Không tìm thấy sản phẩm phù hợp'], 404);
            }
        }
    }
    public function relatedPost($postId)
    {
        $currentPost = Post::find($postId);
        if (!$currentPost) {
            return response()->json(['message' => 'Không tìm thấy sách có liên quan'], 404);
        }
        $relatedPost = Post::where('id', '!=', $currentPost->id)->where('category_id', $currentPost->category_id)->where('status', 1)->with('category')->latest()->paginate(5);
        if ($relatedPost) {
            return response()->json(['message' => 'Success', 'data' => PostResource::collection($relatedPost)], 200);
        } else if ($relatedPost->isEmty()) {
            return response()->json(['message' => 'Không tìm thấy sách có liên quan'], 404);
        }
    }
    public function topPost()
    {
        $books = Post::orderByDesc('view')->where('status', 1)->take(10)->get();
        return response()->json(['message' => 'Success', 'data' => PostResource::collection($books)]);
    }
}
