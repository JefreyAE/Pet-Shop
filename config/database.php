<?php

//Clase que contiene las credenciales de conexión a la base de datos mySql
class BaseDatos{
    public static function conectar(){

        $host = "localhost";
        $usuario = "root";
        $contraseña = "";
        $nombreBaseDatos = "pshop";  

        $database = new mysqli($host, $usuario, $contraseña, $nombreBaseDatos);
        $database->query("SET NAMES 'utf8'");
        
        return $database;
    }
}