<?php

namespace App\Modules\Post\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\FeedRequest;
use App\Core\Contracts\PostRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\JsonResponse;
use App\Http\Resources\PostResource;

/**
 * Feed endpoints
 *
 * @group Feed
 * @authenticated
 */

class FeedController extends Controller
{
    protected PostRepositoryInterface $posts;

    public function __construct(PostRepositoryInterface $posts)
    {
        $this->posts = $posts;
    }

    /**
     * Get feed
     *
     * @param FeedRequest $request
     * @return JsonResponse
     */
    public function index(FeedRequest $request): JsonResponse
    {
        $user = Auth::user();
        $query = $this->posts->feedPublicAndOwn($user->id);
        $perPage = (int) ($request->validated()['per_page'] ?? 15);
        $posts = $query->paginate($perPage);

        return PostResource::collection($posts)->response();
    }
}
