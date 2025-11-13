<?php
/*
- Archivo router para el servidor embebido de PHP
    - Esto hace, para Docker/Render, lo mismo que tu .htaccess hace para Apache: cualquier ruta que no sea un archivo real acaba en index.php.
*/

// Ruta física del recurso solicitado
$path = __DIR__ . parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Si el archivo existe (por ejemplo un .css, .js, imagen...), lo servimos tal cual
if ($path !== __FILE__ && file_exists($path)) {
    return false;
}

// Para el resto de rutas, delegamos en index.php
require __DIR__ . '/index.php';
