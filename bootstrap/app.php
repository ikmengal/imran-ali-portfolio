<?php

use App\Exceptions\Handler;
use App\Http\Middleware\AdminMiddleware;
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
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            'admin' => AdminMiddleware::class,
            'verified.or.superadmin' => \App\Http\Middleware\VerifiedOrSuperAdmin::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->shouldRenderJsonWhen(
            fn (Request $request) => $request->is('api/*') || $request->expectsJson(),
        );
        
        $exceptions->renderable(function (\Throwable $e, \Illuminate\Http\Request $request) {
            $handler = app(Handler::class);
            
            // Determine if this is an admin request
            $isAdmin = $request->is('admin/*') || $request->is('admin') || 
                       str_starts_with($request->path(), 'admin');

            if ($isAdmin) {
                return $handler->renderAdminError($e, $request);
            }

            return $handler->renderFrontendError($e, $request);
        });
    })->create();
