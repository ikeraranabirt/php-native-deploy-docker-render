<?php
// Router para el servidor embebido de PHP (Docker / Render)

$publicPath = __DIR__ . '/src/public';

// Path solicitado
$requested = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?? '/';

// Ruta física del recurso dentro de public
$filePath = realpath($publicPath . $requested);

// Si el archivo existe (css, js, imágenes…), que lo sirva PHP tal cual
if ($filePath !== false && strpos($filePath, $publicPath) === 0 && is_file($filePath)) {
    return false;
}

// Para todo lo demás, ejecuta nuestra app (index.php)
require $publicPath . '/index.php';
