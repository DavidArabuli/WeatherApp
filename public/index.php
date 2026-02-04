<?php
require_once __DIR__ . '/../env.php';
require_once __DIR__ . '/../src/Router.php';
require_once __DIR__ . '/../src/Controller/CityController.php';
require_once __DIR__ . '/../src/Database.php';
require_once __DIR__ . '/../Model/City.php';
require_once __DIR__ . '/../src/WeatherApiService.php';


$pdo = Database::getConnection();
$cityModel = new City($pdo);
$weatherService = new WeatherApiService($apiKey);
$router = new Router();
$controller = new CityController($cityModel, $weatherService);

$router->get('/', [$controller, 'index']);
$router->get('/cities/{cityName}', [$controller, 'show']);
$router->post('/cities', [$controller, 'store']);
$router->post('/cities/{cityName}/delete', [$controller, 'destroy']);

$router->dispatch($_SERVER['REQUEST_URI']);

// function dd($data)
// {
//     echo '<pre>';
//     die(var_dump($data));
//     echo '</pre>';
// }