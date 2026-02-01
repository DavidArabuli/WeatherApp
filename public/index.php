<?php
require_once __DIR__ . '/../src/Router.php';

$router = new Router();

$router->get('/', function () {
    echo 'Home Page';
    require __DIR__ . '/../views/cities.php';
});

$router->dispatch($_SERVER['REQUEST_URI']);
