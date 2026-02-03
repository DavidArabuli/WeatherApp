<?php
require_once __DIR__ . '/../src/Router.php';
require_once __DIR__ . '/../src/Controller/CityController.php';

$router = new Router();
$controller = new CityController();

$router->get('/', [$controller, 'index']);
$router->get('/cities/{cityName}', [$controller, 'show']);
$router->post('/cities', [$controller, 'store']);
$router->post('/cities/{cityName}/delete', [$controller, 'destroy']);



$router->dispatch($_SERVER['REQUEST_URI']);
