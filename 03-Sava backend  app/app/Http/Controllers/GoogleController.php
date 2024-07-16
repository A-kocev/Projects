<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }
    
    public function handleGoogleCallback()
    {
        $googleUser = Socialite::driver('google')->user();
        // option 1
        // $existingUser = User::where('google_id', $googleUser->id)->first();
        // if ($existingUser) {
        //     Auth::login($existingUser);
        //     return redirect()->intended(RouteServiceProvider::HOME);
        // }


        // $existingUser = User::where('email', $googleUser->email)->first();

        // if ($existingUser) {
        //     return redirect()->route('guest.register')->with('error', 'There is already a user with that email');
        // }
        // $user = User::create([
        //     'google_id' => $googleUser->id,
        //     'email' => $googleUser->email,
        //     'first_name' => $googleUser->user['given_name'],
        //     'last_name' => $googleUser->user['family_name'],
        //     'phone_number' => $googleUser->phone_number
        // ]);
        // option 2
        $user = User::updateOrCreate([
            'google_id' => $googleUser->id,
        ], [
            'email' => $googleUser->email,
            'first_name' => $googleUser->user['given_name'],
            'last_name' => $googleUser->user['family_name'],
            'phone_number' => $googleUser->phone_number
        ]);
        // missing email verifications for better work flow
    }

}
