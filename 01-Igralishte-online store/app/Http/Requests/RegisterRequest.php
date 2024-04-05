<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules;




class RegisterRequest extends FormRequest
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
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique(User::class)],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ];
    }
    public function messages(): array
    {
        return [
            'first_name.required' => 'Полето за име е задолжително.',
            'last_name.required' => 'Полето за презиме е задолжително.',
            'email.required' => 'Полето за емаил адреса е задолжително.',
            'email.email' => 'Внесете валидна емаил адреса.',
            'email.unique' => 'Веќе постои корисник со внесената емаил адреса.',
            'password.required' => 'Полето за лозинка е задолжително.',
            'password.confirmed' => 'Лозинките мора да се совпаѓаат.',
        ];
    }
}
