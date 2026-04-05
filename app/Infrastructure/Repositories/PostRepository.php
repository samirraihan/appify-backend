<?php

namespace App\Infrastructure\Repositories;

use App\Core\Contracts\PostRepositoryInterface;
use App\Models\Post;

class PostRepository implements PostRepositoryInterface
{
    public function create(array $data): Post
    {
        return Post::create($data);
    }

    public function findById(int $id): ?Post
    {
        return Post::with(['user','likes','comments'])->find($id);
    }

    public function feedPublicAndOwn(int $userId)
    {
        return Post::with(['user','likes','comments'])
            ->where(function($q) use ($userId) {
                $q->where('is_public', true)
                  ->orWhere('user_id', $userId);
            })
            ->orderBy('created_at', 'desc');
    }
}
