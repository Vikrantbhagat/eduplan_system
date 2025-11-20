<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\RoleMiddleware;
use App\Http\Middleware\StudentMiddleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
        // api: __DIR__ . '/../routes/api.php', // Uncomment if you add API routes
    )
    ->withMiddleware(function (Middleware $middleware): void {
        // ✅ Register middleware aliases here
        $middleware->alias([
            'admin'   => AdminMiddleware::class,   // Admin-only access
            'role'    => RoleMiddleware::class,    // Role-based access (e.g. role:instructor)
            'student' => StudentMiddleware::class, // Student-only access
            // 'isAdmin' => IsAdmin::class,

            // 'auth' => Authenticate::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        // Custom exception handling (optional)
    })
    ->create();
