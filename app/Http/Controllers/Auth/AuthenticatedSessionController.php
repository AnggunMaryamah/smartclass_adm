<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use App\Http\Requests\Auth\LoginRequest;

class AuthenticatedSessionController extends Controller
{
    public function create(): View
    {
        return view('auth.login');
    }

    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();
        $request->session()->regenerate();

        $user = Auth::user();
        $role = strtolower(trim($user->role ?? ''));

        if ($role === 'admin') {
            return redirect()->intended('/admin/dashboard');
        }

        if ($role === 'guru') {
            return redirect()->intended('/guru/dashboard');
        }

        if ($role === 'siswa') {
            return redirect()->intended('/siswa/dashboard');
        }

        return redirect()->intended('/dashboard');
    }
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Setelah logout, arahkan ke halaman login
        return redirect()->route('login');
    }
}
