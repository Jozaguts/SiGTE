<?php namespace DataBase;

use mysqli;

class Conection {

     function Connect(){

        $conexion = new mysqli("localhost", "jozaguts", "123456789", "sigte");

        if ($conexion->connect_errno) {
            echo "Fallo al conectar a MySQL: (" . $conexion->connect_errno . ") " . $conexion->connect_error;
        }
        return $conexion;
    }
}

