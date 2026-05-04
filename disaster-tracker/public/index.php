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

// Create router instance
$router = new Router();

// If using .htaccess rewrite, URL comes through query parameter
if (isset($_GET['url'])) {
    $_SERVER['REQUEST_URI'] = '/tugas/disaster-tracker/public/' . ltrim($_GET['url'], '/');
}

// Register API routes
$router->get('/api/disasters', [DisasterController::class, 'index']);
$router->get('/api/disasters/type/(:any)', [DisasterController::class, 'getByType']);
$router->get('/api/sync', [DisasterController::class, 'sync']);
$router->get('/api/stats', [DisasterController::class, 'stats']);

// Dispatch request
$router->dispatch();
