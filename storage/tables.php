<?php
require_once __DIR__ . '/../src/Database.php';

$pdo = Database::getConnection();


$sql = "
CREATE TABLE IF NOT EXISTS cities (
    id SERIAL PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
";

try {
    $pdo->exec($sql);
    echo "Table 'cities' created successfully.\n";
} catch (PDOException $e) {
    echo "Error creating table: " . $e->getMessage() . "\n";
}
