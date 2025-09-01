<?php

use App\Http\Middleware\auth;
use App\Http\Middleware\CheckUser;
use App\Http\Middleware\DashboardMiddleWare;
use App\Http\Middleware\isAuthentecated;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            "auth" => auth::class,
            "isAuthenticated" => isAuthentecated::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
