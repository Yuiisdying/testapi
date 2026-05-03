<?php

function testEndpoint($path) {
    $url = 'http://localhost/tugas/disaster-tracker/public' . $path;
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 15);
    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    
    $data = @json_decode($response, true);
    
    echo "GET $path\n";
    echo "  Status: HTTP $httpCode\n";
    if ($data) {
        if (isset($data['results'])) {
            echo "  Earthquakes: " . ($data['results']['earthquakes'] ?? 0) . "\n";
            echo "  Volcanoes: " . ($data['results']['volcanoes'] ?? 0) . "\n";
            echo "  Storms: " . ($data['results']['storms'] ?? 0) . "\n";
            echo "  Tsunamis: " . ($data['results']['tsunamis'] ?? 0) . "\n";
        } elseif (isset($data['count'])) {
            echo "  Count: " . $data['count'] . " events\n";
        } elseif (isset($data['stats'])) {
            foreach ($data['stats'] as $k => $v) {
                echo "  " . ucfirst($k) . ": " . $v . "\n";
            }
        }
    }
    echo "\n";
}

echo "=== Syncing All Disaster Types ===\n\n";
testEndpoint('/api/sync');

echo "=== Stats ===\n";
testEndpoint('/api/stats');

echo "=== All Events ===\n";
testEndpoint('/api/disasters');

echo "✓ Complete!\n";
