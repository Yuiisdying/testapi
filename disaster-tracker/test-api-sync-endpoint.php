<?php
require_once 'bootstrap/app.php';

echo "Testing /api/sync endpoint response:\n\n";

$url = 'http://localhost/tugas/disaster-tracker/public/api/sync';

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_TIMEOUT, 30);
curl_setopt($ch, CURLOPT_HTTPGET, 1);

$response = curl_exec($ch);
$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

echo "HTTP Status: $http_code\n\n";

if ($response) {
    $data = json_decode($response, true);
    echo json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
} else {
    echo "Error: No response\n";
}
