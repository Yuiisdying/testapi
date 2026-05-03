<?php

// Manually test the routing logic
require_once __DIR__ . '/bootstrap/app.php';

use App\Router;
use App\Controllers\DisasterController;

echo "=== Router Test ===\n";

// Simulate different REQUEST_URI values
$testPaths = [
    '/tugas/disaster-tracker/public/api/disasters',
    '/api/disasters',
    '/public/api/disasters',
];

foreach ($testPaths as $testUri) {
    echo "\nTesting REQUEST_URI: $testUri\n";
    
    // Set the global REQUEST_URI
    $_SERVER['REQUEST_URI'] = $testUri;
    $_SERVER['REQUEST_METHOD'] = 'GET';
    
    // Parse it as the router would
    $path = parse_url($testUri, PHP_URL_PATH);
    
    // Remove common base paths
    $basePaths = [
        '/tugas/disaster-tracker/public',
        '/public',
        '',
    ];
    
    foreach ($basePaths as $base) {
        if (!empty($base) && strpos($path, $base) === 0) {
            $path = substr($path, strlen($base));
            break;
        }
    }
    
    if (empty($path) || $path[0] !== '/') {
        $path = '/' . ltrim($path, '/');
    }
    
    echo "  Parsed path: $path\n";
    
    // Check if route registered
    $router = new Router();
    $router->get('/api/disasters', [DisasterController::class, 'index']);
    
    if (method_exists($router, 'hasRoute')) {
        echo "  Route matches: " . ($router->hasRoute($path) ? 'YES' : 'NO') . "\n";
    }
}

// Try actual HTTP call
echo "\n=== Direct HTTP Test ===\n";
if (function_exists('curl_init')) {
    $url = 'http://localhost/tugas/disaster-tracker/public/api/disasters';
    echo "URL: $url\n";
    
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 5);
    $response = curl_exec($ch);
    $error = curl_error($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    
    echo "HTTP Code: $httpCode\n";
    if ($error) {
        echo "Error: $error\n";
    }
    if ($response) {
        echo "Response: " . substr($response, 0, 200) . "...\n";
    } else {
        echo "NO RESPONSE\n";
    }
} else {
    echo "curl not available in CLI\n";
}
