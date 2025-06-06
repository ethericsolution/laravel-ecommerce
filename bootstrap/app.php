<?php

use App\Http\Middleware\RemoveTrailingSlash;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->append([
            RemoveTrailingSlash::class,
        ]);

        $middleware->redirectGuestsTo(fn(Request $request) => $request->routeIs('admin.*') ? route('admin.login') : route('login'));

        $middleware->redirectUsersTo(fn(Request $request) => $request->routeIs('admin.login') ? route('admin.dashboard') : route('account.dashboard'));
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
