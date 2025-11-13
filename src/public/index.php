<?php
declare(strict_types=1);
header('Content-Type: application/json; charset=utf-8');

// 1) Lee el path bruto
$uri = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?? '/';

// 2) Detecta el directorio base donde vive index.php (p.ej. "/frogak")
$scriptDir = rtrim(str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'] ?? '')), '/'); // "" o "/frogak"

// 3) Si hay base (no es "" ni "/"), quítala del comienzo del path
if ($scriptDir !== '' && $scriptDir !== '/' && strpos($uri, $scriptDir) === 0) {
    $uri = substr($uri, strlen($scriptDir));
    if ($uri === '') $uri = '/';
}

switch ($uri) {

  case '/':
    echo json_encode(['ok' => true, 'service' => 'php-native-api', 'message' => 'Para acceder a la API prueba llamando a uno de los siguientes endpoints', 'endpoints' => ['/prueba']]);
    break;

  case '/prueba':
    echo json_encode(['message' => 'Hola desde Apache /prueba 👋']);
    break;

  default:
    http_response_code(404);
    echo json_encode(['error' => 'Not found', 'path' => $uri]);
}
