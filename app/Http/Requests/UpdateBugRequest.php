<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateBugRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->can('update', $this->route('bug'));
    }
 
    public function rules(): array
    {
        return [
            'title'               => ['sometimes', 'string', 'max:255'],
            'description'         => ['sometimes', 'string', 'min:20'],
            'priority'            => ['sometimes', 'in:low,medium,high,critical'],
            'status_id'           => ['sometimes', 'exists:statuses,id'],
            'assignee_id'         => ['nullable', 'exists:users,id'],
            'steps_to_reproduce'  => ['nullable', 'string'],
            'expected_behavior'   => ['nullable', 'string'],
            'actual_behavior'     => ['nullable', 'string'],
            'environment'         => ['nullable', 'string', 'max:100'],
        ];
    }
}