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
        
        // Remove SQL comments
        $sql = preg_replace('/--.*$/m', '', $sql); // Remove line comments
        $sql = preg_replace('/\/\*.*?\*\//s', '', $sql); // Remove block comments
        
        // Split by semicolon and filter empty statements
        $statements = array_filter(
            array_map('trim', explode(';', $sql)),
            function($s) {
                return !empty($s) && strlen(trim($s)) > 0;
            }
        );
        
        foreach ($statements as $statement) {
            $result = $db->query($statement);
            
            if ($result === false) {
                // Create a test connection to check for errors
                $testDb = new \mysqli($_ENV['DB_HOST'] ?? 'localhost', $_ENV['DB_USERNAME'] ?? 'root', $_ENV['DB_PASSWORD'] ?? '', $_ENV['DB_DATABASE'] ?? 'tugas');
                throw new Exception("Query failed: " . $testDb->error . "\nSQL: " . substr($statement, 0, 100) . "...");
            }
            echo "  ✓ Executed\n";
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
