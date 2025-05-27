<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->shouldRenderJsonWhen(function (Request $request, Throwable $e) {
            return $request->is('api/*');
        });

        $exceptions->renderable(function (Throwable $e, Request $request) {
            if (!$request->is('api/*')) return null;

            // Validation errors = 422
            if ($e instanceof ValidationException) {
                return response()->json([
                    'message' => 'Validation failed.',
                    'errors' => $e->errors()
                ], 422);
            }

            // For any other exception, return generic message
            $status = $e instanceof HttpExceptionInterface ? $e->getStatusCode() : 500;

            // Hide message in production
            $message = app()->isProduction()
                ? 'Internal Server Error'
                : $e->getMessage();

            return response()->json([
                'message' => $message,
            ], $status);
        });
    })->create();
