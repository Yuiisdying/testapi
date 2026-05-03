<?php
require 'bootstrap/app.php';

use App\Models\Animal;
use App\Models\SpeciesType;

$app = require_once 'bootstrap/app.php';

// Check species types
echo "=== SPECIES TYPES ===\n";
$types = SpeciesType::all();
foreach ($types as $type) {
    echo "{$type->id}: {$type->name}\n";
}

echo "\n=== CHECKING FOR MISCLASSIFICATIONS ===\n";

// Check Tuna
$tuna = Animal::where('name', 'Tuna')->first();
if ($tuna) {
    echo "Tuna: species_type_id = {$tuna->species_type_id}, species_type = " . $tuna->speciesType->name . "\n";
}

// Check for Fish classified as Amphibian
echo "\n=== FISH CLASSIFIED AS AMPHIBIAN (Wrong!) ===\n";
$fishNames = ['Tuna', 'Salmon', 'Cod', 'Herring', 'Anchovy', 'Bass', 'Haddock'];
foreach ($fishNames as $name) {
    $animal = Animal::where('name', 'like', "%{$name}%")->first();
    if ($animal) {
        echo "{$animal->name}: species_type_id = {$animal->species_type_id} ({$animal->speciesType->name})\n";
    }
}

// Count animals by species type
echo "\n=== COUNT BY TYPE ===\n";
$counts = Animal::groupBy('species_type_id')
    ->selectRaw('species_type_id, count(*) as count')
    ->get();

foreach ($counts as $count) {
    $type = SpeciesType::find($count->species_type_id);
    echo "{$type->name}: {$count->count}\n";
}
