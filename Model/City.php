<?php

class City
{
    private $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function getAllCities(): array
    {
        $stmt = $this->pdo->prepare("SELECT * FROM cities");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getCityByName(string $name): ?array
    {
        $stmt = $this->pdo->prepare("SELECT * FROM cities WHERE name = :name");
        $stmt->bindParam(':name', $name);
        $stmt->execute();
        $city = $stmt->fetch(PDO::FETCH_ASSOC);
        return $city ?: ['name' => 'City not found'];
    }

    public function addCity(string $name): ?array
    {
        $stmt = $this->pdo->prepare("INSERT INTO cities (name) VALUES (:name)");
        $stmt->bindParam(':name', $name);
        $stmt->execute();
        $city = $this->getCityByName($name);
        return $city;
    }

    public function deleteCity(string $name): ?array
    {
        $stmt = $this->pdo->prepare("DELETE FROM cities WHERE name = :name");
        $stmt->bindParam(':name', $name);
        $stmt->execute();
        return ['name' => $name, 'deleted' => true];
    }
}
