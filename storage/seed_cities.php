<?php

require_once __DIR__ . '/../src/Database.php';

$pdo = Database::getConnection();

$cities = [
    ['Riga',],
    ['Vilnius',],
    ['Tallinn',],
    ['Helsinki',],
    ['Stockholm',],
    ['Warsaw',],
    ['Berlin',],
    ['Paris',],
    ['London',],
    ['Rome',],
];

$stmt = $pdo->prepare(
    "INSERT INTO cities (name, country_code, latitude, longitude)
     VALUES (:name, :country, :lat, :lng)"
);

foreach ($cities as [$name, $country, $lat, $lng]) {
    $stmt->execute([
        ':name'    => $name,
        ':country' => $country,
        ':lat'     => $lat,
        ':lng'     => $lng,
    ]);
}

echo "Seeded " . count($cities) . " cities successfully.\n";
