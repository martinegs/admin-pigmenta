<?php

$conexion = new mysqli(
    $_ENV['DB_HOST'],
    $_ENV['DB_USERNAME'],
    $_ENV['DB_PASSWORD'],
    $_ENV['DB_DATABASE'],
    intval($_ENV['DB_PORT'])
);

if ($conexion->connect_error) {
    http_response_code(500);
    die(json_encode([
        'status' => 'error',
        'mensaje' => '❌ Error de conexión: ' . $conexion->connect_error
    ]));
}
