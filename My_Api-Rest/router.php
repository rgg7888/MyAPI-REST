<?php

$matches = [];

//exception
if(in_array($_SERVER["REQUEST_URI"], ['/index.php','/', ''])) {
    echo file_get_contents('index.php');
    die;
}else if(in_array($_SERVER["REQUEST_URI"], ['/index.html','/', ''])){
    echo file_get_contents('index.html');
    die;
}

if(preg_match('/\/([^\/]+)\/([^\/]+)/', 
$_SERVER['REQUEST_URI'], $matches)) {
    $_GET['resource_type'] = $matches[1];
    $_GET['resource_id'] = $matches[2];
    error_log(print_r($matches, 1));
    require_once 'server.php';
}elseif(preg_match('/\/([^\/]+)\/?/', 
$_SERVER['REQUEST_URI'], $matches)) {
    $_GET['resource_type'] = $matches[1];
    error_log(print_r($matches, 1));
    require_once 'server.php';
}else{
    error_log('No marches');
    http_response_code(404);
}