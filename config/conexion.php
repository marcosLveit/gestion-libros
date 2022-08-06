<?php

class Conexion{
    protected $servername="localhost";
    protected $database="biblioteca";
    protected $username="root";
    protected $password="";
    private $conexion = null;

    function __construct()
    {
        $this->conexion = new mysqli($this->servername, $this->username, $this->password, $this->database);
    }

    function query($query){

        $result = $this->conexion->query($query);
        
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}