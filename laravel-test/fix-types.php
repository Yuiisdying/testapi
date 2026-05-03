#!/usr/bin/php
<?php
// Direct database fix script
$dbHost = '127.0.0.1';
$dbUser = 'root';
$dbPass = '';
$dbName = 'laravel';

try {
    $conn = new mysqli($dbHost, $dbUser, $dbPass, $dbName);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    echo "🔧 Fixing species type classifications...\n";

    // List of fish that were wrongly classified as Amphibian (species_type_id 4)
    $fishNames = [
        'Clownfish', 'Sailfish', 'Marlin', 'Tuna', 'Yellowfin Tuna', 'Swordfish', 
        'Barracuda', 'Jack Fish', 'Cod', 'Salmon', 'Herring', 'Sardine', 'Anchovy',
        'Bass', 'Haddock', 'Mackerel', 'Bonito', 'Plaice', 'Sole', 'Flounder', 'Halibut',
        'Turbot', 'Grouper', 'Snapper', 'Trevally', 'Wahoo', 'King Mackerel', 'Pufferfish',
        'Stonefish', 'Flying Fish', 'Arapaima', 'Piranha', 'Catfish', 'Carp', 'Koi',
        'Goldfish', 'Trout', 'Eel', 'Lamprey', 'Tarpon', 'Mudskipper', 'Lungfish',
        'Dolphin Fish', 'Pompano', 'Permit', 'Jacks', 'Wrasse', 'Angelfish', 'Butterflyfish',
        'Damselfish', 'Goby', 'Triggerfish', 'Filefish', 'Blenny', 'Pipefish', 'Dragonet',
        'Jawfish', 'Mandarin Fish', 'Dottyback', 'Chromis', 'Cardinalfish', 'Trumpetfish',
        'Cornetfish', 'Shrimpfish', 'Garden Eel', 'Frogfish', 'Boxfish'
    ];

    $totalFixed = 0;
    foreach ($fishNames as $name) {
        $escapedName = $conn->real_escape_string($name);
        $sql = "UPDATE animals SET species_type_id = 5 WHERE name LIKE '%{$escapedName}%' AND species_type_id = 4";
        if ($conn->query($sql)) {
            $affected = $conn->affected_rows;
            if ($affected > 0) {
                echo "✓ Fixed {$affected} '{$name}'\n";
                $totalFixed += $affected;
            }
        } else {
            echo "✗ Error fixing '{$name}': " . $conn->error . "\n";
        }
    }

    // Show current classification
    echo "\n=== CURRENT CLASSIFICATION ===\n";
    $sql = "SELECT species_type_id, COUNT(*) as count FROM animals GROUP BY species_type_id";
    $result = $conn->query($sql);
    
    $typeMap = [1 => 'Mammal', 2 => 'Bird', 3 => 'Reptile', 4 => 'Amphibian', 5 => 'Fish', 6 => 'Marine', 7 => 'Insect'];
    
    while ($row = $result->fetch_assoc()) {
        $typeName = $typeMap[$row['species_type_id']] ?? 'Unknown';
        echo "{$typeName} (ID {$row['species_type_id']}): " . $row['count'] . "\n";
    }

    echo "\n✅ Fixed {$totalFixed} misclassified species!\n";

    $conn->close();
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>
