<?php

namespace App\Http\Requests;

use App\Models\Contact;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateContactRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        /** @var Contact $contact */
        $contact = $this->route('contact');

        return [
            'name' => ['required', 'string', 'min:6'],
            'contact' => [
                'required',
                'digits:9',
                Rule::unique('contacts', 'contact')
                    ->whereNull('deleted_at')
                    ->ignore($contact->id),
            ],
            'email' => [
                'required',
                'email',
                Rule::unique('contacts', 'email')
                    ->whereNull('deleted_at')
                    ->ignore($contact->id),
            ],
        ];
    }
}
