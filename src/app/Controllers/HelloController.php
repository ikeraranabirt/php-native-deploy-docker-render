<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Core\BaseController;

final class HelloController extends BaseController
{
    // GET /
    public function index(): void
    {
        $this->json([
            'ok'        => true,
            'service'   => 'api-pruebas-despliegue',
            'endpoints' => ['/prueba'],
        ]);
    }

    // GET /prueba
    public function hello(): void
    {
        $this->json([
            'message' => 'Kaixo desde el endpoint /pruebas 👋',
        ]);
    }
}
