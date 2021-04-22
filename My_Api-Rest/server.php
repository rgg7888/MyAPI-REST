<?php
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