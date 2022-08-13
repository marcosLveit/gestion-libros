<?php

include_once './app/controllers/PruebaController.php';

$router->get('/', function(){
    return 'home';
});

$router->get('/prueba', function(){
    $pruebaController = new PruebaController();
    return $pruebaController->getIndex();
});