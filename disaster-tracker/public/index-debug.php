<?php

// Load environment configuration
$env_file = dirname(__DIR__) . '/.env';
if (file_exists($env_file)) {
    $lines = file($env_file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        if (strpos($line, '=') !== false && strpos($line, '#') !== 0) {
            [$key, $value] = explode('=', $line, 2);
            $_ENV[trim($key)] = trim($value);
        }
    }
}

// Set error reporting
error_reporting(E_ALL);
ini_set('display_errors', 0);

// Autoload classes
spl_autoload_register(function($class) {
    $file = dirname(__DIR__) . '/' . str_replace('\\', '/', $class) . '.php';
    if (file_exists($file)) {
        require $file;
    }
});

use App\Router;
use App\Controllers\DisasterController;

header('X-Powered-By: Disaster Tracker');

// Debug: Show what path we're getting
$method = $_SERVER['REQUEST_METHOD'];
$full_uri = $_SERVER['REQUEST_URI'];
$path = parse_url($full_uri, PHP_URL_PATH);
$stripped = str_replace('/tugas/disaster-tracker/public', '', $path);
$final_path = $stripped ?: '/';

// Log debug info to file for troubleshooting
$debug_log = __DIR__ . '/../storage/debug.log';
@mkdir(dirname($debug_log), 0755, true);
file_put_contents($debug_log, 
    "Time: " . date('Y-m-d H:i:s') . "\n" .
    "Method: $method\n" .
    "Full URI: $full_uri\n" .
    "Parsed Path: $path\n" .
    "Stripped Path: $stripped\n" .
    "Final Path: $final_path\n" .
    "---\n",
    FILE_APPEND
);

// Create router instance
$router = new Router();

// Register API routes
$router->get('/api/disasters', [DisasterController::class, 'index']);
$router->get('/api/disasters/type/(:any)', [DisasterController::class, 'getByType']);
$router->get('/api/sync', [DisasterController::class, 'sync']);
$router->get('/api/stats', [DisasterController::class, 'stats']);

// Dispatch request
$router->dispatch();
