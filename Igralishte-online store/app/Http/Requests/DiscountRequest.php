<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DiscountRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required',
            'percentage' => 'required|numeric',
        ];
    }
    public function messages(): array
    {
        return [
            'name.required' => 'Полето за име е задолжително.',
            'percentage.required' => 'Полето за количина на попустот е задолжително',
            'percentage.numeric' => 'Попустот може да биде само во бројки',
        ];
        
    }
}
