<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Laravel\Socialite\Facades\Socialite;

class FacebookController extends Controller
{
    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }
    public function handleFacebookCallback()
    {

        $facebookUser = Socialite::driver('facebook')->user();
        $fullName = explode(' ', $facebookUser->name);
        // option 1
        $existingUser = User::where('facebook_id', $facebookUser->id)->first();
        if ($existingUser) {
            Auth::login($existingUser);
            return redirect()->intended(RouteServiceProvider::HOME);
        }


        $existingUser = User::where('email', $facebookUser->email)->first();


        if ($existingUser) {
            return redirect()->route('guest.register')->with('error', 'There is already a user with that email');
        }
        $user = User::create([
            'facebook_id' => $facebookUser->id,
            'email' => $facebookUser->email,
            'first_name' => $fullName[0],
            'last_name' => $fullName[1],
            'phone_number' => $facebookUser->phone_number
        ]);



        // option 2
        // $user = User::updateOrCreate([
        //     'facebook_id' => $facebookUser->id,
        // ], [
        //     'email' => $facebookUser->email,
        //     'first_name' => $fullName[0],
        //     'last_name' => $fullName[1],
        //     'phone_number' => $facebookUser->phone_number
        // ]);
        Auth::login($user);
        return redirect()->intended(RouteServiceProvider::HOME);
    }
}
