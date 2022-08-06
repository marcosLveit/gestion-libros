<?php

require './config/routing.php';
require './controllers/LibrosController.php';
require_once './config/Conexion.php';

$urlLimpio = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : '/';

$rutasValidas = [
    '/',
    '/home'
];

if(in_array($urlLimpio, $rutasValidas)){
$router = new Router();

$router->add('/','LibrosController@showIndex');

$router->add('/home', function(){
    echo 'prueba';
}

);
$router->run($urlLimpio);
}

else{
    echo 'no existe';
};



?>