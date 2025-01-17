<?php

namespace App\Http\Requests\Books;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'date_publish' => ['required', 'date'],
            'cover_img' => ['image', 'nullable'],
            'file' => ['mimes:pdf,epub,fb2'],
            'pages_quantity' => ['integer', 'nullable'],
            'description' => ['string', 'max:1000', 'nullable'],
            'age_rating' => ['string', 'max:255', 'nullable'],
            'is_novelty' => ['boolean', 'nullable'],
            'is_popular' => ['boolean', 'nullable'],
            'is_recommended' => ['boolean', 'nullable'],
            'author_id' => ['integer'],
            'publisher_id' => ['integer'],
            'genres' => ['array'],
        ];
    }
}
