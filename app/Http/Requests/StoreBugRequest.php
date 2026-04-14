<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreBugRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }
 
    public function rules(): array
    {
        return [
            'title'               => ['required', 'string', 'max:255'],
            'description'         => ['required', 'string', 'min:20'],
            'priority'            => ['required', 'in:low,medium,high,critical'],
            'assignee_id'         => ['nullable', 'exists:users,id'],
            'steps_to_reproduce'  => ['nullable', 'string'],
            'expected_behavior'   => ['nullable', 'string'],
            'actual_behavior'     => ['nullable', 'string'],
            'environment'         => ['nullable', 'string', 'max:100'],
        ];
    }
 
    public function messages(): array
    {
        return [
            'title.required'       => 'A bug title is required.',
            'description.min'      => 'Please provide a detailed description (at least 20 characters).',
            'priority.in'          => 'Priority must be: low, medium, high, or critical.',
        ];
    }
}