<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRegiteredRequest extends FormRequest
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
            //
            'email' => [
                'required',
                'email',
                Rule::unique('users', 'email')->ignore($this->input('user')),
            ],
            'phone_number' => [
                'required',
                'numeric',
                'min:10',
                Rule::unique('users', 'phone_number')->ignore($this->input('user')),
            ],
            'user' => 'required|integer|exists:users,id',
            'password' => 'required|string',
            'confirm_password' =>'required|string|same:password',

        ];
    }
}
