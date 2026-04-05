<?php

namespace App\Modules\Like\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\LikeToggleRequest;
use App\Modules\Like\Services\LikeService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\JsonResponse;
use App\Http\Resources\UserResource;

/**
 * Likes endpoints
 *
 * @group Likes
 * @authenticated
 */
class LikeController extends Controller
{
    protected LikeService $service;

    public function __construct(LikeService $service)
    {
        $this->service = $service;
    }

    /**
     * Toggle like/unlike on a resource
     *
     * @param LikeToggleRequest $request
     * @return JsonResponse
     */
    public function toggle(LikeToggleRequest $request): JsonResponse
    {
        $data = $request->validated();

        $userId = Auth::id();
        $result = $this->service->toggle($userId, $data['likeable_type'], $data['likeable_id']);

        return response()->json(['liked' => $result]);
    }

    /**
     * List users who liked a resource
     *
     * @param LikeToggleRequest $request
     * @return JsonResponse
     */
    public function whoLiked(LikeToggleRequest $request): JsonResponse
    {
        $data = $request->validated();

        $users = $this->service->whoLiked($data['likeable_type'], $data['likeable_id']);
        return UserResource::collection($users)->response();
    }
}
