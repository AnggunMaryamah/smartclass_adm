<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\EnsureSiswaExists;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'role'         => \App\Http\Middleware\RoleMiddleware::class,
            'check.active' => \App\Http\Middleware\CheckActive::class,
            'siswa.exists' => EnsureSiswaExists::class,
            'guru.active'  => \App\Http\Middleware\CheckGuruActive::class, // ✅ FINAL
        ]);

        $middleware->validateCsrfTokens(except: [
            'logout',
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })
    ->create();