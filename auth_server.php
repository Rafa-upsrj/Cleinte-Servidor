<?php
// curl http://localhost:8001 -X 'POST' -H 'X-CLIENT-ID:1' -H 'X-PASSWORD:1234'
$method = strtoupper($_SERVER['REQUEST_METHOD']);

$token = sha1('Seper Secreto!');

if ($method === 'POST') {
    if ( !array_key_exists('HTTP_X_CLIENT_ID', $_SERVER) || !array_key_exists('HTTP_X_PASSWORD', $_SERVER) ){
        die;
    }

    $clientID = $_SERVER['HTTP_X_CLIENT_ID'];
    $password = $_SERVER['HTTP_X_PASSWORD'];

    if ( $clientID !== '1' || $password !== '1234') {
        die;
    }

    echo "$token".PHP_EOL;
}elseif ( $method === 'GET') {
    if ( !array_key_exists('HTTP_X_TOKEN',$_SERVER)){
        die;
    }

    if ( $_SERVER['HTTP_X_TOKEN'] === $token ) {
        echo 'true';
    }else {
        echo 'false';
    }
}else {
    echo 'false';
}