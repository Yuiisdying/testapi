<?php
require_once 'bootstrap/app.php';

use App\Services\DisasterSyncService;

echo "=== Testing Full Sync with Cleanup ===\n\n";

$service = new DisasterSyncService();
$result = $service->syncAll();

echo json_encode($result, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);

echo "\n\n=== Summary ===\n";
echo "✓ Total events synced from APIs\n";
echo "  - Earthquakes: " . $result['earthquakes'] . "\n";
echo "  - Tsunamis: " . $result['tsunamis'] . "\n";
echo "  - Floods: " . $result['floods'] . "\n";
echo "  - Storms: " . $result['storms'] . "\n";
echo "  - Volcanoes: " . $result['volcanoes'] . "\n";
echo "✓ Old events cleaned up: " . $result['deleted'] . "\n";
if (!empty($result['errors'])) {
    echo "⚠ Errors: " . count($result['errors']) . "\n";
    foreach ($result['errors'] as $error) {
        echo "  - " . $error . "\n";
    }
}
