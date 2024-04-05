<?php

namespace App\Http\Requests;

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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
            'quantity' => 'required|numeric',
            'sizes' => 'required|array|min:1',
            'size_hint' => 'required',
            'colors' => 'required|array|min:1',
            'maintenance_guidelines' => 'required',
            'brand' => 'required',
            'category' => 'required',
            'tags' => 'required',
        ];
    }
    public function messages(): array
    {
        return [
            'name.required' => 'Полето за име е задолжително.',
            'description.required' => 'Полето за опис е задолжително.',
            'price.required' => 'Полето за цена е задолжително.',
            'quantity.required' => 'Полето за количина е задолжително.',
            'quantity.numeric' => 'Полето за количина мора да биде во бројки.',
            'sizes.*' => 'Најмалку една величина е задолжителна.',
            'size_hint.required' => 'Полето за совет за величина е задолжително.',
            'colors.*' => 'Најмалку една боја е задолжителна.',
            'maintenance_guidelines.required' => 'Полето за насоки за одржување е задолжително.',
            'brand.required' => 'Полето за бренд е задолжително.',
            'category.required' => 'Полето за категорија е задолжително.',
            'tags.required' => 'Најмалку една ознака е задолжителна',
        ];
        
    }
}
