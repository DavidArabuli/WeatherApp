<?php

class Router
{
    private $routes = [];

    public function get($path, $callable)
    {
        $this->routes['GET'][$path] = $callable;
    }
    public function post($path, $callable)
    {
        $this->routes['POST'][$path] = $callable;
    }
    public function dispatch($uri)
    {
        $method = $_SERVER['REQUEST_METHOD'];
        $path = parse_url($uri, PHP_URL_PATH);
        if (isset($this->routes[$method][$path])) {
            call_user_func($this->routes[$method][$path]);
        } else {
            http_response_code(404);
            echo "404 Not Found";
        }
    }
    public function showRoutes()
    {
        return $this->routes;
    }
}
