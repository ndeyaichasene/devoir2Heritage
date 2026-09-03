<?php

namespace App\Router;

class Router
{
    private array $routes = [];
    /** @var callable|null */
    private $notFoundHandler = null;

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

    public function setNotFoundHandler(callable $handler): self
    {
        $this->notFoundHandler = $handler;
        return $this;
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
            if ($route['method'] !== $requestMethod) {
                continue;
            }

            $pattern = preg_replace('/\{([a-zA-Z_][a-zA-Z0-9_-]*)\}/', '(?P<$1>[^/]+)', $route['path']);
            $regex = '#^' . $pattern . '$#';

            if (preg_match($regex, $requestPath, $matches)) {
                $params = array_filter($matches, fn($key) => !is_int($key), ARRAY_FILTER_USE_KEY);
                $params = array_map(fn($val) => is_numeric($val) ? (int)$val : $val, $params);

                return $this->executeHandler($route['handler'], $params);
            }
        }

        return $this->handleNotFound();
    }

    protected function handleNotFound(): mixed
    {
        if (!headers_sent()) {
            http_response_code(404);
        }

        if ($this->notFoundHandler !== null) {
            return call_user_func($this->notFoundHandler);
        }

        $viewPath = dirname(__DIR__, 2) . '/template/error/404.php';
        if (file_exists($viewPath)) {
            $message = "La page demandée n'existe pas ou a été déplacée (Erreur 404).";
            require $viewPath;
            return null;
        }

        echo "404 Not Found";
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
