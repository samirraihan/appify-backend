<?php

namespace App\Core\Contracts;

use App\Models\Like;

interface LikeRepositoryInterface
{
    public function toggleLike(int $userId, string $likeableType, int $likeableId): bool;
    public function whoLiked(string $likeableType, int $likeableId);
}
