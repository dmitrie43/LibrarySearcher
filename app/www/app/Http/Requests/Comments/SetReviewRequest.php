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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'theme' => ['required', 'string', 'max:255'],
            'text' => ['required', 'string'],
            'section' => ['required', 'string'],
            'item_id' => ['required', 'integer'],
            'is_recommended' => ['nullable', 'boolean'],
        ];
    }
}
