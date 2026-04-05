<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'text' => 'nullable|string',
            'is_public' => 'required|boolean|in:0,1',
            'image' => 'nullable|image|max:5120',
        ];
    }
}
