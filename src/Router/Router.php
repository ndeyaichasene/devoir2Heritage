<?php

namespace App\Router;

class Router
{
    private array $routes = [];

    public function add(string $method, string $path, callable|array $handler): self
    {
        $this->routes[] = [
            'method' => strtoupper($method),
            'path' => '/' . trim($path, '/'),
            'handler' => $handler
        ];

        return $this;
    }

    public function get(string $path, callable|array $handler): self
    {
        return $this->add('GET', $path, $handler);
    }

    public function post(string $path, callable|array $handler): self
    {
        return $this->add('POST', $path, $handler);
    }

    public function getRoutes(): array
    {
        return $this->routes;
    }

    public function dispatch(string $method, string $uri): mixed
    {
        $parsedPath = parse_url($uri, PHP_URL_PATH);
        $requestPath = '/' . trim($parsedPath, '/');
        $requestMethod = strtoupper($method);

        foreach ($this->routes as $route) {
            if ($route['method'] === $requestMethod && $route['path'] === $requestPath) {
                return $this->executeHandler($route['handler']);
            }
        }

        return null;
    }

    protected function executeHandler(callable|array $handler, array $params = []): mixed
    {
        if (is_callable($handler)) {
            return call_user_func_array($handler, $params);
        }

        if (is_array($handler) && count($handler) === 2) {
            [$controller, $action] = $handler;
            return call_user_func_array([$controller, $action], $params);
        }

        throw new \InvalidArgumentException("Le gestionnaire de route n'est pas exécutable.");
    }
}
