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
        //  invalid unit values check
        if (!in_array($unit, ['metric', 'imperial'])) {
            $unit = 'metric';
        }
        $city = $this->cityModel->getCityById($id);

        if (!$city) {
            http_response_code(404);
            echo "City not found in the database.";
            return;
        }

        $weather = $this->weatherService->getWeatherByCityName($city['name'], $unit);

        if (isset($weather['error'])) {

            $title = "Weather in " . htmlspecialchars($city['name']);
            require __DIR__ . '/../../views/weather-error.php';
            return;
        }

        $title = "Weather in " . htmlspecialchars($city['name']);
        require __DIR__ . '/../../views/city.php';
    }

    public function store()
    {
        $cityName = trim($_POST['cityName'] ?? '');

        // name required check
        if ($cityName === '') {
            $errorMessage = "City name is required.";
            require __DIR__ . '/../../views/weather-error.php';
            return;
        }

        // Format check
        if (!preg_match('/^[a-zA-Z\s\-]{1,100}$/', $cityName)) {
            $errorMessage = "Invalid city name. Use letters, spaces or hyphens only.";
            require __DIR__ . '/../../views/weather-error.php';
            return;
        }

        // checking if city exists in API
        try {
            $this->weatherService->getWeatherByCityName($cityName);
        } catch (Exception $e) {
            $errorMessage = $e->getMessage();
            require __DIR__ . '/../../views/weather-error.php';
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
