<?php
declare(strict_types=1);

use App\Core\Router;

header('Content-Type: application/json; charset=utf-8');

// AUTOCARGA MANUAL: NO USA COMPOSER
spl_autoload_register(function (string $class): void {
    $prefix  = 'App\\';
    $baseDir = dirname(__DIR__) . '/app/'; // src/app/

    if (strncmp($prefix, $class, strlen($prefix)) !== 0) {
        return;
    }

    $relativeClass = substr($class, strlen($prefix));
    $file = $baseDir . str_replace('\\', '/', $relativeClass) . '.php';

    if (is_file($file)) {
        require $file;
    }
});

// NORMALIZAR EL PATH (para que funcione igual en /, /proyecto/src/public, Docker, etc.)
$uri = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?? '/';
$scriptDir = rtrim(str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'] ?? '')), '/');

if ($scriptDir !== '' && $scriptDir !== '/' && strpos($uri, $scriptDir) === 0) {
    $uri = substr($uri, strlen($scriptDir));
    if ($uri === '') {
        $uri = '/';
    }
}

$method = $_SERVER['REQUEST_METHOD'] ?? 'GET';

// Cargar rutas desde config/routes.php
$routes = require dirname(__DIR__) . '/config/routes.php';

// Despachar con el Router
$router = new Router($routes);
$router->dispatch($method, $uri);
