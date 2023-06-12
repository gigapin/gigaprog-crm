<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'code' => ['required', 'integer'],
            'brand' => ['required', 'string'],
            'model' => ['nullable', 'string'],
            'size' => ['nullable', 'string'],
            'name' => ['required', 'string'],
            'colour' => ['nullable', 'string'],
            'description' => ['nullable', 'string'],
            'note' => ['nullable', 'string']
        ];
    }
}
