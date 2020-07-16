<?php

$matches = [];
$path = pathinfo($_SERVER["SCRIPT_FILENAME"]);

if (in_array( $_SERVER["REQUEST_URI"], [ '/index.html', '/', '' ] )) {
    require( './index.html');
    die;
}
if (in_array( $_SERVER["REQUEST_URI"], [ '/books.html', '/', '' ] )) {
    require( './books.html');
    die;
}
if(preg_match('/\.(?:css)$/', $_SERVER["REQUEST_URI"])) {
    if ($path["css"] == "css") {
        header("Content-Type: text/css");
        readfile($_SERVER["SCRIPT_FILENAME"]);
    }
    else {
        return FALSE;
    }
}
if(preg_match('/\.(?:js)$/', $_SERVER["REQUEST_URI"])) {
    if ($path["js"] == "js") {
        header("Content-Type: text/js");
        readfile($_SERVER["SCRIPT_FILENAME"]);
    }
    else {
        return FALSE;
    }
}
if(preg_match('/\.(?:ttf)$/', $_SERVER["REQUEST_URI"])) {
    if ($path["ttf"] == "ttf") {
        header("Content-Type: text/ttf");
        readfile($_SERVER["SCRIPT_FILENAME"]);
    }
    else {
        return FALSE;
    }
}
if(preg_match('/\.(?:woff2)$/', $_SERVER["REQUEST_URI"])) {
    if ($path["woff2"] == "woff2") {
        header("Content-Type: text/woff2");
        readfile($_SERVER["SCRIPT_FILENAME"]);
    }
    else {
        return FALSE;
    }
}

if (preg_match('/\/(img+)\/([^\/]+)/', $_SERVER["REQUEST_URI"], $matches)){
    return FALSE;
}elseif (preg_match('/\/([^\/]+)\/([^\/]+)/', $_SERVER["REQUEST_URI"], $matches)) {
    $_GET['resource_type'] = $matches[1];
    $_GET['resource_id'] = $matches[2];

    require 'server.php';
}elseif(preg_match('/\/([^\/]+)\/?/', $_SERVER["REQUEST_URI"], $matches)){
    $_GET['resource_type'] = $matches[1];
    error_log( print_R($matches, 1));

    require('server.php');
}else{
    error_log('No matches');
}
