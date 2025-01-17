<?php

namespace App\Http\Requests\Books;

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
            'paginate' => ['nullable', 'integer'],
            'select' => ['nullable', 'string'],
            'relations' => ['nullable', 'string'],
            'genre_id' => ['nullable', 'array'],
            'genre_id.*' => ['integer', 'exists:genres,id'],
            'author_id' => ['nullable', 'array'],
            'author_id.*' => ['integer', 'exists:authors,id'],
            'publisher_id' => ['nullable', 'array'],
            'publisher_id.*' => ['integer', 'exists:publishers,id'],
        ];
    }
}
