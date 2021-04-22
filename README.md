# basic-structure
<pre>
estructura basica en seh
 1- clone el repo
 2- ejecute $ composer install 
 3- done
</pre>

para testear el ejemplo 
<pre>
1- entrar a $ cd MyAPI-REST/My_Api-Rest/
2- levantar el servidor $ php -S localhost:8000 router.php
3- desde otro terminal enviar la peticion $ curl http://localhost:8000/books
o para un recurso $ curl http://localhost:8000/books/1
</pre>

Mecanismos de autenticacion API REST :

<pre>
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
</pre>