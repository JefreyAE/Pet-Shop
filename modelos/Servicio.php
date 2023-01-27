<?php

class Servicio{

    //Los modelos empleados contienen todos los atributos relacionados a cada entidad y también los
    //las funciones encargadas de obtener o establecer la información de cada objeto
    //Contiene los métodos que se comunican con la base de datos para realizar todas las operaciones CRUD
    
    private $id;
    private $categoria_id;
    private $nombre;
    private $descripcion;
    private $precio;
    private $oferta;
    private $fecha;
    private $imagen;
    private $duracion;
    private $base_datos;

    public function __construct() {
        $this->base_datos = BaseDatos::conectar();
    }
    
    function getId() {
        return $this->id;
    }

    function getCategoria_id() {
        return $this->categoria_id;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getDescripcion() {
        return $this->descripcion;
    }

    function getPrecio() {
        return $this->precio;
    }

    function getOferta() {
        return $this->oferta;
    }

    function getFecha() {
        return $this->fecha;
    }

    function getImagen() {
        return $this->imagen;
    }

    function getDuracion() {
        return $this->duracion;
    }

    function setId($id) {
        $this->id = $this->base_datos->real_escape_string($id);
    }

    function setCategoria_id($categoria_id) {
        $this->categoria_id = $this->base_datos->real_escape_string($categoria_id);
    }

    function setNombre($nombre) {
        $this->nombre = $this->base_datos->real_escape_string($nombre);
    }

    function setDescripcion($descripcion) {
        $this->descripcion = $this->base_datos->real_escape_string($descripcion);
    }

    function setPrecio($precio) {
        $this->precio = $this->base_datos->real_escape_string($precio);
    }

    function setOferta($oferta) {
        $this->oferta = $this->base_datos->real_escape_string($oferta);
    }

    function setDuracion($duracion) {
        $this->duracion = $duracion;
    }

    function setFecha($fecha) {
        $this->fecha = $fecha;
    }

    function setImagen($imagen) {
        $this->imagen = $imagen;
    }
    
    public function getAll(){      
        $consulta = "SELECT * FROM servicios ORDER BY id DESC;";
        $servicios = $this->base_datos->query($consulta);
        return $servicios;
    }
    
    public function getServicio($id){      
        $consulta = "SELECT * FROM servicios WHERE id=$id;";
        $servicio = $this->base_datos->query($consulta);
        return $servicio;
    }
    
    public function getServiciosByCategoria($id){      
        $consulta = "SELECT p.*, c.nombre AS cat_nombre FROM servicios p "
               ."INNER JOIN categorias c ON c.id=p.categoria_id "
               ."WHERE categoria_id=$id "
               ."ORDER BY id DESC";
        $servicio = $this->base_datos->query($consulta);
        return $servicio;
    }
    
    public function getRandom($limit){
        $consulta = "SELECT * FROM servicios ORDER BY RAND() LIMIT $limit;";
        $servicios = $this->base_datos->query($consulta);
        return $servicios;               
    }
    
    public function save(){                                                                  
        $consulta = "INSERT INTO servicios VALUES (null,'$this->categoria_id','$this->nombre','$this->descripcion','$this->precio','$this->oferta','$this->duracion',CURDATE(),'$this->imagen');";
       
        $save = $this->base_datos->query($consulta);

        // Para revisar errores en la consulta.
        // echo $this->base_datos->error;
        // die();

        $result = false;
        if($save){
            $result = true;
        }

        return $result;
    }
    public function edit(){
        $consulta = "UPDATE servicios SET nombre='$this->nombre',descripcion='$this->descripcion', categoria_id='$this->categoria_id', precio='$this->precio', oferta='$this->oferta',fecha=CURDATE(), duracion='$this->duracion'";
       
        
        if($this->getImagen() != null){
            $consulta .= ", imagen='{$this->getImagen()}' ";
        }
        
        $consulta .=" WHERE id='{$this->id}';";
        /*echo $this->base_datos->error;
        echo $consulta;
        die();*/
         
        $update = $this->base_datos->query($consulta);
        
        $result = false;
        if($update){
            $result = true;
        }
        return $result;
    }
    public function delete(){
        $consulta = "DELETE FROM servicios WHERE id='$this->id'";
        $delete = $this->base_datos->query($consulta);
        
        $result = false;
        if($delete){
            $result = true;
        }
        return $result;
    }


}
