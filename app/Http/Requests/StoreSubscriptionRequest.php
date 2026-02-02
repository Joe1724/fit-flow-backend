<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSubscriptionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            // Ensure the table name is 'membership_plans' AND we look at the 'id' column
            'plan_id' => 'required|exists:membership_plans,id',
        ];
    }
}