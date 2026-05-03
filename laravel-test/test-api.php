<?php

require 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$kernel = $app->make('Illuminate\Contracts\Http\Kernel');

// Manually create request
$request = new \Illuminate\Http\Request();
$request->setMethod('POST');
$request->server->set('REQUEST_METHOD', 'POST');
$request->server->set('CONTENT_TYPE', 'application/json');
$request->merge(['region_ids' => [1, 2]]);

// Get the controller
$controller = new \App\Http\Controllers\Api\ComparisonController();

// Call the method directly
try {
    $response = $controller->compare($request);
    echo "Response status: " . $response->status() . "\n";
    echo "Response data: " . json_encode(json_decode($response->content()), JSON_PRETTY_PRINT) . "\n";
} catch (\Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
    echo "File: " . $e->getFile() . "\n";
    echo "Line: " . $e->getLine() . "\n";
}
