#!/usr/bin/env php
<?php

/**
 * Disaster Tracker - API Test Script
 * Tests all API endpoints and displays results
 */

require_once __DIR__ . '/bootstrap/app.php';

use App\Controllers\DisasterController;

echo "\n";
echo "╔════════════════════════════════════════════════════════════╗\n";
echo "║       Disaster Tracker - API Endpoint Test Suite          ║\n";
echo "╚════════════════════════════════════════════════════════════╝\n";
echo "\n";

$controller = new DisasterController();

// Test 1: GET /api/disasters
echo "TEST 1: GET /api/disasters\n";
echo str_repeat("-", 60) . "\n";
echo "Retrieving all disasters...\n";
ob_start();
$controller->index();
$output = ob_get_clean();
$data = json_decode($output, true);
echo "✓ Success\n";
echo "  Count: " . ($data['count'] ?? 0) . " disasters\n";
echo "  Status: " . ($data['status'] ?? 'unknown') . "\n";
echo "\n";

// Test 2: GET /api/stats
echo "TEST 2: GET /api/stats\n";
echo str_repeat("-", 60) . "\n";
echo "Retrieving statistics...\n";
ob_start();
$controller->stats();
$output = ob_get_clean();
$data = json_decode($output, true);
echo "✓ Success\n";
if (isset($data['stats'])) {
    foreach ($data['stats'] as $key => $count) {
        echo "  " . ucfirst($key) . ": " . $count . "\n";
    }
}
echo "\n";

// Test 3: Sync from APIs
echo "TEST 3: GET /api/sync (Trigger API Update)\n";
echo str_repeat("-", 60) . "\n";
echo "Syncing from all APIs...\n";
ob_start();
$controller->sync();
$output = ob_get_clean();
$data = json_decode($output, true);

if ($data['status'] === 'success') {
    echo "✓ Sync Completed\n";
    if (isset($data['results'])) {
        $results = $data['results'];
        echo "  New Records:\n";
        echo "    - Earthquakes: " . ($results['earthquakes'] ?? 0) . "\n";
        echo "    - Tsunamis: " . ($results['tsunamis'] ?? 0) . "\n";
        echo "    - Floods: " . ($results['floods'] ?? 0) . "\n";
        echo "    - Storms: " . ($results['storms'] ?? 0) . "\n";
        echo "    - Volcanoes: " . ($results['volcanoes'] ?? 0) . "\n";
        
        if (!empty($results['errors'])) {
            echo "  Errors:\n";
            foreach ($results['errors'] as $error) {
                echo "    - " . $error . "\n";
            }
        } else {
            echo "  No errors!\n";
        }
    }
} else {
    echo "✗ Sync Failed\n";
    echo "  Error: " . ($data['message'] ?? 'Unknown error') . "\n";
}
echo "\n";

// Test 4: Filter by type
echo "TEST 4: GET /api/disasters/type/earthquake\n";
echo str_repeat("-", 60) . "\n";
echo "Filtering earthquakes...\n";
ob_start();
$controller->getByType('earthquake');
$output = ob_get_clean();
$data = json_decode($output, true);
echo "✓ Success\n";
echo "  Type: " . ($data['type'] ?? 'unknown') . "\n";
echo "  Count: " . ($data['count'] ?? 0) . " events\n";
echo "\n";

// Final status
echo "╔════════════════════════════════════════════════════════════╗\n";
echo "║                    API Tests Complete                      ║\n";
echo "╚════════════════════════════════════════════════════════════╝\n";
echo "\nNext Steps:\n";
echo "1. Open browser: http://localhost/tugas/disaster-tracker/public/map.html\n";
echo "2. Check the map displays disaster markers\n";
echo "3. Click markers to view event details\n";
echo "4. Use filter buttons to view by disaster type\n";
echo "5. Click '🔄 Sync Now' for manual updates\n";
echo "\n";
