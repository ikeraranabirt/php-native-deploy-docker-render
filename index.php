<?php
declare(strict_types=1);
header('Content-Type: application/json; charset=utf-8');

$path = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?? '/';

switch ($path) {

  case '/':
    echo json_encode(['ok' => true, 'service' => 'php-native-api', 'endpoints' => ['/api/hello']]);
    break;

  case '/frogak/':
    echo json_encode(['message' => 'Hola desde Apache 👋']);
    break;

  default:
    http_response_code(404);
    echo json_encode(['error' => 'Not found', 'path' => $path]);
}
