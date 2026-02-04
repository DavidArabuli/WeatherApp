<?php

class Router
{
    private array $routes = [];

    public function get(string $path, callable $callable): void
    {
        $this->routes['GET'][$path] = $callable;
    }

    public function post(string $path, callable $callable): void
    {
        $this->routes['POST'][$path] = $callable;
    }

    public function dispatch(string $uri): void
    {
        $method = $_SERVER['REQUEST_METHOD'];
        $path   = parse_url($uri, PHP_URL_PATH);

        if (!isset($this->routes[$method])) {
            $this->notFound();
            return;
        }

        if (isset($this->routes[$method][$path])) {
            call_user_func($this->routes[$method][$path]);
            return;
        }

        foreach ($this->routes[$method] as $route => $callback) {
            $pattern = '#^' . preg_replace(
                '/\{(\w+)\}/',
                '(?P<$1>[^/]+)',
                $route
            ) . '$#';

            if (preg_match($pattern, $path, $matches)) {
                $params = array_filter(
                    $matches,
                    'is_string',
                    ARRAY_FILTER_USE_KEY
                );

                foreach ($params as $key => $value) {
                    if (is_string($value) && ctype_digit($value)) {
                        $params[$key] = (int) $value;
                    }
                }

                call_user_func_array($callback, $params);
                return;
            }
        }

        $this->notFound();
    }

    private function notFound(): void
    {
        http_response_code(404);
        echo '404 Not Found';
    }
}
