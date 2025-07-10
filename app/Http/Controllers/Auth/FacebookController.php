<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class FacebookController extends Controller
{
    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function handleFacebookCallback()
    {
        try {
            $facebookUser = Socialite::driver('facebook')->user();
            $user = User::where('email', $facebookUser->getEmail())->first();

            if (!$user) {
                $user = User::create([
                    'name' => $facebookUser->getName(),
                    'email' => $facebookUser->getEmail(),
                    'facebook_id' => $facebookUser->getId(),
                    'password' => bcrypt('password'), // Default password (can be changed later)
                    'email_verified_at' => now(), // ✅ Auto-verify email
                ]);

                $user->emailNotifications()->attach(1);
                $user->emailNotifications()->attach(3);
                $user->emailNotifications()->attach(4);
                $user->emailNotifications()->attach(6);
                $user->emailNotifications()->attach(7);
                // $user->emailNotifications()->attach(8);
            }

            Auth::login($user);

            return redirect()->intended('/');
        } catch (\Exception $e) {
            return redirect('/')->with('error', 'Something went wrong!');
        }
    }
}