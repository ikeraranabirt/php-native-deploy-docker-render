<?php
declare(strict_types=1);

header('Content-Type: application/json; charset=utf-8');

// AUTOCARGA MANUAL: NO USA COMPOSER
// (ahora mismo no tenemos clases, pero lo dejamos preparado)
spl_autoload_register(function (string $class): void {
    // Prefijo de nuestro espacio de nombres
    $prefix = 'App\\';

    // Carpeta base donde estarán las clases: src/app/
    $baseDir = dirname(__DIR__) . '/app/';

    // Si la clase no empieza por "App\", no hacemos nada
    if (strncmp($prefix, $class, strlen($prefix)) !== 0) {
        return;
    }

    // Quitamos "App\" del principio -> p.ej. "Controllers\HelloController"
    $relativeClass = substr($class, strlen($prefix));

    // Convertimos "\" en "/" y montamos la ruta física
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

// De momento usamos tu switch de siempre:
switch ($uri) {

    case '/':
        echo json_encode(
            [
                'ok'        => true,
                'service'   => 'php-native-api',
                'endpoints' => ['/prueba']
            ],
            JSON_UNESCAPED_UNICODE
        );
        break;

    case '/prueba':
        echo json_encode(
            ['message' => 'Hola desde la nueva estructura 👋'],
            JSON_UNESCAPED_UNICODE
        );
        break;

    default:
        http_response_code(404);
        echo json_encode(
            ['error' => 'Not found', 'path' => $uri],
            JSON_UNESCAPED_UNICODE
        );
}
