<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;

class UpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['string', 'max:255', 'nullable'],
            'email' => ['string', 'email', 'max:255', Rule::unique('users')->ignore(request()->user->id), 'nullable'],
            'password' => [Rules\Password::defaults(), 'nullable'],
            'avatar' => ['image', 'nullable'],
        ];
    }
}
