<?php

$ch = curl_init($argv[1]);
curl_setopt(
    $ch,
    CURLOPT_RETURNTRANSFER,
    true
);

$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

switch($httpCode) {
    case 200: echo 'Todo Bien!'; break;
    case 400: echo 'Peticion mal hecha!'; break;
    case 404: echo 'Recurso no encontrado!'; break;
    case 500: echo 'Error interno del servidor!'; break;
}