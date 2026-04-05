<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Auth\Controllers\RegisterController;
use App\Modules\Auth\Controllers\LoginController;
use App\Modules\Post\Controllers\PostController;
use App\Modules\Post\Controllers\FeedController;
use App\Modules\Comment\Controllers\CommentController;
use App\Modules\Like\Controllers\LikeController;

Route::prefix('v1')->group(function () {
    // Public
    Route::post('register', [RegisterController::class, 'register']);
    Route::post('login', [LoginController::class, 'login']);

    // Protected
    Route::middleware([\App\Http\Middleware\ApiTokenAuth::class])->group(function () {
        Route::get('feed', [FeedController::class, 'index']);
        Route::post('posts', [PostController::class, 'store']);

        Route::post('comments', [CommentController::class, 'store']);

        Route::post('likes/toggle', [LikeController::class, 'toggle']);
        Route::get('likes/who', [LikeController::class, 'whoLiked']);

        Route::post('logout', [LoginController::class, 'logout']);
    });
});
