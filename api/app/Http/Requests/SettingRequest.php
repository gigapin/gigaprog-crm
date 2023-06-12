<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class SettingRequest extends FormRequest
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
            'fiscal_code' => 'string|max:16|nullable',
            'vat' => 'digits:11|nullable',
            'address' => 'string|nullable',
            'city' => 'string|nullable',
            'area' => 'string|nullable',
            'region' => 'string|nullable',
            'state' => 'string|nullable',
            'phone' => 'string|nullable',
            'email' => 'email:unique|nullable',
            'post_code' => 'digits:6|nullable',
            'bank' => 'string|nullable',
            'iban' => 'string|max:34|nullable'
        ];
    }
}
