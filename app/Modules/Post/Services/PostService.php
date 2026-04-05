<?php

namespace App\Modules\Post\Services;

use App\Core\Contracts\PostRepositoryInterface;
use Illuminate\Http\UploadedFile;

class PostService
{
    protected PostRepositoryInterface $posts;

    public function __construct(PostRepositoryInterface $posts)
    {
        $this->posts = $posts;
    }

    public function create(array $data, ?UploadedFile $image = null)
    {
        if ($image) {
            $path = $image->store('posts','public');
            $data['image_path'] = $path;
        }

        return $this->posts->create($data);
    }
}
