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
    public function getCityByName(string $name): string
    {
        $stmt = $this->pdo->prepare("SELECT * FROM cities WHERE name = :name");
        $stmt->bindParam(':name', $name);
        $stmt->execute();
        $city = $stmt->fetch(PDO::FETCH_ASSOC);
        return $city;
    }
}
