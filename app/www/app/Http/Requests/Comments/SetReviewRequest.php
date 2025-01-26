<?php

namespace App\Http\Requests\Comments;

use Illuminate\Foundation\Http\FormRequest;

class SetReviewRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'theme' => ['required', 'string', 'max:255'],
            'text' => ['required', 'string'],
            'item_id' => ['required', 'integer'],
            'is_recommended' => ['nullable', 'boolean'],
        ];
    }
}
