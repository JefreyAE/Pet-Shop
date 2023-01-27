<?php

class Categoria{

    //Los modelos empleados contienen todos los atributos relacionados a cada entidad y también los
    //las funciones encargadas de obtener o establecer la información de cada objeto
    //Contiene los métodos que se comunican con la base de datos para realizar todas las operaciones CRUD
    
    private $id;
    private $nombre;
    
    //Conexion a la base de datos;
    private $base_datos;
    
    public function __construct() {
        $this->base_datos = BaseDatos::conectar();
    }
    
    function getId() {
        return $this->id;
    }

    function getNombre() {
        return $this->nombre;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setNombre($nombre) {
        $this->nombre = $this->base_datos->real_escape_string($nombre);
    }

    public function getAll(){
        
        $consulta = "SELECT * FROM categorias ORDER BY id DESC;";
        $categorias = $this->base_datos->query($consulta);
        return $categorias;
    }
    
     public function getCategoria($id){        
        $consulta = "SELECT * FROM categorias WHERE id='$id';";
        $categoria = $this->base_datos->query($consulta);
        return $categoria->fetch_object();
    }
    
    public function save(){
        $consulta = "INSERT INTO categorias VALUES(null,'$this->nombre');";
        $save = $this->base_datos->query($consulta);
        
        $result = false;
        if($save){
            $result = true;
        }   
        return $result;
    }

    public function delete(){
        $consulta = "DELETE FROM categorias WHERE id='$this->id'";
        $delete = $this->base_datos->query($consulta);
        
        $result = false;
        if($delete){
            $result = true;
        }
        return $result;
    }
}