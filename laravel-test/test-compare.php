<?php

require 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$kernel = $app->make('Illuminate\Contracts\Http\Kernel');
$request = \Illuminate\Http\Request::capture();
$app->make('Illuminate\Contracts\Http\Kernel')->bootstrap();

use App\Models\Region;

// Check regions
$regions = Region::with('animals')->get();
echo "Total regions: " . count($regions) . "\n";
foreach ($regions->take(5) as $region) {
    echo "Region: {$region->name}, Animals: " . count($region->animals) . "\n";
}

// Test comparison
$region1 = Region::find(1);
$region2 = Region::find(2);

if ($region1 && $region2) {
    echo "\nRegion 1 ($region1->name): " . $region1->animals()->count() . " animals\n";
    echo "Region 2 ($region2->name): " . $region2->animals()->count() . " animals\n";
} else {
    echo "\nRegions 1 or 2 not found\n";
}
