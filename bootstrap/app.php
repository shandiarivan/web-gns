<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

// bootstrap/app.php

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {

        // TAMBAHKAN MIDDLEWARE CORS UNTUK GRUP 'api' DI SINI
        $middleware->api(prepend: [
            \Illuminate\Http\Middleware\HandleCors::class,
        ]);

            // Mendaftarkan alias untuk middleware 'role' Anda
    $middleware->alias([
        'role' => \App\Http\Middleware\CheckRole::class,
    ]);
        
        // TAMBAHKAN KONFIGURASI CORS ANDA DI SINI
        // $middleware->handleCors(
        //     paths: ['api/*', 'sanctum/csrf-cookie'], // Path API yang ingin Anda buka
        //     allowedOrigins: ['http://localhost:3000', 'https://website-anda.com'], // Ganti dengan domain website Anda
        //     allowedMethods: ['*'],
        //     allowedHeaders: ['*'],
        //     exposedHeaders: [],
        //     maxAge: 0,
        //     supportsCredentials: false
            
        // );

            $middleware->validateCsrfTokens(except: [
        'api/*', // Izinkan akses ke semua rute API tanpa token CSRF
    ]);

    })
    ->withExceptions(function (Exceptions $exceptions) {
        // ...
    })->create();

    // bootstrap/app.php

