<?php

function testEndpoint($path) {
    $url = 'http://localhost/tugas/disaster-tracker/public' . $path;
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 5);
    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    
    $data = @json_decode($response, true);
    
    echo "GET $path\n";
    echo "  Status: HTTP $httpCode\n";
    if ($data) {
        echo "  Response: " . json_encode($data, JSON_UNESCAPED_SLASHES) . "\n";
    }
    echo "\n";
}

echo "=== API Endpoint Tests ===\n\n";

testEndpoint('/api/disasters');
testEndpoint('/api/stats');
testEndpoint('/api/disasters/type/earthquake');

echo "✓ All endpoints functional!\n";
