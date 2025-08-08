<?php
namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Blog;
use App\Models\Post;
use Illuminate\Http\JsonResponse;

class PostController extends Controller
{
    public function index($blogId): JsonResponse
    {
        $posts = Post::where('blog_id', $blogId)->with(['likes', 'comments'])->get();
        return response()->json(['data' => $posts], 200);
    }

    public function store(StorePostRequest $request, $blogId): JsonResponse
    {
        $blog = Blog::findOrFail($blogId);
        $post = $blog->posts()->create($request->validated());
        return response()->json(['data' => $post, 'message' => 'Post created successfully'], 201);
    }

    public function show($blogId, $postId): JsonResponse
    {
        $post = Post::where('blog_id', $blogId)->with(['likes', 'comments'])->findOrFail($postId);
        return response()->json(['data' => $post], 200);
    }

    public function update(UpdatePostRequest $request, $blogId, $postId): JsonResponse
    {
        $post = Post::where('blog_id', $blogId)->findOrFail($postId);
        $post->update($request->validated());
        return response()->json(['data' => $post, 'message' => 'Post updated successfully'], 200);
    }

    public function destroy($blogId, $postId): JsonResponse
    {
        $post = Post::where('blog_id', $blogId)->findOrFail($postId);
        $post->delete();
        return response()->json(['message' => 'Post deleted successfully'], 200);
    }
}