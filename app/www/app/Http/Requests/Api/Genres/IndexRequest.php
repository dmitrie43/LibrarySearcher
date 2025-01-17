<?php

namespace App\Http\Requests\Api\Genres;

use Illuminate\Foundation\Http\FormRequest;

class IndexRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'offset' => ['nullable', 'integer'],
            'limit' => ['nullable', 'integer'],
            'select' => ['nullable', 'string'],
            'relations' => ['nullable', 'string'],
            'id' => ['nullable', 'integer'],
        ];
    }
}
