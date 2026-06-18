<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Sentry\Laravel\Integration;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
        // web: __DIR__.'/../routes/web.php',
    )
    ->withMiddleware(function (Middleware $middleware)
    {
        //
    })
    ->withExceptions(function (Exceptions $exceptions)
    {
        Integration::handles($exceptions); 
        // Para receber argumentos de stack trace nos seus erros, certifique-se de definir zend.exception_ignore_args: Off no seu php.ini
    })->create();
