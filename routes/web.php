<?php

use App\controllers\PruebaController;

$router->get('/', function(){
    return 'home';
});

$router->get('/prueba', function(){
    $pruebaController = new PruebaController;
    return $pruebaController->getIndex();
});