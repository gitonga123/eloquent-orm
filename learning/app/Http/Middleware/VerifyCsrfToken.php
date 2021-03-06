<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as BaseVerifier;

class VerifyCsrfToken extends BaseVerifier
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        'http://127.0.0.1:8000/api/v1/posts',
        'http://127.0.0.1:8000/api/v1/posts/{post}',
        'http://127.0.0.1:8000/api/v1/posts/{post}/edit',
        'http://127.0.0.1:8000/api/v1/posts/{post}',
        'http://127.0.0.1:8000/api/v1/register',
        'http://127.0.0.1:8000/api/v1/login',
    ];
}
