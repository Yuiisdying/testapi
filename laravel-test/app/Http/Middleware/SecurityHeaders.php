<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SecurityHeaders
{
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        // Prevent MIME type sniffing
        $response->header('X-Content-Type-Options', 'nosniff');

        // Prevent clickjacking
        $response->header('X-Frame-Options', 'DENY');

        // Prevent XSS (older browsers)
        $response->header('X-XSS-Protection', '1; mode=block');

        // Content Security Policy - allow CDN for Leaflet and maps
        $response->header('Content-Security-Policy', "default-src 'self'; script-src 'self' 'unsafe-inline' https://cdnjs.cloudflare.com https://unpkg.com; style-src 'self' 'unsafe-inline' https://cdnjs.cloudflare.com https://unpkg.com; img-src 'self' data: https:; font-src 'self' data:; connect-src 'self' https://tile.openstreetmap.org https://nominatim.openstreetmap.org https://cdnjs.cloudflare.com");

        // Referrer Policy - don't leak referrer to external sites
        $response->header('Referrer-Policy', 'strict-origin-when-cross-origin');

        return $response;
    }
}
