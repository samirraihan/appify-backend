<?php

namespace App\Modules\Comment\Services;

use App\Core\Contracts\CommentRepositoryInterface;

class CommentService
{
    protected CommentRepositoryInterface $comments;

    public function __construct(CommentRepositoryInterface $comments)
    {
        $this->comments = $comments;
    }

    public function create(array $data)
    {
        return $this->comments->create($data);
    }
}
