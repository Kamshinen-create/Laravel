<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Security Configuration
    |--------------------------------------------------------------------------
    |
    | This file contains security-related configuration settings for the
    | application including rate limiting, validation rules, and security
    | headers.
    |
    */

    /*
    |--------------------------------------------------------------------------
    | Rate Limiting
    |--------------------------------------------------------------------------
    |
    | Configure rate limiting for different types of operations
    |
    */
    'rate_limits' => [
        'login' => [
            'attempts' => 5,
            'decay_minutes' => 1,
        ],
        'password_reset' => [
            'attempts' => 3,
            'decay_minutes' => 1,
        ],
        'verification' => [
            'attempts' => 5,
            'decay_minutes' => 1,
        ],
        'financial_operations' => [
            'attempts' => 10,
            'decay_minutes' => 1,
        ],
        'investment' => [
            'attempts' => 5,
            'decay_minutes' => 1,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | File Upload Security
    |--------------------------------------------------------------------------
    |
    | Configure file upload security settings
    |
    */
    'file_upload' => [
        'max_size' => 2048, // KB
        'allowed_types' => ['jpg', 'jpeg', 'png', 'gif'],
        'scan_virus' => false, // Enable virus scanning if available
    ],

    /*
    |--------------------------------------------------------------------------
    | Input Validation
    |--------------------------------------------------------------------------
    |
    | Configure input validation rules
    |
    */
    'validation' => [
        'username' => 'regex:/^[a-zA-Z0-9_]+$/',
        'name' => 'regex:/^[a-zA-Z\s]+$/',
        'phone' => 'regex:/^[0-9+\-\s\(\)]+$/',
    ],

    /*
    |--------------------------------------------------------------------------
    | Security Headers
    |--------------------------------------------------------------------------
    |
    | Configure security headers to be sent with responses
    |
    */
    'headers' => [
        'X-Frame-Options' => 'SAMEORIGIN',
        'X-Content-Type-Options' => 'nosniff',
        'X-XSS-Protection' => '1; mode=block',
        'Referrer-Policy' => 'strict-origin-when-cross-origin',
        'Content-Security-Policy' => "default-src 'self'; script-src 'self' 'unsafe-inline' 'unsafe-eval'; style-src 'self' 'unsafe-inline';",
    ],

    /*
    |--------------------------------------------------------------------------
    | Session Security
    |--------------------------------------------------------------------------
    |
    | Configure session security settings
    |
    */
    'session' => [
        'secure' => env('SESSION_SECURE_COOKIE', false),
        'http_only' => true,
        'same_site' => 'lax',
    ],

]; 