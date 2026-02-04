<?php

class CityController
{
    private City $cityModel;
    private WeatherApiService $weatherService;

    public function __construct(City $cityModel, WeatherApiService $weatherService)
    {
        $this->cityModel = $cityModel;
        $this->weatherService = $weatherService;
    }
    public function index()
    {
        $cities = $this->cityModel->getAllCities();
        require __DIR__ . '/../../views/cities.php';
    }

    public function show(string $cityName)
    {
        $unit = $_GET['unit'] ?? 'metric';
        $city = $this->cityModel->getCityByName($cityName);
        if (!$city) {
            http_response_code(404);
            echo "City not found.";
            return;
        }

        try {
            $weather = $this->weatherService->getWeatherByCityName($cityName, $unit);
        } catch (Exception $e) {
            http_response_code(500);
            echo "Error fetching weather data: " . $e->getMessage();
            return;
        }

        $title = "Weather in " . ucfirst($cityName);
        $longitude = $city['longitude'] ?? 'N/A';
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
        $city = $this->cityModel->addCity($cityName);

        echo "Adding city to the list: " . $cityName;
        header('Location: /');
        exit;
    }
    public function destroy($cityName)
    {
        $this->cityModel->deleteCity($cityName);

        echo json_encode([
            'status' => 'ok',
            'deleted' => $cityName
        ]);
        header('Location: /');
        exit;
    }
}
