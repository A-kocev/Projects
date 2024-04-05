<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique(User::class)->ignore($this->user()->id)],
            'phone_number' => 'required|numeric',
            'profile_img' => 'image'
        ];
    }
    public function messages(): array
    {
        return [
            'name.required' => 'Полето за име е задолжително.',
            'email.required' => 'Полето за е-пошта е задолжително.',
            'email.email' => 'Внесете валидна е-пошта.',
            'email.unique' => 'Веќе постои корисник со внесената е-пошта.',
            'phone_number.required' => 'Полето за телефонски број е задолжително.',
            'phone_number.numeric' => 'Телефонскиот број може да содржи само цифри.',
            'profile_img.image' => 'За профилна слика се прифаќа само формат од слика.',
        ];
    }
}
