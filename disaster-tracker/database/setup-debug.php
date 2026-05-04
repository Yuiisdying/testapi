<?php

require_once __DIR__ . '/../bootstrap/app.php';

use App\Database;

echo "====================================\n";
echo "Disaster Tracker - Database Setup\n";
echo "====================================\n\n";

$db = Database::getInstance();

try {
    // Read and execute migration files
    $migrationDir = __DIR__ . '/migrations';
    
    if (!is_dir($migrationDir)) {
        throw new Exception("Migration directory not found: $migrationDir");
    }
    
    $files = scandir($migrationDir);
    $migrations = array_filter($files, function($f) {
        return pathinfo($f, PATHINFO_EXTENSION) === 'sql';
    });
    
    sort($migrations);
    
    if (empty($migrations)) {
        throw new Exception("No migration files found in $migrationDir");
    }
    
    foreach ($migrations as $migration) {
        $filepath = $migrationDir . '/' . $migration;
        echo "Running migration: $migration\n";
        
        $sql = file_get_contents($filepath);
        if ($sql === false) {
            throw new Exception("Could not read migration file: $filepath");
        }
        
        $statements = array_filter(
            array_map('trim', explode(';', $sql)),
            function($s) {
                return !empty($s) && trim($s) && !str_starts_with(trim($s), '--');
            }
        );
        
        echo "  Found " . count($statements) . " SQL statement(s)\n";
        
        foreach ($statements as $i => $statement) {
            echo "  [" . ($i + 1) . "] Executing...\n";
            
            $result = $db->query($statement);
            
            if ($result === false) {
                echo "    ✗ FAILED: " . $db->query("SELECT 1")->error . "\n";
                throw new Exception("Query execution failed for migration $migration");
            } else {
                echo "    ✓ Executed\n";
            }
        }
    }
    
    echo "\n✓ Database setup completed successfully!\n";
    echo "\nTables created:\n";
    echo "  - disasters\n";
    echo "\nYou can now access the API at:\n";
    echo "  GET  http://localhost/tugas/disaster-tracker/public/api/disasters\n";
    echo "  GET  http://localhost/tugas/disaster-tracker/public/api/sync\n";
    echo "  GET  http://localhost/tugas/disaster-tracker/public/api/stats\n";
    
} catch (Exception $e) {
    echo "\n✗ Error: " . $e->getMessage() . "\n";
    exit(1);
}
