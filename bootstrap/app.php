<?php

use App\Exceptions\CustomValidationException;
use App\Http\Middleware\admin;
use App\Http\Middleware\AttachAuthToken;
use App\Http\Middleware\Guest;
use App\Http\Middleware\Profilled;
use App\Http\Middleware\Unprofilled;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Validation\ValidationException;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful;
use Spatie\Permission\Exceptions\UnauthorizedException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'role' => \Spatie\Permission\Middleware\RoleMiddleware::class,
            'permission' => \Spatie\Permission\Middleware\PermissionMiddleware::class,
            'role_or_permission' => \Spatie\Permission\Middleware\RoleOrPermissionMiddleware::class,
            'localization' => \App\Http\Middleware\Localization::class,
            'guests' => Guest::class,
            'profilled' => Profilled::class,
            'unprofilled' => Unprofilled::class,
            'admin' => admin::class
        ]);
        $middleware->statefulApi();
        $middleware->use([
            \Illuminate\Cookie\Middleware\EncryptCookies::class, // MUST COME FIRST
            AttachAuthToken::class,
        ]);
        $middleware->group('web', [
            \Illuminate\Session\Middleware\StartSession::class,
            ShareErrorsFromSession::class
        ]);
        $middleware->group('api', [
            \Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ]);
    
    })
    ->withExceptions(function (Exceptions $exceptions) {
        // Custom exception for Unautherized not login yet
        $exceptions->render(function (AuthenticationException $e, Request $request) {
            if ($request->wantsJson()) {
                $response["success"] = false;
                $response['status_code'] = 401;
                $response['message'] = 'Unautherized';
                return response()->json($response, 401);
            } 

            return redirect()->guest(route('login'));
        });

        // Custom exception for UnauthorizedException (dont have permission)
        $exceptions->render(function (UnauthorizedException $e, Request $request) {
            if ($request->wantsJson()) {
                $response["success"] = false;
                $response['status_code'] = 403;
                $response['message'] = 'Forbidden - You do not have permission';
                return response()->json($response, 403);
            }

            session()->flash('alert', [
                'icon' => 'error',
                'message' => 'You dont have permissions',
                'title' => 'Unauthorized'
            ]);

            return redirect()->back();
        });

        // Custom exception for validation form
        $exceptions->render(function (ValidationException $e, Request $request) {
            throw CustomValidationException::withMessages(
                $e->validator->getMessageBag()->getMessages()
            );
        });
    })->create();
