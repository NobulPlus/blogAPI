<?php
namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Like;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function store(Request $request, $blogId, $postId): JsonResponse
    {
        $token = $request->bearerToken();

        $user = User::where('token', $token)->first();

        if (!$user) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $post = Post::where('blog_id', $blogId)->findOrFail($postId);

        $like = Like::firstOrCreate([
            'user_id' => $user->id,
            'post_id' => $postId,
        ]);

        return response()->json(['message' => 'Post liked successfully'], 201);
    }
}
