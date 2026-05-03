<?php

$db = new mysqli('localhost', 'root', '', 'tugas');

if ($db->connect_error) {
    die('Connection failed: ' . $db->connect_error);
}

// Check if table exists
$result = $db->query("SHOW TABLES LIKE 'disasters'");

if ($result && $result->num_rows > 0) {
    echo "✓ Table 'disasters' EXISTS\n";
    
    // Get table structure
    $structure = $db->query("DESCRIBE disasters");
    echo "\nTable Structure:\n";
    while ($row = $structure->fetch_assoc()) {
        echo "  - " . $row['Field'] . " (" . $row['Type'] . ")\n";
    }
    
    // Get row count
    $count = $db->query("SELECT COUNT(*) as cnt FROM disasters");
    $data = $count->fetch_assoc();
    echo "\nRows in table: " . $data['cnt'] . "\n";
} else {
    echo "✗ Table 'disasters' DOES NOT EXIST\n";
    echo "Run: C:\\xampp\\php\\php.exe database/setup.php\n";
}

$db->close();
