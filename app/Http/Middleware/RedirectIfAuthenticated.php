<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                // User sudah login, cek role dan redirect
                $user = Auth::guard($guard)->user();
                $role = strtolower(trim($user->role ?? ''));

                if ($role === 'admin') {
                    return redirect('/admin/dashboard');
                }

                if ($role === 'guru') {
                    return redirect('/guru/dashboard');
                }

                if ($role === 'siswa') {
                    return redirect('/siswa/dashboard');
                }

                return redirect('/dashboard');
            }
        }

        return $next($request);
    }
}