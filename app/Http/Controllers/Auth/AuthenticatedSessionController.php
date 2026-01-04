<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    public function create(): View
    {
        return view('auth.login');
    }

    public function store(LoginRequest $request): RedirectResponse
    {
        // Proses login
        $request->authenticate();
        $request->session()->regenerate();

        $user = Auth::user();

        // =========================
        // FINAL REDIRECT LOGIC
        // =========================

        // ADMIN
        if ($user->isAdmin()) {
            return redirect('/admin/dashboard');
        }

        // BELUM DAFTAR SISWA / GURU
        if (!$user->siswa && !$user->guru) {
            return redirect()->route('pilih.role');
        }

        // SISWA
        if ($user->siswa) {
            return redirect('/siswa/dashboard');
        }

        // GURU
        if ($user->guru) {
            return redirect('/guru/dashboard');
        }

        abort(403);
    }

    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}