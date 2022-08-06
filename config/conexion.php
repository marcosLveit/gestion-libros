<?php

class Conexion
{
    private $conexion = null;

    public static function conectar()
    {
        $conexion = new mysqli("localhost", "root", "", "biblioteca");
        return $conexion;
    }

    function query($query)
    {

        $result = $this->conexion->query($query);

        return $result->fetch_all(MYSQLI_ASSOC);
    }
}
