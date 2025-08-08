<?php
namespace App\Http\Controllers;

use App\Http\Requests\StoreCommentRequest;
use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(StoreCommentRequest $request, $blogId, $postId): JsonResponse
    {
        $post = Post::where('blog_id', $blogId)->findOrFail($postId);
        $comment = $post->comments()->create([
            'user_id' => Auth::id(),
            'content' => $request->validated()['content'],
        ]);
        return response()->json(['data' => $comment, 'message' => 'Comment added successfully'], 201);
    }
}