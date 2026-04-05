<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'is_public' => $this->input('is_public', 1),
        ]);
    }

    public function rules(): array
    {
        return [
            'text' => 'nullable|string',
            'is_public' => 'boolean',
            'image' => 'nullable|image|max:5120',
        ];
    }
}
