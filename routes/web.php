<?php

include_once './app/controllers/LibroController.php';

$router->get('/libro/{id:\d+}', function($id){
    $libroController = new LibroController();
    return $libroController->getLibro($id);
});

$router->post('/libro/delete/{id:\d+}', function($id){
    return 'Eliminar el libro:';
});

$router->get('/', function(){
    $libroController = new libroController();
    return $libroController->getIndex();
});



