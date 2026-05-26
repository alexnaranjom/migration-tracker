<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreModuleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // No auth for now
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
             'name' => 'required|string|max:255',
             'description' => 'nullable|string',
             'legacy_framework' => 'sometimes|string|max:255',
             'target_framework'=> 'sometimes|string|max:255',
             'status' => 'sometimes|in:not_started,not_started,analyzing,in_progress,testing,completed',
             'priority' => 'sometimes|in:low,medium,high',
             'estimated_hours'=> 'nullable|int|min:1',
             'actual_hours'=> 'nullable|int|min:1',
             'assigned_to'=> 'nullable|string|max:100'
        ];
    }
}
