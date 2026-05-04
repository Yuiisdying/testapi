<?php
require_once __DIR__ . '/bootstrap/app.php';

$regions = \App\Models\Region::count();
$animals = \App\Models\Animal::count();

echo "✅ Total Regions: " . $regions . "\n";
echo "✅ Total Animals: " . $animals . "\n";
echo "\n📍 All Regions:\n";

\App\Models\Region::all()->each(function($region) {
    $animalCount = $region->animals()->count();
    echo "  - {$region->name} ({$animalCount} animals)\n";
});

echo "\n🐾 New Small Island Animals:\n";
$smallIslands = ['Timor', 'Sulu Islands', 'Mentawai Islands', 'Riau Islands', 'Banda Islands', 'Seram Island', 'Halmahera', 'Morotai', 'Ternate & Tidore', 'Alor Islands', 'Komodo'];
foreach ($smallIslands as $island) {
    $region = \App\Models\Region::where('name', $island)->first();
    if ($region) {
        $animals = $region->animals()->count();
        echo "  - {$island}: {$animals} species\n";
    }
}
