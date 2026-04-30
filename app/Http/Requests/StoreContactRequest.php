<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreContactRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'min:6'],
            'contact' => [
                'required',
                'digits:9',
                Rule::unique('contacts', 'contact')->whereNull('deleted_at'),
            ],
            'email' => [
                'required',
                'email',
                Rule::unique('contacts', 'email')->whereNull('deleted_at'),
            ],
        ];
    }
}
