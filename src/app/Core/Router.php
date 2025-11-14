<?php
declare(strict_types=1);

namespace App\Core;

final class Router
{
    public function __construct(
        private array $routes
    ) {}

    public function dispatch(string $method, string $path): void
    {
        $method = strtoupper($method);

        $route = $this->routes[$method][$path] ?? null;

        if ($route === null) {
            http_response_code(404);
            echo json_encode(
                ['error' => 'Not found', 'path' => $path],
                JSON_UNESCAPED_UNICODE
            );
            return;
        }

        [$controllerClass, $action] = $route;

        if (!class_exists($controllerClass)) {
            http_response_code(500);
            echo json_encode(
                ['error' => 'Controller not found', 'controller' => $controllerClass],
                JSON_UNESCAPED_UNICODE
            );
            return;
        }

        $controller = new $controllerClass();

        if (!method_exists($controller, $action)) {
            http_response_code(500);
            echo json_encode(
                ['error' => 'Action not found', 'action' => $action],
                JSON_UNESCAPED_UNICODE
            );
            return;
        }

        $controller->$action();
    }
}
