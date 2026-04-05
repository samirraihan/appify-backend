<?php

namespace App\Modules\Comment\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\CommentStoreRequest;
use App\Modules\Comment\Services\CommentService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\JsonResponse;
use App\Http\Resources\CommentResource;

/**
 * Comments endpoints
 *
 * @group Comments
 * @authenticated
 */

class CommentController extends Controller
{
    protected CommentService $service;

    public function __construct(CommentService $service)
    {
        $this->service = $service;
    }

    /**
     * Create a comment or reply
     *
     * @param CommentStoreRequest $request
     * @return JsonResponse
     */
    public function store(CommentStoreRequest $request): JsonResponse
    {
        $data = $request->validated();

        $data['user_id'] = Auth::id();

        $comment = $this->service->create($data);

        return (new CommentResource($comment))->response()->setStatusCode(201);
    }
}
