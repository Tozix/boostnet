<?php

namespace BoostNet\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        '/speedtest/empty',
        '/speedtest/result',
        'pay_result',
        'pay_success',
        'pay_fail',
    ];
}
