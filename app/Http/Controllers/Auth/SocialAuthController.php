<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;

class SocialAuthController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback(Request $request)
    {
        $googleUser = Socialite::driver('google')->user();

        $user = User::updateOrCreate(
            ['email' => $googleUser->getEmail()],
            [
                'name' => $googleUser->getName() ?? 'User',
                'google_id' => $googleUser->getId(),
                'avatar' => $googleUser->getAvatar(),
                'password' => bcrypt(Str::random(32)),
                'role' => 'siswa',
                'email_verified_at' => now(),
            ]
        );

        // 🔑 KUNCI UTAMA
        Auth::guard('web')->loginUsingId($user->id, true);

        // 🔐 AMANKAN SESSION & CSRF
        $request->session()->regenerate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}