<?php

namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;

    }

    public function rules(): array
    {
        return[
            'name' => 'required|string|max:256',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'phone' => 'nullable|string|max:20',
            'dob' => 'nullable|date',
            'emergency_contact' => 'nullable|string|max:256',
        ];
    }
}
