<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\File;
use Illuminate\Validation\Rules\Password;

class EmployeeRequest extends FormRequest
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
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:employees,email,' . $this->id],
            'phone' => ['required', 'unique:employees,phone,' . $this->id, 'numeric', 'starts_with:010,015,011', 'min_digits:9', 'max_digits:11'],
            'password' => ['sometimes', request()->getMethod() == 'PUT' ? 'nullable' : "required", Password::min(8)->mixedCase()->symbols()],
            'department_id' => ['required', 'exists:departments,id'],
            'salary' => ['required', 'integer', 'gt:0', 'max_digits:6'],
            'image' => ['sometimes', request()->getMethod() == 'PUT' ? 'nullable' : File::image()->min('1kb')->max('2mb'), 'mimes:png,jpg,jpeg,svg,gif,webp', ''],
        ];
    }
}
