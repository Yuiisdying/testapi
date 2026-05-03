<?php
// Database debugging script
require_once __DIR__ . '/vendor/autoload.php';

try {
    // Load Laravel
    $app = require_once __DIR__ . '/bootstrap/app.php';
    $kernel = $app->make('Illuminate\Contracts\Console\Kernel');
    $kernel->bootstrap();

    // Get database connection
    $db = app('db');
    
    echo "=== DATABASE CONNECTION TEST ===\n";
    try {
        $result = $db->select("SELECT 1");
        echo "✓ Database connected\n";
    } catch (Exception $e) {
        echo "✗ Database error: " . $e->getMessage() . "\n";
        exit(1);
    }

    // Check tables
    echo "\n=== TABLE COUNTS ===\n";
    $tables = [
        'animals' => 'SELECT COUNT(*) as count FROM animals',
        'regions' => 'SELECT COUNT(*) as count FROM regions',
        'species_types' => 'SELECT COUNT(*) as count FROM species_types',
        'conservation_statuses' => 'SELECT COUNT(*) as count FROM conservation_statuses',
        'animal_region' => 'SELECT COUNT(*) as count FROM animal_region',
    ];

    foreach ($tables as $table => $query) {
        try {
            $result = $db->select($query);
            $count = $result[0]->count ?? 0;
            echo "✓ $table: $count records\n";
        } catch (Exception $e) {
            echo "✗ $table: Error - " . $e->getMessage() . "\n";
        }
    }

    // Check sample animal
    echo "\n=== SAMPLE ANIMAL DATA ===\n";
    $sample = $db->select("SELECT * FROM animals LIMIT 1");
    if ($sample) {
        $animal = $sample[0];
        echo "✓ Sample animal:\n";
        echo "  - ID: {$animal->id}\n";
        echo "  - Name: {$animal->name}\n";
        echo "  - Scientific: {$animal->scientific_name}\n";
        echo "  - Species Type ID: {$animal->species_type_id}\n";
        echo "  - Conservation Status ID: {$animal->conservation_status_id}\n";
    } else {
        echo "✗ No animals found\n";
    }

    // Check API response
    echo "\n=== API RESPONSE TEST ===\n";
    $routes = [
        'animals' => '/api/biodiversity/animals?limit=1',
        'regions' => '/api/biodiversity/regions',
        'species-types' => '/api/biodiversity/species-types',
        'conservation-statuses' => '/api/biodiversity/conservation-statuses',
    ];

    echo "API routes to check:\n";
    foreach ($routes as $name => $path) {
        echo "  - http://localhost/tugas/laravel-test/public{$path}\n";
    }

} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
    echo $e->getTraceAsString();
}
?>
