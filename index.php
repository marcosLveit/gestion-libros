<?php

$retorno = new stdClass();
$method = $_SERVER['REQUEST_METHOD'];

class Book{
    public $id;
    public $name;
    public $author;

    function __construct($id, $name, $author)
    {
        $this->id = $id;
        $this->name = $name;
        $this->author = $author;
    }

}

class Books{
    private $books = [];

    function __construct()
    {
        $file = file_get_contents("libros.json");
        $libros = json_decode($file);
        foreach($libros as $libro){
            $book = new Book($libro->id, $libro->name, $libro->author);
            $this->books[] = $book;
        }
    }

    function saveAll(){
        $books = $this->getAll();
        $file = fopen("libros.json", "w+");
        fwrite($file, json_encode($books));
        fclose($file);
        $this->refreshData();
    }

    function getBookById($id){
        foreach($this->books as $book){
            if($book->id == $id)
                return $book;
        }
        return null;
    }

    function refreshData(){
        $this->books = [];
        $file = file_get_contents("libros.json");
        $libros = json_decode($file);
        foreach($libros as $libro){
            $book = new Book($libro->id, $libro->name, $libro->author);
            $this->books[] = $book;
        }
    }

    function getAll(){
        $retorno = [];
        foreach ($this->books as $book) {
            $tmp = new stdClass();
            $props = get_object_vars($book);
            foreach ($props as $key => $value) {
                $tmp->$key = $value;
            }
            $retorno[] = $tmp;
        }
        return $retorno;
    }

    function deleteBook($id){
        foreach($this->books as $key => $value){
            if($value->id == $id){
                array_splice($this->books, $key, 1);
            }
        }
        $this->saveAll();
    }

    function addBook($book){
        $maxId = 0;
        foreach($this->books as $value){
            if($value->id > $maxId)
                $maxId = $value->id;
        }
        $book->id = $maxId+1;
        $this->books[] = $book;
        $this->saveAll();
    }
}

$books = new Books();

switch($method){
    case "GET":
        if(isset($_GET['id'])){
            $book = $books->getBookById($_GET['id']);
            $props = get_object_vars($book);
            foreach ($props as $key => $value) {
                $retorno->$key = $value;
            }
        }else{
            $retorno = $books->getAll();
        }
        break;
    case "DELETE":
        $data = json_decode(file_get_contents("php://input"));
        $books->deleteBook($data->id);
        $retorno->message = "Libro número {$data->id} eliminado";
        $retorno->data = $books->getAll();
        break;
    case "POST":
        $name = $_POST["name"];
        $author = $_POST["author"];
        $book = new Book(-1, $name, $author);
        $books->addBook($book);
        $retorno = $books->getAll();
        break;
}

echo json_encode($retorno);