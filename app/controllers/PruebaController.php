<?php

class PruebaController {

    public function __construct()
    {
      require_once "./app/models/libro.php";
    }

    public function getIndex()
    {
      $libros = new libros_model();
      $data["titulo"] = "Libros";
      $data["libros"] = $libros->get_libros();
      
      require_once "./views/home.php";
    }
}