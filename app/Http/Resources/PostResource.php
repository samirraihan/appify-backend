<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'user' => new UserResource($this->whenLoaded('user') ?? $this->user),
            'text' => $this->text,
            'image_path' => $this->image_path,
            'image_url' => $this->when($this->image_path, fn () => url('storage/' . $this->image_path)),
            'is_public' => (bool) $this->is_public,
            'comments' => CommentResource::collection($this->whenLoaded('comments')),
            'likes_count' => $this->whenLoaded('likes', fn () => $this->likes->count()),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
