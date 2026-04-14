<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreProjectRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }
 
    public function rules(): array
    {
        return [
            'name'        => ['required', 'string', 'max:100', 'unique:projects,name'],
            'description' => ['nullable', 'string', 'max:500'],
            'is_public'   => ['boolean'],
        ];
    }
}