<?php
class LibrosController
{

  public function __construct()
  {
    require_once "./models/libros.php";
  }

  public function showIndex()
  {
    $libros = new libros_model();
    $data["titulo"] = "Libros";
    $data["libros"] = $libros->get_libros();
    
    require_once "./views/home.php";
  }
}
