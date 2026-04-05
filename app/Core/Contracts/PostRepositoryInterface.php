<?php

namespace App\Core\Contracts;

use App\Models\Post;

interface PostRepositoryInterface
{
    public function create(array $data): Post;
    public function findById(int $id): ?Post;
    public function feedPublicAndOwn(int $userId);
}
