<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\RoleAccess;


return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // $middleware->alias([
        //     'role.access' => RoleAccess::class,
        // RoleAccess::class;
        // \App\Http\Middleware\EnsureAdminOrStaff::class;

        // ]);

    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
    
