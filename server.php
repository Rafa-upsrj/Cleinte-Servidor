<?php
// ? autentificaón vía Access Tokens

if ( !array_key_exists('HTTP_X_TOKEN',$_SERVER)){
    http_response_code(401);
    die;
}

$url = 'http://localhost:8001';

$curl = curl_init($url);

curl_setopt(
    $curl,
    CURLOPT_HTTPHEADER,
    [
        "X-TOKEN: {$_SERVER['HTTP_X_TOKEN']}"
    ]
    );

curl_setopt(
    $curl,
    CURLOPT_RETURNTRANSFER,
    true
);


$ret = curl_exec($curl);


if( $ret !== 'true' ) {
    die;
}


$allwedResorceType = [
    'books',
    'authors',
    'genders'
];

$resourceType = $_GET['resource_type'];


if (!in_array( $resourceType, $allwedResorceType)) {
    http_response_code(400);
    echo "error";
    die;
}

$books = [
    0 => [
        'title' => 'lo que el viento se llevo',
        'id_athor' => 1,
        'id_gender' => 1
    ],
    1 => [
        'title'=>'La iliada',
        'id_author' => 0,
        'id_gender'=>0,
    ],
    2 => [
        'title'=>'La riqueza de las naciones',
        'id_author' => 2,
        'id_gender'=>2,
    ],
    3 => [
        'title'=>'El diario de Ana Frank',
        'id_author' => 3,
        'id_gender'=>3,
    ],
    4 => [
        'title'=>'La odisea',
        'id_author' => 0,
        'id_gender'=>0,
    ],
    5 => [
        'title'=>'Teoría de los sentimientos morales',
        'id_autor' => 2,
        'id_gender'=>2,
    ]
];

header('Content-Type:application/json');


// $resourceId = $_GET['resource_id'];

$resourceId = array_key_exists('resource_ifid', $_GET) ? $_GET['resource_id'] : '';


switch ( strtoupper($_SERVER['REQUEST_METHOD'])) {
    case 'GET':
        if(empty($resourceId)) {
            echo json_encode($books).PHP_EOL;
        } else {
            if(array_key_exists($resourceId, $books)){
                echo json_encode($books[$resourceId]);
            } else {
                echo "error";
            }
        }
    break;
    case 'POST':
        $json = file_get_contents('php://input');
        $books[] = json_decode($json, true);
        echo json_encode($books).PHP_EOL;
    break;
    case 'PUT':
        $json = file_get_contents('php://input');
        if(array_key_exists($resourceId, $books)){
            $books[$resourceId] = json_decode($json, true);
        }
        echo json_encode($books).PHP_EOL;
    break;
    case 'DELETE':
        $json = file_get_contents('php://input');
        if(!empty($resourceId) && array_key_exists($resourceId, $books)){
            unset($books[$resourceId]);
        }
        echo json_encode($books).PHP_EOL;
    break;
}

// server
// php -S localhost:8000 server.php
// cliente
// curl "http://localhost:8000?resource_type=books"
// curl "http://localhost:8000?resource_type=books&resource_id=1"
//  http://localhost:8000/books/1