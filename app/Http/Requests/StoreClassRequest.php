<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Mail\Transport\ArrayTransport;

class StoreClassRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'trainer_id' => 'required|exists:users,id',
            'start_time' => 'required|date|after:now',
            'end_time' => 'required|date|after:start_time',
            'capacity' => 'required|integer|min:1',
        ];
    }

}