<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use App\Http\Middleware\RoleMiddleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        // Register role middleware alias
        $middleware->alias([
            'role' => RoleMiddleware::class,
        ]);

        // Enable API middleware for stateful requests
        $middleware->statefulApi();
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        // Handle all exceptions and return JSON for API requests
        $exceptions->render(function (Throwable $e, Request $request) {
            if ($request->is('api/*')) {
                // Handle validation exceptions
                if ($e instanceof ValidationException) {
                    return response()->json([
                        'message' => 'Validation failed',
                        'errors' => $e->errors()
                    ], 422);
                }

                // Handle 404 Not Found
                if ($e instanceof NotFoundHttpException) {
                    return response()->json([
                        'message' => 'Resource not found'
                    ], 404);
                }

                // Handle 403 Forbidden
                if ($e instanceof AccessDeniedHttpException) {
                    return response()->json([
                        'message' => 'Access denied'
                    ], 403);
                }

                // Handle authentication exceptions
                if ($e instanceof \Illuminate\Auth\AuthenticationException) {
                    return response()->json([
                        'message' => 'Unauthenticated'
                    ], 401);
                }

                // Handle all other exceptions
                $statusCode = method_exists($e, 'getStatusCode') ? $e->getStatusCode() : 500;
                
                return response()->json([
                    'message' => $e->getMessage() ?: 'An error occurred',
                    'error' => config('app.debug') ? [
                        'exception' => get_class($e),
                        'file' => $e->getFile(),
                        'line' => $e->getLine(),
                        'trace' => $e->getTrace()
                    ] : null
                ], $statusCode);
            }
        });
    })->create();

