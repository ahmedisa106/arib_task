<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class ManagerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {

        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:managers,email,' . $this->id],
            'phone' => ['required', 'unique:managers,phone,' . $this->id, 'numeric', 'starts_with:010,015,011', 'min_digits:9', 'max_digits:11'],
            'password' => ['sometimes', request()->getMethod() == 'PUT' ? 'nullable' : "required", Password::min(8)->mixedCase()->symbols()]
        ];
    }
}
