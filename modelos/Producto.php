<?php

class Producto{

    //Los modelos empleados contienen todos los atributos relacionados a cada entidad y también los
    //las funciones encargadas de obtener o establecer la información de cada objeto
    //Contiene los métodos que se comunican con la base de datos para realizar todas las operaciones CRUD
    
    private $id;
    private $categoria_id;
    private $nombre;
    private $descripcion;
    private $precio;
    private $stock;
    private $oferta;
    private $fecha;
    private $imagen;
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

    function getStock() {
        return $this->stock;
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

    function setStock($stock) {
        $this->stock = $this->base_datos->real_escape_string($stock);
    }

    function setOferta($oferta) {
        $this->oferta = $this->base_datos->real_escape_string($oferta);
    }

    function setFecha($fecha) {
        $this->fecha = $fecha;
    }

    function setImagen($imagen) {
        $this->imagen = $imagen;
    }
    
    public function getAll(){      
        $consulta = "SELECT * FROM productos ORDER BY id DESC;";
        $products = $this->base_datos->query($consulta);
        return $products;
    }
    
    public function getProduct($id){      
        $consulta = "SELECT * FROM productos WHERE id=$id;";
        $product = $this->base_datos->query($consulta);
        return $product;
    }
    
    public function getProductsByCategoria($id){      
        $consulta = "SELECT p.*, c.nombre AS cat_nombre FROM productos p "
               ."INNER JOIN categorias c ON c.id=p.categoria_id "
               ."WHERE categoria_id=$id "
               ."ORDER BY id DESC";
        $product = $this->base_datos->query($consulta);
        return $product;
    }
    
    public function getRandom($limit){
        $consulta = "SELECT * FROM productos ORDER BY RAND() LIMIT $limit;";
        $products = $this->base_datos->query($consulta);
        return $products;               
    }
    
    public function save(){                                                                  
        $consulta = "INSERT INTO productos VALUES (null,'$this->categoria_id','$this->nombre','$this->descripcion','$this->precio','$this->stock','$this->oferta',CURDATE(),'$this->imagen');";
       

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
        $consulta = "UPDATE productos SET nombre='$this->nombre',descripcion='$this->descripcion', categoria_id='$this->categoria_id', precio='$this->precio', stock='$this->stock', oferta='$this->oferta',fecha=CURDATE()";
       
        
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
        $consulta = "DELETE FROM productos WHERE id='$this->id'";
        $delete = $this->base_datos->query($consulta);
        
        //var_dump($this->base_datos->error);
        //var_dump($delete);
        //die();

        $result = false;
        if($delete){
            $result = true;
        }
        return $result;
    }


}
