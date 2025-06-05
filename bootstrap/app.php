<?php

use App\Exceptions\AccessDeniedHttpExceptionRenderer;
use App\Exceptions\NotFoundHttpExceptionRenderer;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

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
        $renderers = [
            NotFoundHttpException::class => NotFoundHttpExceptionRenderer::class,
            AccessDeniedHttpException::class => AccessDeniedHttpExceptionRenderer::class,
            // 他の例外の場合追加可能
        ];

        foreach ($renderers as $exception => $rendererClass) {
            $renderer = new $rendererClass();
            $exceptions->render(function (HttpException $e, $request) use ($exception, $renderer) {
                if ($e instanceof $exception) {
                    return $renderer->render($e, $request);
                }
            });
        }
    })->create();
