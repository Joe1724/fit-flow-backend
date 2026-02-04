<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'sometimes|string|max:255',
            'phone' => 'sometimes|string|max:20',
            'dob' => 'sometimes|date|before:today',
            'gender' => 'sometimes|string|in:male,female,other',
            'emergency_contact' => 'sometimes|string|max:255',
            'bio' => 'sometimes|string|max:500',
        ];
    }
}
