<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserStoreRequest extends FormRequest
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
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'phone_number' => 'required|string|min:10',
            'area_code' => 'required|string|min:2',
            'email' => 'required|email|unique:users,email',
            // 'nationality' => 'required|string',
            'password' => 'required|string',
            'confirm_password' =>'required|string|same:password',
            'birth_date' => 'required'
            // 'country' => 'required',
            // 'city' => 'required',
        ];
    }
}
