<?php

echo "=== BMKG API Reachability Test ===\n\n";

// BMKG API endpoints
$endpoints = [
    'BMKG Earthquake (Latest)' => 'https://data.bmkg.go.id/DataMKG/TEWS/gempaGetLastM25.json',
    'BMKG Earthquake (Recent)' => 'https://data.bmkg.go.id/DataMKG/TEWS/gempa_terkini.json',
    'BMKG Weather' => 'https://data.bmkg.go.id/DataMKG/MEWS/DigitalForecast/Latestvicente2.json',
    'BMKG All Earthquakes' => 'https://data.bmkg.go.id/DataMKG/TEWS/gempadirasakan.json',
];

foreach ($endpoints as $name => $url) {
    echo "Testing: $name\n";
    echo "URL: $url\n";
    
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 5);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    
    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $error = curl_error($ch);
    ($ch);
    
    if ($error) {
        echo "Status: ❌ ERROR\n";
        echo "Error: $error\n";
    } else {
        echo "Status: HTTP $httpCode\n";
        
        if ($httpCode == 200) {
            $data = @json_decode($response, true);
            if ($data) {
                echo "Response: ✅ Valid JSON\n";
                // Show structure
                if (isset($data['Infogempa'])) {
                    echo "Data: Gempa (Earthquake) data available\n";
                    if (isset($data['Infogempa']['gempa'])) {
                        echo "  - Latest: " . $data['Infogempa']['gempa'][0]['Datetime'] . "\n";
                        echo "  - Magnitude: " . $data['Infogempa']['gempa'][0]['Magnitude'] . "\n";
                        echo "  - Location: " . $data['Infogempa']['gempa'][0]['Lokasi'] . "\n";
                    }
                } else {
                    echo "Data: " . substr($response, 0, 100) . "...\n";
                }
            } else {
                echo "Response: ⚠️ Not valid JSON\n";
            }
        } else {
            echo "Response: ⚠️ Status not 200\n";
        }
    }
    
    echo "\n";
}

echo "=== Summary ===\n";
echo "BMKG is Indonesia's official earthquake/meteorology agency\n";
echo "Great for adding Indonesia-specific real-time data!\n";
