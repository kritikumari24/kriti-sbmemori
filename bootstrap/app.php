<?php

use Illuminate\Http\Request;
use Illuminate\Foundation\Application;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Validation\ValidationException;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Symfony\Component\Routing\Exception\RouteNotFoundException;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        api: __DIR__ . '/../routes/api.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'admin.guest' => \App\Http\Middleware\AdminRedirect::class,
            'admin.auth' => \App\Http\Middleware\AdminAuthenticate::class,
            'can' => \Illuminate\Auth\Middleware\Authorize::class,
            'log.requests' => \App\Http\Middleware\LogAfterRequestMiddleware::class,
            'role' => \Spatie\Permission\Middleware\RoleMiddleware::class,
            'permission' => \Spatie\Permission\Middleware\PermissionMiddleware::class,
            'role_or_permission' => \Spatie\Permission\Middleware\RoleOrPermissionMiddleware::class,

        ]);

        // $middleware->redirectTo(
        //     guests: '/admin/login',
        //     users: '/admin/dashboard',
        // );
        // $middleware->redirectGuestsTo(fn (Request $request) => route('admin.login'));
    })
    ->withSchedule(function (Schedule $schedule) {
        $schedule->command('telescope:prune')->daily();
    })
    ->withExceptions(function (Exceptions $exceptions) {

        // $exceptions->render(function (RouteNotFoundException $e, Request $request) {
        //     dd($request);
        // });

        $exceptions->render(function (AuthenticationException $e, Request $request) {
            return $request->expectsJson()
                ? response()->json(['message' => $e->getMessage()], 401)
                : redirect()->guest(route('admin.login'));
        });

        $exceptions->render(function (ValidationException $e, Request $request) {
            if ($request->is('*api/*')) {
                return response()->json([
                    'status' => false,
                    'type' => 'validation',
                    'errors' => $e->validator->errors()
                ], 422);
            }
        });
        $exceptions->render(function (UnauthorizedHttpException $e, Request $request) {
            if ($e->getPrevious() instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException) {
                return response()->json([
                    'status' => false,
                    'errors' => 'token_expired'
                ], $e->getStatusCode());
            } else if ($e->getPrevious() instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException) {
                return response()->json([
                    'status' => false,
                    'errors' => 'token_invalid'
                ], $e->getStatusCode());
            } else if ($e->getPrevious() instanceof \Tymon\JWTAuth\Exceptions\TokenBlacklistedException) {
                return response()->json([
                    'status' => false,
                    'errors' => 'token_blacklisted'
                ], $e->getStatusCode());
            } else {
                return response()->json([
                    'status' => false,
                    'errors' => 'Token not found'
                ], $e->getStatusCode());
            }
        });
    })->create();
