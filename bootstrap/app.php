<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

//  Importa tus middlewares personalizados
use App\Http\Middleware\IsAdmin;
use App\Http\Middleware\RoleMiddleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )

    //  Aquí registramos los middlewares personalizados
    ->withMiddleware(function (Middleware $middleware): void {
        // Alias personalizados para usar en tus rutas
        $middleware->alias([
            'isAdmin' => IsAdmin::class,
            'role' => RoleMiddleware::class,
        ]);
    })

    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })
    ->create();

