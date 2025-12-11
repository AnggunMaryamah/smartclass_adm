<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckActive
{
    public function handle(Request $request, Closure $next)
    {
        $user = $request->user();

        // Jika guru status pending → redirect ke halaman pending
        if ($user && $user->role === 'guru' && ($user->status_akun ?? '') !== 'active') {
            return redirect()->route('register.pending');
        }

        return $next($request);
    }
}