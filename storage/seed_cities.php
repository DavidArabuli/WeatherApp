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
    ['New York',],
];

$stmt = $pdo->prepare(
    "INSERT INTO cities (name)
     VALUES (:name)"
);

foreach ($cities as [$name, $country]) {
    $stmt->execute([
        ':name'    => $name,
    ]);
}

echo "Seeded " . count($cities) . " cities successfully.\n";
