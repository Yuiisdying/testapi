<?php
$url = 'http://localhost/tugas/disaster-tracker/public/api/disasters';
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

echo "=== API Status Test ===\n";
echo "HTTP Status: " . $httpCode . "\n";
echo "Response Size: " . strlen($response) . " bytes\n";

if ($response) {
    $data = json_decode($response, true);
    echo "Valid JSON: " . (is_array($data) ? "YES" : "NO") . "\n";
    if (is_array($data)) {
        echo "Count: " . ($data['count'] ?? 'unknown') . " events\n";
        echo "Status: " . ($data['status'] ?? 'unknown') . "\n";
    }
} else {
    echo "ERROR: No response from API\n";
}
