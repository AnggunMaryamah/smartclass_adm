<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        // Kalau belum login, arahkan ke login
        if (! $request->user()) {
            return redirect()->route('login');
        }

        $userRole = strtolower($request->user()->role ?? '');
        $requiredRole = strtolower($role);

        // Kalau role tidak sesuai, redirect ke dashboard masing-masing
        if ($userRole !== $requiredRole) {

            // Tentukan dashboard sesuai role user di database
            switch ($userRole) {
                case 'admin':
                    $redirectUrl = '/admin/dashboard';
                    break;

                case 'guru':
                    $redirectUrl = '/guru/dashboard';
                    break;

                case 'siswa':
                    $redirectUrl = '/siswa/dashboard';
                    break;

                default:
                    $redirectUrl = '/dashboard'; // fallback umum
            }

            return redirect($redirectUrl)
                ->with('error', 'Anda tidak memiliki akses ke halaman tersebut.');
        }

        // Role sesuai, lanjutkan request
        return $next($request);
    }
}