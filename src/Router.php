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

        if (!isset($this->routes[$method])) {
            http_response_code(404);
            echo "404 Not Found";
            return;
        }

        if (isset($this->routes[$method][$path])) {
            call_user_func($this->routes[$method][$path]);
            return;
        }

        foreach ($this->routes[$method] as $route => $callback) {
            $pattern = '#^' . preg_replace('/\{(\w+)\}/', '(?P<$1>[^/]+)', $route) . '$#';

            if (preg_match($pattern, $path, $matches)) {
                $params = array_filter($matches, 'is_string', ARRAY_FILTER_USE_KEY);
                call_user_func_array($callback, $params);
                return;
            }
        }
        var_dump($_SERVER['REQUEST_METHOD'], $path);
        die;
        echo '<pre>';
        var_dump($this->routes);
        echo '</pre>';
        http_response_code(404);
        echo "404 Not Found";
    }
}
