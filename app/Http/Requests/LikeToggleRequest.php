<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LikeToggleRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'likeable_type' => 'required|string|in:post,comment',
            'likeable_id' => 'required|integer',
        ];
    }
}
