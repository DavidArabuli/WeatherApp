<?php
// testing API connection
require_once __DIR__ . '/../env.php';


$url = "https://api.openweathermap.org/data/2.5/weather"
    . "?q=Riga"
    . "&units=metric"
    . "&appid=" . $apiKey;

$ch = curl_init($url);

curl_setopt_array($ch, [
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_TIMEOUT => 10,
]);

$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

if ($response === false) {
    die('cURL error: ' . curl_error($ch));
}

unset($ch);

header('Content-Type: application/json');
echo json_encode([
    'http_code' => $httpCode,
    'response'  => json_decode($response, true),
], JSON_PRETTY_PRINT);
