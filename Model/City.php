<?php

class City
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function getAllCities(): array
    {
        $stmt = $this->pdo->query("SELECT * FROM cities ORDER BY name");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getCityById(int $id): ?array
    {
        $stmt = $this->pdo->prepare(
            "SELECT * FROM cities WHERE id = :id"
        );
        $stmt->execute(['id' => $id]);

        $city = $stmt->fetch(PDO::FETCH_ASSOC);

        return $city ?: null;
    }

    public function addCity(string $name): int
    {
        $stmt = $this->pdo->prepare(
            "INSERT INTO cities (name) VALUES (:name)"
        );
        $stmt->execute(['name' => $name]);

        return (int) $this->pdo->lastInsertId();
    }

    public function deleteCityById(int $id): bool
    {
        $stmt = $this->pdo->prepare(
            "DELETE FROM cities WHERE id = :id"
        );
        $stmt->execute(['id' => $id]);

        return $stmt->rowCount() > 0;
    }
}
