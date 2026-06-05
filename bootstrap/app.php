<?php

use App\Http\Middleware\RoleMiddleware;
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
            'role' => RoleMiddleware::class,
        ]);
        $middleware->web(append: [
            \App\Http\Middleware\SetLocale::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
    $exceptions->render(function (Symfony\Component\HttpKernel\Exception\HttpException $e, $request) {
        if ($e->getStatusCode() === 403) {
            if (auth()->check()) {
                $role = auth()->user()->role;

                return match ($role) {
                    'teacher' => redirect()->route('teacher.dashboard')->with('error', __('errors.no_access')),
                    'student' => redirect()->route('student.dashboard')->with('error', __('errors.no_access')),
                    default => redirect()->route('login.form')->with('error', __('errors.invalid_role')),
                };
            }

            return redirect()->route('login.form')->with('error', __('errors.login_required'));
        }

        // по умолчанию — пробрасываем исключение дальше
        return null;
    });
})->create();
