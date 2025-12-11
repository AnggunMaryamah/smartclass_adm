<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GeneralLoginController extends Controller
{
    public function showLogin()
    {
        // pakai view Breeze /auth/login (atau resources/views/auth/login.blade.php)
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => ['required','email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials, $request->filled('remember'))) {
            $request->session()->regenerate();

            $user = Auth::user();
            $role = strtolower($user->role ?? 'pengunjung');

            if ($role === 'siswa') {
                return redirect()->intended(route('dashboard.siswa'));
            } elseif ($role === 'guru' || $role === 'teacher') {
                return redirect()->intended(route('dashboard.guru'));
            }

            return redirect()->intended(route('dashboard.pengunjung'));
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->withInput($request->only('email'));
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}