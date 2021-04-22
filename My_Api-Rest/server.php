<?php

/*
    user y password harcodeado

    mecanismo HTTP OUT

    asi se hace la peticion con este metodo :

    curl http://rami:1234@localhost:8000/books

    $user = array_key_exists('PHP_AUTH_USER', $_SERVER) ? $_SERVER['PHP_AUTH_USER'] : '';
    $password = array_key_exists('PHP_AUTH_PW', $_SERVER) ? $_SERVER['PHP_AUTH_PW'] : '';

    if($user !== 'rami' || $password !== '1234') {
        die;
    }
*/


/*
    mecanismo HMAC, mas seguro


    asi se hace la peticion con este metodo :

    php generate_hash.php 1
    curl http://localhost:8000/books -H 'X-HASH: 789fa3fc42dc6b7b1f196f5cb623b08006558660' -H 'X-UID: 1' -H 'X-TIMESTAMP: 1619131663'

    if(
        !array_key_exists('HTTP_X_HASH', $_SERVER) ||
        !array_key_exists('HTTP_X_TIMESTAMP', $_SERVER) ||
        !array_key_exists('HTTP_X_UID', $_SERVER)
    ){
        echo "no hay encabezado de autenticacion\n";
        die;
    }

    list($hash, $uid, $timestamp) = [
        $_SERVER['HTTP_X_HASH'],
        $_SERVER['HTTP_X_UID'],
        $_SERVER['HTTP_X_TIMESTAMP']
    ];

    $secret = 'Sh!! No se lo cuentes a nadie!';

    $newHash = sha1($uid.$timestamp.$secret);

    if($newHash !== $hash) {
        echo "el hash no coincide\n";
        die;
    }
*/

/*mecanismo comunicacion via access tokens

    asi se hace la peticion con este metodo :

    curl http://localhost:8001 -X 'POST' -H 'X-Client-Id: 1' -H 'X-Secret: SuperSecreto!'
    curl http://localhost:8000/books -H 'X-Token: c4b02a1525349e7888d4140dcd524aff2d6296dd'

*/
    if(!array_key_exists('HTTP_X_TOKEN', $_SERVER)) {
        die;
    }

    $url = 'http://localhost:8001';
    $ch = curl_init($url);
    curl_setopt(
        $ch,
        CURLOPT_HTTPHEADER,
        [
            "X-Token: {$_SERVER['HTTP_X_TOKEN']}"
        ]
    );
    curl_setopt(
        $ch,
        CURLOPT_RETURNTRANSFER,
        true
    );
    $ret = curl_exec($ch);
    if($ret !== 'true'){
        echo "error de autenticacion\n";
        die;
    }
#

#definimos los recursos disponibles
$allowedResourceTypes = [
    'books',
    'authors',
    'genres'
];

#validamos que el recurso este disponible
$resourceType = $_GET['resource_type'];
if(!in_array($resourceType, $allowedResourceTypes)) {
    die;
}

#defino los recursos
$books = [
    1 => [
        'titulo' => 'lo que el viento se llevo',
        'id_autor' => 2,
        'id_genero' => 2
    ],
    2 => [
        'titulo' => 'la Iliada',
        'id_autor' => 1,
        'id_genero' => 1
    ],
    3 => [
        'titulo' => 'la Odisea',
        'id_autor' => 1,
        'id_genero' => 1
    ]
];

#generamos la respuesta asumiendo que el pedido es correcto
header('Content-Type: application/json');
#levantamos el id del recurso buscado
$resourceId = array_key_exists('resource_id', $_GET) ? 
$_GET['resource_id'] : '';

switch(strtoupper($_SERVER['REQUEST_METHOD'])) {
    case 'GET':
        if(empty($resourceId)){
            echo json_encode($books);
        }else{
            if(array_key_exists($resourceId, $books)) {
                echo json_encode($books[$resourceId]);
            }
        }
        break;
    case 'POST':
        $json = file_get_contents('php://input');
        $books[] = json_decode($json, true);
        echo "se agrego el libro : \n" . json_encode($books[count($books)]);
        echo "\nlista completa : \n" . json_encode($books);
        break;
    case 'PUT':
        if(!empty($resourceId) && array_key_exists($resourceId, $books)) {
            $json = file_get_contents('php://input');
            $books[$resourceId] = json_decode($json, true);
            echo "se modifico el libro : \n" . json_encode($books[$resourceId]);
            echo "\nlista completa : \n" . json_encode($books);
        }
        break;
    case 'DELETE':
        if(!empty($resourceId) && array_key_exists($resourceId, $books)) {
            unset($books[$resourceId]);
        }
        echo json_encode($books);
        break;
}