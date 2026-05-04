<?php

$db = new mysqli('localhost', 'root', '', 'tugas');

if ($db->connect_error) {
    die('Connection failed: ' . $db->connect_error);
}

echo "Rebuilding disasters table (removing depth)...\n\n";

// Drop existing table
echo "1. Dropping old table...\n";
if ($db->query("DROP TABLE IF EXISTS disasters")) {
    echo "   ✓ Table dropped\n";
} else {
    die("Error dropping table: " . $db->error);
}

// Create new table without depth
echo "\n2. Creating new table...\n";
$sql = "
CREATE TABLE IF NOT EXISTS disasters (
    id INT PRIMARY KEY AUTO_INCREMENT,
    type VARCHAR(50) NOT NULL DEFAULT 'earthquake',
    location VARCHAR(255),
    lat DECIMAL(10, 8) NOT NULL,
    lng DECIMAL(11, 8) NOT NULL,
    magnitude DECIMAL(4, 2),
    severity VARCHAR(20),
    description TEXT,
    source VARCHAR(50),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    KEY idx_type (type),
    KEY idx_location (lat, lng, created_at),
    KEY idx_severity (severity),
    KEY idx_source (source)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
";

if ($db->query($sql)) {
    echo "   ✓ Table created\n";
} else {
    die("Error creating table: " . $db->error);
}

echo "\n✓ Database rebuilt successfully!\n";
echo "\nTable structure:\n";

$structure = $db->query("DESCRIBE disasters");
while ($row = $structure->fetch_assoc()) {
    echo "  - " . $row['Field'] . " (" . $row['Type'] . ")\n";
}

$db->close();
