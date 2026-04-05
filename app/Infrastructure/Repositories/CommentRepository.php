<?php

namespace App\Infrastructure\Repositories;

use App\Core\Contracts\CommentRepositoryInterface;
use App\Models\Comment;

class CommentRepository implements CommentRepositoryInterface
{
    public function create(array $data): Comment
    {
        return Comment::create($data);
    }

    public function findById(int $id): ?Comment
    {
        return Comment::with(['user','likes','replies'])->find($id);
    }
}
