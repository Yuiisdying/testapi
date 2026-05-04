<?php
require_once 'bootstrap/app.php';

use App\Models\Disaster;
use App\Services\DisasterSyncService;

echo "=== Testing Data Retention/Cleanup System ===\n\n";

// Initialize
$disaster = new Disaster();
$service = new DisasterSyncService();

// Check current disaster count
$allDisasters = $disaster->getAll(999);
$currentCount = count($allDisasters);
echo "Current event count: $currentCount\n\n";

// Get retention setting
$retentionDays = $_ENV['DATA_RETENTION_DAYS'] ?? 7;
echo "Retention policy: $retentionDays days\n";
echo "Events older than " . date('Y-m-d H:i:s', strtotime("-$retentionDays days")) . " will be deleted.\n\n";

// Insert a test old event
echo "--- Inserting test OLD event (manually) ---\n";
$oldEventData = [
    'type' => 'test',
    'location' => 'Test Location (Old)',
    'lat' => 0.0,
    'lng' => 0.0,
    'magnitude' => 5.0,
    'severity' => 'moderate',
    'description' => 'Test event from 30 days ago',
    'source' => 'TEST'
];

$result = $disaster->create($oldEventData);
echo "Old event created: " . ($result ? "✓" : "✗") . "\n";

// Manually update its timestamp to 30 days ago
$db = \App\Database::getInstance();
$updateResult = $db->query("UPDATE disasters SET created_at = DATE_SUB(NOW(), INTERVAL 30 DAY) WHERE type='test'");
echo "Updated test event timestamp to 30 days ago: " . ($updateResult ? "✓" : "✗") . "\n\n";

// Insert a recent test event
echo "--- Inserting test RECENT event ---\n";
$recentEventData = [
    'type' => 'test-recent',
    'location' => 'Test Location (Recent)',
    'lat' => 1.0,
    'lng' => 1.0,
    'magnitude' => 4.5,
    'severity' => 'moderate',
    'description' => 'Test event from now',
    'source' => 'TEST'
];

$result = $disaster->create($recentEventData);
echo "Recent event created: " . ($result ? "✓" : "✗") . "\n\n";

// Count before cleanup
$beforeCleanup = $disaster->getAll(999);
echo "Event count before cleanup: " . count($beforeCleanup) . "\n";

// Run cleanup - call the Disaster model method directly
echo "\n--- Running Cleanup ---\n";
$deleted = $disaster->deleteOlderThan($retentionDays);
echo "Events deleted: $deleted\n";

// Count after cleanup
$afterCleanup = $disaster->getAll(999);
echo "Event count after cleanup: " . count($afterCleanup) . "\n";
echo "Net change: " . (count($beforeCleanup) - count($afterCleanup)) . " events removed\n\n";

// Verify old event is gone
$oldStill = $disaster->getByType('test');
$recentStill = $disaster->getByType('test-recent');

echo "--- Results ---\n";
echo "Old test event still exists: " . (count($oldStill) > 0 ? "✗ NO (Good!)" : "✓ YES (Bad!)") . "\n";
echo "Recent test event still exists: " . (count($recentStill) > 0 ? "✓ YES (Good!)" : "✗ NO (Bad!)") . "\n\n";

// Clean up test data
if (count($recentStill) > 0) {
    $testDb = \App\Database::getInstance();
    $testDb->query("DELETE FROM disasters WHERE type IN ('test', 'test-recent')");
    echo "Cleaned up test events from database.\n";
}

echo "=== Test Complete ===\n";
