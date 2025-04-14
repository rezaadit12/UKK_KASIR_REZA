<?php

use App\Http\Middleware\IsAdmin;
use App\Http\Middleware\IsGuest;
use App\Http\Middleware\IsLogin;
use App\Http\Middleware\IsPetugas;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'Excel' => Maatwebsite\Excel\Facades\Excel::class,
            'AUTH' => IsLogin::class,
            'GUEST' => IsGuest::class,
            'ADMIN' => IsAdmin::class,
            'PETUGAS' => IsPetugas::class,
        ]); 
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
