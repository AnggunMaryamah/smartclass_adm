<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, string $role)
    {
        if (!$request->user()) {
            return redirect()->route('login');
        }

        $userRole = strtolower($request->user()->role);
        $requiredRole = strtolower($role);

        if ($userRole !== $requiredRole) {
            return redirect(
                match ($userRole) {
                    'admin' => '/admin/dashboard',
                    'guru' => '/guru/dashboard',
                    'siswa' => '/siswa/dashboard',
                    default => '/dashboard'
                }
            )->with('error', 'Anda tidak memiliki akses ke halaman tersebut.');
        }

        return $next($request);
    }
}