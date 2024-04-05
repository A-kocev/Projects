<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class PasswordController extends Controller
{
    /**
     * Update the user's password.
     */
    public function index()
    {
        return view('profile.partials.update-password-form');
    }
    public function update(Request $request): RedirectResponse
    {
        $customMessages = [
            'current_password.current_password' => 'Внесената лозинка не е точна.',
            'password.required' => 'Полето за нова лозинка е задолжително.',
            'password.confirmed' => 'Новата лозинка не се совпаѓа со потврдената лозинка.',
            // Add more custom messages as needed
        ];

        $validated = $request->validateWithBag('updatePassword', [
            'current_password' => ['required', 'current_password'],
            'password' => ['required', Password::defaults(), 'confirmed'],
        ], $customMessages);

        $request->user()->update([
            'password' => Hash::make($validated['password']),
        ]);

        return redirect()->route('profile.edit')->with('successUpdate', 'Успешно си ја променивте лозинката');
    }
}
