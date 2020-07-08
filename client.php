<?php

$curl = curl_init($argv[1]);

curl_setopt(
    $curl,
    CURLOPT_RETURNTRANSFER,
    true
);
$headers = [];
$headers [] = 'X-TOKEN: 37d0d8c6c1c3842d0abc428dbc7a2fadd88c12e5';
curl_setopt(
    $curl,
    CURLOPT_HTTPHEADER,
    $headers
);
$response = curl_exec($curl);

$httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);

switch($httpCode){
    case 200:
        echo 'Todol Cool!'.PHP_EOL;
    break;
    case 400:
        echo 'Pedido Invalido'.PHP_EOL;
    break;
    case 401:
        echo 'Error de autentificacion'.PHP_EOL;
    break;
    case 500:
        echo 'EL Servidor Fallo'.PHP_EOL;
    break;
};
