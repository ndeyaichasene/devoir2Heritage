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
}
