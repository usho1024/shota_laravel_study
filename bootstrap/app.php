<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // authミドルウェアの動作を変更する
        $middleware->redirectGuestsTo(function (Request $request) {
            if ($request->is('admin/*') || $request->routeIs('admin.*')) {
                return route('admin.login');
            }
            return route('login');
        });
        
        // guestミドルウェアの動作を変更する
        $middleware->redirectUsersTo(function (Request $request) {
            if ($request->is('admin/*') || $request->routeIs('admin.*')) {
                return route('admin.top');
            }
            return route('posts.index');
        });
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
