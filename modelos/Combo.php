<?php

class Combo
{
    //Los modelos empleados contienen todos los atributos relacionados a cada entidad y también los
    //las funciones encargadas de obtener o establecer la información de cada objeto
    //Contiene los métodos que se comunican con la base de datos para realizar todas las operaciones CRUD
    
    private $id;
    private $nombre;
    private $descripcion;
    private $precio;
    private $oferta;
    private $fecha;
    private $imagen;
    private $base_datos;

    public function __construct()
    {
        $this->base_datos = BaseDatos::conectar();
    }

    function getId()
    {
        return $this->id;
    }

    function getNombre()
    {
        return $this->nombre;
    }

    function getDescripcion()
    {
        return $this->descripcion;
    }

    function getPrecio()
    {
        return $this->precio;
    }

    function getOferta()
    {
        return $this->oferta;
    }

    function getFecha()
    {
        return $this->fecha;
    }

    function getImagen()
    {
        return $this->imagen;
    }

    function setId($id)
    {
        $this->id = $this->base_datos->real_escape_string($id);
    }

    function setNombre($nombre)
    {
        $this->nombre = $this->base_datos->real_escape_string($nombre);
    }

    function setDescripcion($descripcion)
    {
        $this->descripcion = $this->base_datos->real_escape_string($descripcion);
    }

    function setPrecio($precio)
    {
        $this->precio = $this->base_datos->real_escape_string($precio);
    }

    function setOferta($oferta)
    {
        $this->oferta = $this->base_datos->real_escape_string($oferta);
    }

    function setFecha($fecha)
    {
        $this->fecha = $fecha;
    }

    function setImagen($imagen)
    {
        $this->imagen = $imagen;
    }

    public function getAll()
    {
        $consulta = "SELECT * FROM combos ORDER BY id DESC;";
        $combos = $this->base_datos->query($consulta);
        return $combos;
    }

    public function getCombo($id)
    {

        $consulta = "SELECT * FROM combos WHERE id=$id;";
        $combo = $this->base_datos->query($consulta);

        /* $obj_combo = $combo->fetch_object();
        
        $this->id = $obj_combo->id;
        $this->nombre = $obj_combo->nombre;
        $this->descripcion = $obj_combo->descripcion;
        $this->precio = $obj_combo->precio;
        $this->oferta = $obj_combo->oferta;
        $this->fecha = $obj_combo->fecha;
        $this->imagen = $obj_combo->imagen;*/

        return $combo;
    }

    public function getRandom($limit)
    {
        $consulta = "SELECT * FROM combos ORDER BY RAND() LIMIT $limit;";
        $combos = $this->base_datos->query($consulta);
        return $combos;
    }

    public function save()
    {
        $consulta = "INSERT INTO combos VALUES (null,'$this->nombre','$this->descripcion','$this->precio','$this->oferta',CURDATE(),'$this->imagen');";

        $save = $this->base_datos->query($consulta);

        // Para revisar errores en la consulta.
        /*echo $this->base_datos->error;
         die();*/
        $result = false;
        if ($save) {
            $result = true;
        }

        return $result;
    }
    public function edit()
    {
        $consulta = "UPDATE combos SET nombre='$this->nombre',descripcion='$this->descripcion', precio='$this->precio', oferta='$this->oferta',fecha=CURDATE()";

        if ($this->getImagen() != null) {
            $consulta .= ", imagen='{$this->getImagen()}' ";
        }

        $consulta .= " WHERE id='{$this->id}';";
        /*echo $this->base_datos->error;
        echo $consulta;
        die();*/

        $update = $this->base_datos->query($consulta);

        //Borra todos los productos y servicios asociados
        $consulta_combos_servicios = "DELETE FROM lineas_combos_servicios WHERE combo_id='$this->id'";
        $consulta_combos_productos = "DELETE FROM lineas_combos_productos WHERE combo_id='$this->id'";

        $delete_combos_servicios = $this->base_datos->query($consulta_combos_servicios);
        $delete_combos_productos = $this->base_datos->query($consulta_combos_productos);

        $result = false;
        if ($update) {
            $result = true;
        }
        return $result;
    }
    
    public function delete()
    {
        $consulta = "DELETE FROM combos WHERE id='$this->id'";
        $consulta_combos_servicios = "DELETE FROM lineas_combos_servicios WHERE combo_id='$this->id'";
        $consulta_combos_productos = "DELETE FROM lineas_combos_productos WHERE combo_id='$this->id'";

        $delete_combos_servicios = $this->base_datos->query($consulta_combos_servicios);
        $delete_combos_productos = $this->base_datos->query($consulta_combos_productos);

        $delete = $this->base_datos->query($consulta);

        $result = false;
        if ($delete) {
            $result = true;
        }
        return $result;
    }

    public function getServicios($combo_id)
    {

        $consulta = "SELECT  servicio_id, unidades FROM lineas_combos_servicios WHERE combo_id = '$combo_id';";
        $query = $this->base_datos->query($consulta);
        $lista_servicios = $query->fetch_all();

        $result = false;
        if ($lista_servicios) {
            $result = $lista_servicios;
        }

        return $result;
    }

    public function checkServicios($combo_id)
    {

        $consulta = "SELECT  servicio_id, unidades FROM lineas_combos_servicios WHERE combo_id = '$combo_id';";
        $query = $this->base_datos->query($consulta);
        $lista_servicios = $query->fetch_all();

        $result = false;
        if ($lista_servicios) {
            $result = true;
        }

        return $result;
    }

    public function save_linea_combo_servicios($combo_servicios, $combo_id)
    {

        if ($combo_id == false) {
            $consulta = "SELECT LAST_INSERT_ID() AS 'combo';";
            $query = $this->base_datos->query($consulta);
            $combo_id = $query->fetch_object()->combo;
        }

        $save = false;
        foreach ($combo_servicios as $indice => $elemento) {

            $cantidad = $combo_servicios[$indice]['unidades'];
            $servicio_id = $combo_servicios[$indice]['id_servicio'];

            $insert = "INSERT INTO lineas_combos_servicios VALUES (NULL,{$servicio_id},{$combo_id},{$cantidad});";
            $save = $this->base_datos->query($insert);
        }

        $result = false;
        if ($save) {
            $result = $combo_id;
        }

        return $result;
    }

    public function getProductos($combo_id)
    {

        $consulta = "SELECT  producto_id, unidades FROM lineas_combos_productos WHERE combo_id = '$combo_id';";
        $query = $this->base_datos->query($consulta);
        $lista_productos = $query->fetch_all();

        $result = false;
        if ($lista_productos) {
            $result = $lista_productos;
        }

        return $result;
    }

    public function save_linea_combo_productos($combo_productos, $combo_id)
    {

        if ($combo_id == false) {
            $consulta = "SELECT LAST_INSERT_ID() AS 'combo';";
            $query = $this->base_datos->query($consulta);
            $combo_id = $query->fetch_object()->combo;
        }

        $save = false;

        foreach ($combo_productos as $indice => $elemento) {
            $cantidad = $combo_productos[$indice]['unidades'];
            $producto_id = $combo_productos[$indice]['id_producto'];

            $insert = "INSERT INTO lineas_combos_productos VALUES (NULL,{$producto_id},{$combo_id},{$cantidad});";
            $save = $this->base_datos->query($insert);
        }

        $result = false;
        if ($save) {
            $result = true;
        }

        return $result;
    }

    public function getServiciosPorCombo($id)
    {
        $consulta = "SELECT s.*, lcs.unidades FROM servicios s"
            . " INNER JOIN lineas_combos_servicios lcs ON lcs.servicio_id = s.id"
            . " WHERE lcs.combo_id = {$id}";
        /*$consulta = "SELECT * FROM productos WHERE id IN"
        . " (SELECT producto_id FROM lineas_ordenes_productos WHERE orden_id='{$id}')";
        */
        $servicios = $this->base_datos->query($consulta);

        /*echo $consulta;
        echo $this->base_datos->error;
        var_dump($productos);
        die();
        */
        return $servicios->fetch_all();
    }

    public function getProductosPorCombo($id)
    {
        $consulta = "SELECT p.*, lcp.unidades FROM productos p"
            . " INNER JOIN lineas_combos_productos lcp ON lcp.producto_id = p.id"
            . " WHERE lcp.combo_id = {$id}";
        /*$consulta = "SELECT * FROM productos WHERE id IN"
        . " (SELECT producto_id FROM lineas_ordenes_productos WHERE orden_id='{$id}')";
        */
        $productos = $this->base_datos->query($consulta);

        /*echo $consulta;
        echo $this->base_datos->error;
        var_dump($productos);
        die();
        */
        $array_productos = $productos->fetch_all();

        return $array_productos;
    }
}
