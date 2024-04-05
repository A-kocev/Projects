<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BrandRequest extends FormRequest
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
            'description' => 'required',
            'categories' => 'required|array|min:1',
            'tags' => 'required',

        ];
    }
    public function messages(): array
    {
        return [
            'name.required' => 'Полето за име е задолжително.',
            'description.required' => 'Полето за опис е задолжително.',
            'categories.*' => 'Најмалку една категорија е задолжителна.',
            'tags.required' => 'Најмалку една ознака е задолжителна',

        ];
        
    }
}
