<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class LikeResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'user' => new UserResource($this->whenLoaded('user')),
            'likeable_type' => $this->likeable_type,
            'likeable_id' => $this->likeable_id,
            'created_at' => $this->created_at,
        ];
    }
}
