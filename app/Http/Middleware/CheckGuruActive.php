<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckGuruActive
{
    public function handle($request, Closure $next)
    {
        $user = Auth::user();

        if (!$user || !$user->guru) {
            return redirect('/');
        }

        if ($user->guru->status_akun !== 'Aktif') {
            Auth::logout();
            return redirect('/')->withErrors([
                'email' => 'Akun guru belum disetujui admin.'
            ]);
        }

        return $next($request);
    }
}