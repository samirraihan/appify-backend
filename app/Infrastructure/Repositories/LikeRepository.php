<?php

namespace App\Infrastructure\Repositories;

use App\Core\Contracts\LikeRepositoryInterface;
use App\Models\Like;

class LikeRepository implements LikeRepositoryInterface
{
    public function toggleLike(int $userId, string $likeableType, int $likeableId): bool
    {
        $existing = Like::where('user_id', $userId)
            ->where('likeable_type', $likeableType)
            ->where('likeable_id', $likeableId)
            ->first();

        if ($existing) {
            $existing->delete();
            return false;
        }

        Like::create([
            'user_id' => $userId,
            'likeable_type' => $likeableType,
            'likeable_id' => $likeableId,
        ]);

        return true;
    }

    public function whoLiked(string $likeableType, int $likeableId)
    {
        return Like::with('user')
            ->where('likeable_type', $likeableType)
            ->where('likeable_id', $likeableId)
            ->get()
            ->pluck('user');
    }
}
