<?php

class CityController
{
    public function index()
    {
        require __DIR__ . '/../../views/cities.php';
    }
    public function show($cityName)
    {
        $title = "Weather in " . ucfirst($cityName);
        require __DIR__ . '/../../views/city.php';
    }
    public function store()
    {
        $cityName = $_POST['cityName'] ?? '';
        if (!$cityName) {
            http_response_code(400);
            echo "City name is required.";
            return;
        }
        echo "Adding city to the list: " . $cityName;
    }
    public function destroy($cityName)
    {
        $cityName = $_POST['cityName'] ?? '';
        if (!$cityName) {
            http_response_code(400);
            echo "City name is required.";
            return;
        }
        echo "Deleting city from the list: " . $cityName;
    }
}
