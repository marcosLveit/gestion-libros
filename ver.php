<?php
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

    function aFila(){
        return "<tr>
            <td class='border'>{$this->id}</td>
            <td class='border'>{$this->name}</td>
            <td class='border'>{$this->author}</td>
            <td class='border'><a class='block w-1/2 p-px ml-4 text-xs text-center transition bg-indigo-500 rounded-md shadow-lg shadow-indigo-500/50 color-indigo-50' href='ver.php?id={$this->id}'>Ver</a></td>
        </tr>";
    }

    function fichaLibro(){
        return "<div class='flex flex-col justify-center w-2/3 text-center border rounded-md p-7'>
                    <div class='p-2 min-w-fit'>
                        Nombre: {$this->name}
                    </div>
                    <div class='p-2 min-w-fit'>
                        Autor: {$this->author}
                    </div>
                    <div class='p-2'>
                        <a href='eliminar.php?id={$this->id}' class='block px-4 py-2 mx-2 font-bold transition bg-red-500 rounded-md shadow-lg shadow-red-500/50 hover:shadow-red-500/100 text-red-50 hover:bg-red-600'>Eliminar</a>
                    </div>
                </div>";
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

    function aTabla(){
        $retorno = "<table class='w-2/3 text-center border border-collapse table-auto'><thead>
            <th class='border'>ID</th>
            <th class='border'>Nombre</th>
            <th class='border'>Autor</th>
            <th class='border'></th>
        </thead><tbody>";
        foreach ($this->books as $book) {
            $retorno.= $book->aFila();
        }
        $retorno.="</tbody></table>";
        return $retorno;
    }
}

$books = new Books();
$book = $books->getBookById($_GET['id']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="output.css">
</head>

<body class="min-w-full min-h-screen text-white bg-slate-800">
    <main class="grid w-screen place-items-center gap-y-5 px-60">
        <?php include './botones.php' ?>
        <div id="content" class="flex justify-center w-3/4">
            <?= $book->fichaLibro(); ?>
        </div>
    </main>
</body>

</html>