<?php

// 1. Carga de dependencias
require __DIR__ . '/vendor/autoload.php';

use Dotenv\Dotenv;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface;
use Slim\Factory\AppFactory;

// 2. Carga de variables de entorno
$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

// 3. Instancia la app
$app = AppFactory::create();

// 4. Middleware CORS
$app->add(function (Request $request, RequestHandlerInterface $handler): Response {
    $response = $handler->handle($request);
    return $response
        ->withHeader('Access-Control-Allow-Origin', '*')
        ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
        ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, PATCH, DELETE, OPTIONS');
});

// 5. Ruta de prueba simple
$app->get('/api/estado', function (Request $request, Response $response) {
    $data = ['status' => 'ok', 'mensaje' => 'Sistema funcionando correctamente'];
    $response->getBody()->write(json_encode($data));
    return $response->withHeader('Content-Type', 'application/json');
});

// 6. Ruta que prueba la base de datos (requiere db.php)
$app->get('/api/db-test', function (Request $request, Response $response) {
    require_once __DIR__ . '/db.php'; // Asegúrate de tener este archivo con la conexión

    $resultado = $conexion->query("SELECT NOW() AS ahora");

    if ($resultado && $fila = $resultado->fetch_assoc()) {
        $response->getBody()->write(json_encode(['ahora' => $fila['ahora']]));
    } else {
        $response->getBody()->write(json_encode(['error' => 'No se pudo ejecutar la consulta']));
    }

    return $response->withHeader('Content-Type', 'application/json');
});

// 7. Ejecutar la app
$app->run();
