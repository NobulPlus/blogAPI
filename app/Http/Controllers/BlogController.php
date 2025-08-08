<?php
namespace App\Http\Controllers;

use App\Http\Requests\StoreBlogRequest;
use App\Http\Requests\UpdateBlogRequest;
use App\Models\Blog;
use Illuminate\Http\JsonResponse;

class BlogController extends Controller
{
    public function index(): JsonResponse
    {
        $blogs = Blog::with('posts')->get();
        return response()->json(['data' => $blogs], 200);
    }

    public function store(StoreBlogRequest $request): JsonResponse
    {
        $blog = Blog::create($request->validated());
        return response()->json(['data' => $blog, 'message' => 'Blog created successfully'], 201);
    }

    public function show($id): JsonResponse
    {
        $blog = Blog::with('posts')->findOrFail($id);
        return response()->json(['data' => $blog], 200);
    }

    public function update(UpdateBlogRequest $request, $id): JsonResponse
    {
        $blog = Blog::findOrFail($id);
        $blog->update($request->validated());
        return response()->json(['data' => $blog, 'message' => 'Blog updated successfully'], 200);
    }

    public function destroy($id): JsonResponse
    {
        $blog = Blog::findOrFail($id);
        $blog->delete();
        return response()->json(['message' => 'Blog deleted successfully'], 200);
    }
}