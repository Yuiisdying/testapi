<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Cross-Origin Resource Sharing (CORS) Configuration
    |--------------------------------------------------------------------------
    |
    | Here you may configure your settings for cross-origin resource sharing
    | or "CORS". This determines what cross-origin operations may execute
    | in web browsers. You are free to adjust these settings as needed.
    |
    | To learn more: https://developer.mozilla.org/en-US/docs/Web/HTTP/CORS
    |
    */

    'paths' => ['api/*', 'sanctum/csrf-cookie'],

    'allowed_methods' => ['GET', 'POST', 'OPTIONS'], // Only GET/POST/OPTIONS

    'allowed_origins' => ['*'], // For now allow all, but in production use specific domain

    'allowed_origins_patterns' => [],

    'allowed_headers' => ['Content-Type', 'Authorization'], // Restrict headers

    'exposed_headers' => [],

    'max_age' => 3600, // Cache CORS preflight for 1 hour

    'supports_credentials' => false,

];
