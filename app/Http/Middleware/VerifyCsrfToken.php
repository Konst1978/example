<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array<int, string>
     */
    // Здесь мы можем в исключение внести какой-то роут и на него csrf больше не будет работать.
    // Это например можно использовать когда тестировать запросы с POSTMAN
    protected $except = [
        '/posts'
    ];
}
