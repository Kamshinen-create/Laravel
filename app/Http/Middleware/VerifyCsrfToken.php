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
        // WARNING: These endpoints should implement proper signature validation
        // instead of being excluded from CSRF protection
        // 'flutter-success',
        // 'razor/success',
        // 'paytm/success'
    ];

    /**
     * TODO: Implement proper signature validation for payment callbacks
     * Example implementation:
     * 
     * protected function tokensMatch($request)
     * {
     *     $token = $request->input('_token') ?: $request->header('X-CSRF-TOKEN');
     *     
     *     if (!$token && $request->header('X-Requested-With') === 'XMLHttpRequest') {
     *         $token = $request->header('X-CSRF-TOKEN');
     *     }
     *     
     *     return is_string($token) && hash_equals($request->session()->token(), $token);
     * }
     */
}
