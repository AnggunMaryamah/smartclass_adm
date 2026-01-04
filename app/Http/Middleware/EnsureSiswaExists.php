<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsureSiswaExists
{
    public function handle(Request $request, Closure $next)
    {
        $user = auth()->user();

        // admin tetap boleh lewat
        if ($user && $user->role === 'admin') {
            return $next($request);
        }

        // role siswa tapi BELUM daftar siswa
        if ($user && $user->role === 'siswa' && !$user->siswa) {
            return redirect()->route('pilih.role');
        }

        return $next($request);
    }
}