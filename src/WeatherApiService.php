<?php

class WeatherApiService
{
    private $apiKey;

    public function __construct()
    {
        $this->apiKey = getenv('API_KEY');

        if (!$this->apiKey) {
            throw new RuntimeException('API_KEY is not set');
        }
    }

    public function getWeatherByCityName(string $cityName, string $unit = 'metric'): array
    {
        $url = "https://api.openweathermap.org/data/2.5/weather"
            . "?q=" . urlencode($cityName)
            . "&units=" . $unit
            . "&appid=" . $this->apiKey;

        $ch = curl_init($url);
        curl_setopt_array($ch, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => 10,
        ]);

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        if ($response === false) {
            return ['error' => 'Unable to connect to the weather service.'];
        }

        $data = json_decode($response, true);

        if ($httpCode !== 200) {
            if ($httpCode === 404) {
                throw new Exception("City '{$cityName}' not found. Please check spelling.");
            }
            throw new Exception($data['message'] ?? 'Unknown weather service error.');
        }


        return [
            'temperature' => $data['main']['temp'] ?? null,
            'humidity'    => $data['main']['humidity'] ?? null,
            'wind_speed'  => $data['wind']['speed'] ?? null,
            'description' => $data['weather'][0]['description'] ?? null,
            'icon'        => $data['weather'][0]['icon'] ?? null,
            'city'        => $data['name'] ?? null,
        ];
    }
}
