<?php

namespace App\Http\Controllers;

use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class GoogleController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();

            \Log::info('Google Callback Success', [
                'email' => $googleUser->email,
                'name' => $googleUser->name,
            ]);

            $user = User::where('email', $googleUser->email)->first();

            if ($user) {
                Auth::login($user);
                \Log::info('User logged in (existing)', ['email' => $user->email]);
                return redirect()->intended('/');
            } else {
                $newUser = User::create([
                    'name' => $googleUser->name,
                    'email' => $googleUser->email,
                    'password' => Hash::make(uniqid()),
                ]);

                Auth::login($newUser);
                \Log::info('User registered & logged in (new)', ['email' => $newUser->email]);
                return redirect()->intended('/');
            }
        } catch (\Exception $e) {
            \Log::error('Google Login Error', [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
            ]);
            return redirect('/login')->with('error', 'Terjadi kesalahan saat login dengan Google: ' . $e->getMessage());
        }
    }
}
