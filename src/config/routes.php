<?php
declare(strict_types=1);

use App\Controllers\HelloController;

return [
    'GET' => [
        '/'          => [HelloController::class, 'index'],
        '/prueba' => [HelloController::class, 'hello'],
    ],
];
