<?php

namespace App\Core\Contracts;

use App\Models\Comment;

interface CommentRepositoryInterface
{
    public function create(array $data): Comment;
    public function findById(int $id): ?Comment;
}
