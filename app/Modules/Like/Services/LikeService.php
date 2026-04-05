<?php

namespace App\Modules\Like\Services;

use App\Core\Contracts\LikeRepositoryInterface;

class LikeService
{
    protected LikeRepositoryInterface $likes;

    public function __construct(LikeRepositoryInterface $likes)
    {
        $this->likes = $likes;
    }

    public function toggle(int $userId, string $type, int $id): bool
    {
        return $this->likes->toggleLike($userId, $type, $id);
    }

    public function whoLiked(string $type, int $id)
    {
        return $this->likes->whoLiked($type, $id);
    }
}
