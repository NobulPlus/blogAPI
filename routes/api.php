<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\CommentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

Route::post('/login', function (Request $request) {
    if (Auth::attempt($request->only('email', 'password'))) {
        return response()->json([
            'token' => Auth::user()->createToken('api')->plainTextToken,
        ]);
    }
    return response()->json(['message' => 'Invalid credentials'], 401);
})->name('login');

Route::middleware(['token'])->group(function () {
    // Blog Routes
    Route::get('/blogs', [BlogController::class, 'index']);
    Route::post('/blogs', [BlogController::class, 'store']);
    Route::get('/blogs/{id}', [BlogController::class, 'show']);
    Route::put('/blogs/{id}', [BlogController::class, 'update']);
    Route::delete('/blogs/{id}', [BlogController::class, 'destroy']);

    // Post Routes
    Route::get('/blogs/{blogId}/posts', [PostController::class, 'index']);
    Route::post('/blogs/{blogId}/posts', [PostController::class, 'store']);
    Route::get('/blogs/{blogId}/posts/{postId}', [PostController::class, 'show']);
    Route::put('/blogs/{blogId}/posts/{postId}', [PostController::class, 'update']);
    Route::delete('/blogs/{blogId}/posts/{postId}', [PostController::class, 'destroy']);

    // Like and Comment Routes
    Route::post('/blogs/{blogId}/posts/{postId}/like', [LikeController::class, 'store']);
    Route::post('/blogs/{blogId}/posts/{postId}/comment', [CommentController::class, 'store']);
});