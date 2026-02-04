<?php

require_once __DIR__ . '/../env.php';

class WeatherApiService
{
    private $apiKey;

    public function __construct($apiKey)
    {
        $this->apiKey = $apiKey;
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
        // unset($ch);

        if ($response === false) {
            throw new Exception('cURL error: ' . curl_error($ch));
        }

        $data = json_decode($response, true);


        if ($httpCode !== 200) {

            $message = $data['message'] ?? 'Unknown error';
            throw new Exception("OpenWeatherMap API error ({$httpCode}): {$message}");
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
