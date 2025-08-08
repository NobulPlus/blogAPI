<?php
namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Like;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function store($blogId, $postId): JsonResponse
    {
        $post = Post::where('blog_id', $blogId)->findOrFail($postId);
        $like = Like::firstOrCreate([
            'user_id' => Auth::id(),
            'post_id' => $postId,
        ]);
        return response()->json(['message' => 'Post liked successfully'], 201);
    }
}