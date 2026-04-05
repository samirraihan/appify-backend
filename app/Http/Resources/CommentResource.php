<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'user' => new UserResource($this->whenLoaded('user')),
            'post_id' => $this->post_id,
            'parent_id' => $this->parent_id,
            'text' => $this->text,
            'likes_count' => $this->whenLoaded('likes', fn () => $this->likes->count()),
            'replies' => CommentResource::collection($this->whenLoaded('replies')),
            'created_at' => $this->created_at,
        ];
    }
}
