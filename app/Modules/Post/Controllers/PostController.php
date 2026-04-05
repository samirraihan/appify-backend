<?php

namespace App\Modules\Post\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostStoreRequest;
use App\Modules\Post\Services\PostService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\JsonResponse;
use App\Http\Resources\PostResource;

/**
 * Posts endpoints
 *
 * @group Posts
 * @authenticated
 */
class PostController extends Controller
{
    protected PostService $service;

    public function __construct(PostService $service)
    {
        $this->service = $service;
    }

    /**
     * Create a post
     *
     * @param PostStoreRequest $request
     * @return JsonResponse
     */
    public function store(PostStoreRequest $request): JsonResponse
    {
        $data = $request->validated();

        $data['user_id'] = Auth::id();

        $post = $this->service->create($data, $request->file('image'));

        return (new PostResource($post))->response()->setStatusCode(201);
    }
}
