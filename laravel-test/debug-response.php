<?php
// Test actual API response
require_once __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make('Illuminate\Contracts\Console\Kernel');
$kernel->bootstrap();

// Simulate an API request
$request = \Illuminate\Http\Request::create('/api/biodiversity/animals?limit=1', 'GET');
$request->setUserResolver(function () {
    return null;
});

// Create application and dispatch the request
$response = $app->handle($request);

echo "API Response Status: " . $response->getStatusCode() . "\n";
echo "Content-Type: " . $response->headers->get('content-type') . "\n";
echo "\n=== Response Body (first 2000 chars) ===\n";

$content = $response->getContent();
echo substr($content, 0, 2000) . "\n";

// Decode and check structure
echo "\n=== Response Structure ===\n";
$data = json_decode($content, true);

if ($data) {
    echo "Keys in response: " . implode(', ', array_keys($data)) . "\n";
    
    if (isset($data['data']) && is_array($data['data']) && count($data['data']) > 0) {
        $firstAnimal = $data['data'][0];
        echo "\nFirst animal keys: " . implode(', ', array_keys($firstAnimal)) . "\n";
        echo "First animal name: " . $firstAnimal['name'] . "\n";
        
        if (isset($firstAnimal['regions'])) {
            echo "Regions data type: " . gettype($firstAnimal['regions']) . "\n";
            if (is_array($firstAnimal['regions'])) {
                echo "Regions count: " . count($firstAnimal['regions']) . "\n";
            }
        } else {
            echo "❌ No 'regions' key in animal data\n";
        }
        
        if (isset($firstAnimal['species_type'])) {
            echo "Species type keys: " . implode(', ', array_keys($firstAnimal['species_type'])) . "\n";
        }
    }
} else {
    echo "❌ Could not decode JSON response\n";
}

$app->terminate($request, $response);
?>
