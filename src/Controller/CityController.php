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

    public function show(int $id)
    {
        $unit = $_GET['unit'] ?? 'metric';

        $city = $this->cityModel->getCityById($id);
        if (!$city) {
            http_response_code(404);
            echo "City not found.";
            return;
        }

        try {
            $weather = $this->weatherService->getWeatherByCityName(
                $city['name'],
                $unit
            );
        } catch (Exception $e) {
            http_response_code(500);
            echo "Error fetching weather data: " . $e->getMessage();
            return;
        }

        $title = "Weather in " . $city['name'];
        $longitude = $city['longitude'] ?? 'N/A';

        require __DIR__ . '/../../views/city.php';
    }

    public function store()
    {
        $cityName = trim($_POST['cityName'] ?? '');

        if ($cityName === '') {
            http_response_code(400);
            echo "City name is required.";
            return;
        }

        $this->cityModel->addCity($cityName);

        header('Location: /');
        exit;
    }

    public function destroy(int $id)
    {
        $this->cityModel->deleteCityById($id);

        header('Location: /');
        exit;
    }
}
