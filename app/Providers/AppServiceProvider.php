<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Core\Contracts\PostRepositoryInterface;
use App\Core\Contracts\CommentRepositoryInterface;
use App\Core\Contracts\LikeRepositoryInterface;
use App\Infrastructure\Repositories\PostRepository;
use App\Infrastructure\Repositories\CommentRepository;
use App\Infrastructure\Repositories\LikeRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(PostRepositoryInterface::class, PostRepository::class);
        $this->app->bind(CommentRepositoryInterface::class, CommentRepository::class);
        $this->app->bind(LikeRepositoryInterface::class, LikeRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
