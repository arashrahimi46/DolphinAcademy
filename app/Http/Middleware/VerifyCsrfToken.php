<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        'admin/data/import/bulk',
        'admin/user/create',
        'api/admin/login',
        'api/user/login',
        'api/user/signup',

    ];
}
