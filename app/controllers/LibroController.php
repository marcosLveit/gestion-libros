<?php

class LibroController {

    public function __construct()
    {
      require_once "./app/models/libro.php";
    }

    public function getIndex()
    {
      $libros = new libros_model();
      $data["libros"] = $libros->get_libros();
      
      require_once "./views/home.php";
    }

    public function getLibro($id){
      $libros = new libros_model();
      $data = $libros->get_libro($id);
      require_once "./views/ver_libro.php";
    }
}