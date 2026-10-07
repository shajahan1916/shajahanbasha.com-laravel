<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ContactRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'name'    => ['required', 'string', 'min:2', 'max:80'],
            'email'   => ['required', 'string', 'email:rfc', 'max:180'],
            'message' => ['required', 'string', 'min:10', 'max:4000'],
            'intent'  => ['nullable', 'string', Rule::in(config('portfolio.contact.intents'))],

            // Honeypot — must arrive empty.
            'website' => ['prohibited'],
        ];
    }

    /**
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name.required'    => 'Please tell me your name.',
            'email.required'   => 'I need an email address to reply to.',
            'email.email'      => "That email address doesn't look right.",
            'message.required' => 'Add a short message so I know what this is about.',
            'message.min'      => 'A little more detail would help — at least 10 characters.',
            'website.prohibited' => 'This submission looked automated. Please try again.',
        ];
    }

    /**
     * The message that actually gets emailed.
     */
    public function intent(): string
    {
        return $this->input('intent') ?: 'General enquiry';
    }
}
