<?php
// API Response debugging script
require_once __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make('Illuminate\Contracts\Console\Kernel');
$kernel->bootstrap();

$db = app('db');

echo "=== TESTING API ENDPOINTS ===\n\n";

// Test 1: Animals endpoint
echo "1. ANIMALS ENDPOINT\n";
echo "-------------------\n";
$animals = $db->select("SELECT a.id, a.name, a.species_type_id, st.name as type_name, a.conservation_status_id, cs.name as status_name FROM animals a LEFT JOIN species_types st ON a.species_type_id = st.id LEFT JOIN conservation_statuses cs ON a.conservation_status_id = cs.id LIMIT 3");
echo "Sample animals from DB:\n";
foreach($animals as $animal) {
    echo "  - {$animal->name} (Type ID: {$animal->species_type_id}, Status ID: {$animal->conservation_status_id})\n";
}

// Test 2: Species Types
echo "\n2. SPECIES TYPES ENDPOINT\n";
echo "-------------------------\n";
$types = $db->select("SELECT * FROM species_types");
echo "Species types in DB: " . count($types) . "\n";
foreach($types as $type) {
    echo "  - ID {$type->id}: {$type->name} ({$type->icon})\n";
}

// Test 3: Conservation Statuses
echo "\n3. CONSERVATION STATUSES ENDPOINT\n";
echo "-----------------------------------\n";
$statuses = $db->select("SELECT * FROM conservation_statuses");
echo "Conservation statuses in DB: " . count($statuses) . "\n";
foreach($statuses as $status) {
    echo "  - ID {$status->id}: {$status->name}\n";
}

// Test 4: Regions
echo "\n4. REGIONS ENDPOINT\n";
echo "-------------------\n";
$regions = $db->select("SELECT * FROM regions LIMIT 5");
echo "Sample regions from DB:\n";
foreach($regions as $region) {
    echo "  - {$region->name} (ID: {$region->id}, Lat: {$region->latitude}, Lon: {$region->longitude})\n";
}

// Test 5: Animal relationships
echo "\n5. ANIMAL-REGION RELATIONSHIPS\n";
echo "-------------------------------\n";
$animalRegions = $db->select("SELECT DISTINCT a.id, a.name, COUNT(ar.region_id) as region_count FROM animals a LEFT JOIN animal_region ar ON a.id = ar.animal_id GROUP BY a.id, a.name LIMIT 3");
foreach($animalRegions as $ar) {
    echo "  - {$ar->name}: {$ar->region_count} regions\n";
}

// Test 6: Check for any relationship issues
echo "\n6. CHECKING FOR DATA ISSUES\n";
echo "----------------------------\n";

// Animals with no regions
$noRegions = $db->select("SELECT COUNT(*) as count FROM animals a WHERE NOT EXISTS (SELECT 1 FROM animal_region ar WHERE ar.animal_id = a.id)");
echo "Animals with no regions: {$noRegions[0]->count}\n";

// Animals with no species type
$noType = $db->select("SELECT COUNT(*) as count FROM animals a WHERE a.species_type_id IS NULL");
echo "Animals with no species_type: {$noType[0]->count}\n";

// Animals with no conservation status
$noStatus = $db->select("SELECT COUNT(*) as count FROM animals a WHERE a.conservation_status_id IS NULL");
echo "Animals with no conservation_status: {$noStatus[0]->count}\n";

echo "\n=== DEBUG COMPLETE ===\n";
?>
