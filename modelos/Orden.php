<?php

class Orden {

    //Los modelos empleados contienen todos los atributos relacionados a cada entidad y también los
    //las funciones encargadas de obtener o establecer la información de cada objeto
    //Contiene los métodos que se comunican con la base de datos para realizar todas las operaciones CRUD
    
    private $id;
    private $usuario_id;
    private $provincia;
    private $canton;
    private $distrito;
    private $localidad;
    private $direccion;
    private $coste;
    private $estado;
    private $fecha;
    private $hora;
    //Conexion a la base de datos.
    private $base_datos;

    public function __construct() {
        $this->base_datos = BaseDatos::conectar();
    }

    function getId() {
        return $this->id;
    }

    function getUsuario_id() {
        return $this->usuario_id;
    }

    function getProvincia() {
        return $this->provincia;
    }

    function getCanton() {
        return $this->canton;
    }

    function getDistrito() {
        return $this->distrito;
    }

    function getLocalidad() {
        return $this->localidad;
    }

    function getDireccion() {
        return $this->direccion;
    }

    function getCoste() {
        return $this->coste;
    }

    function getEstado() {
        return $this->estado;
    }

    function getFecha() {
        return $this->fecha;
    }

    function getHora() {
        return $this->hora;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setUsuario_id($usuario_id) {
        $this->usuario_id = $usuario_id;
    }

    function setProvincia($provincia) {
        $this->provincia = $this->base_datos->real_escape_string($provincia);
    }

    function setCanton($canton) {
        $this->canton = $this->base_datos->real_escape_string($canton);
    }

    function setDistrito($distrito) {
        $this->distrito = $this->base_datos->real_escape_string($distrito);
    }

    function setLocalidad($localidad) {
        $this->localidad = $this->base_datos->real_escape_string($localidad);
    }

    function setDireccion($direccion) {
        $this->direccion = $this->base_datos->real_escape_string($direccion);
    }

    function setCoste($coste) {
        $this->coste = $coste;
    }

    function setEstado($estado) {
        $this->estado = $estado;
    }

    function setFecha($fecha) {
        $this->fecha = $fecha;
    }

    function setHora($hora) {
        $this->hora = $hora;
    }

    public function save() {
        $consulta = "INSERT INTO ordenes VALUES (null,'{$this->usuario_id}','{$this->provincia}','{$this->canton}','{$this->distrito}','{$this->localidad}','{$this->direccion}',{$this->coste},'Confirmada', CURDATE(), CURTIME());";
        $save = $this->base_datos->query($consulta);

        $result = false;
        if ($save) {
            $result = true;
        }
        return $result;
    }

    public function getAll() {
        $consulta = "SELECT o.*, u.nombre AS nombre, u.apellidos AS apellidos, u.cedula AS cedula FROM ordenes o "
        . "INNER JOIN usuarios u ON u.id=o.usuario_id "
        . "ORDER BY o.id DESC ";

        $orden = $this->base_datos->query($consulta);
        return $orden;
    }

    public function getorden($id) {
        $consulta = "SELECT * FROM ordenes WHERE id=$id;";
        $orden = $this->base_datos->query($consulta);
        return $orden;
    }

    public function getOrdenByCita($id) {
        $consulta = "SELECT * FROM ordenes o "
                    ."INNER JOIN lineas_citas_ordenes lco ON lco.cita_id='$id' "
                    ."WHERE lco.orden_id = o.id ;";

        $orden = $this->base_datos->query($consulta)->fetch_object();
        /*echo $this->base_datos->error;
        var_dump($orden);
        die();*/
        return $orden;
    }

    public function getordenByUser($id) {
        $consulta = "SELECT p.id, p.coste FROM ordenes p "
                //."INNER JOIN lineas_ordenes_productos lp ON lp.orden_id = p.id "
                . "WHERE p.usuario_id={$id} ORDER BY id DESC LIMIT 1";
        $orden = $this->base_datos->query($consulta);
        /*echo $consulta;
        echo $this->base_datos->error;
        var_dump($orden);
        die();*/
        return $orden->fetch_object();
    }
    
    public function getordenesByUser($id) {
        $consulta = "SELECT p.* FROM ordenes p "
                //."INNER JOIN lineas_ordenes_productos lp ON lp.orden_id = p.id "
                . "WHERE p.usuario_id={$id} ORDER BY id DESC ";
        $orden = $this->base_datos->query($consulta);
        /*echo $consulta;
        echo $this->base_datos->error;
        var_dump($orden);
        die();*/
        return $orden;
    }

    public function getProductosByorden($id) {
        $consulta = "SELECT p.*, lp.unidades FROM productos p"
                . " INNER JOIN lineas_ordenes_productos lp ON lp.producto_id = p.id"
                . " WHERE lp.orden_id = {$id}";
        /*$consulta = "SELECT * FROM productos WHERE id IN"
                . " (SELECT producto_id FROM lineas_ordenes_productos WHERE orden_id='{$id}')";
        */
        $productos = $this->base_datos->query($consulta);

        return $productos;
    }

    public function getServiciosByorden($id) {
        $consulta = "SELECT p.*, lp.unidades FROM servicios p"
                . " INNER JOIN lineas_ordenes_servicios lp ON lp.servicio_id = p.id"
                . " WHERE lp.orden_id = {$id}";
        
        $servicios = $this->base_datos->query($consulta);

        return $servicios;
    }

    public function getCombosByorden($id) {
        $consulta = "SELECT p.*, lp.unidades FROM combos p"
                . " INNER JOIN lineas_ordenes_combos lp ON lp.combo_id = p.id"
                . " WHERE lp.orden_id = {$id}";
        
        $servicios = $this->base_datos->query($consulta);

        return $servicios;
    }

    public function getCitaByorden($id) {
        $consulta = "SELECT c.* FROM citas c"
                . " INNER JOIN lineas_citas_ordenes lp ON lp.cita_id = c.id"
                . " WHERE lp.orden_id = {$id}";
        
        $servicios = $this->base_datos->query($consulta)->fetch_object();

        return $servicios;
    }


    public function save_lineas_productos_servicios_combos() {
        $consulta = "SELECT LAST_INSERT_ID() AS 'orden';";
        $query = $this->base_datos->query($consulta);
        $orden_id = $query->fetch_object()->orden;

        if (isset($_SESSION['carrito_productos'])) {
            foreach ($_SESSION['carrito_productos'] as $elemento) {
                $producto = $elemento['producto'];
                $insert = "INSERT INTO lineas_ordenes_productos VALUES (NULL,'$producto->id','$orden_id',{$elemento['unidades']});";
                $save = $this->base_datos->query($insert);
                //Para revisar errores
                /* echo $this->base_datos->error
                  die();
                 */
            }
        }

        if (isset($_SESSION['carrito_servicios'])) {
            foreach ($_SESSION['carrito_servicios'] as $elemento) {
                $servicio = $elemento['servicio'];
                $insert = "INSERT INTO lineas_ordenes_servicios VALUES (NULL,{$servicio->id},{$orden_id},{$elemento['unidades']});";
                $save = $this->base_datos->query($insert);
            }
        }

        if (isset($_SESSION['carrito_combos'])) {
            foreach ($_SESSION['carrito_combos'] as $elemento) {
                $combo = $elemento['combo'];
                $insert = "INSERT INTO lineas_ordenes_combos VALUES (NULL,{$combo->id},{$orden_id},{$elemento['unidades']});";
                $save = $this->base_datos->query($insert);
            }
        }
    
        $result = false;
        if ($save) {
            $result = true;
        }

        return $result;
    }

    public function save_lineas_cita_orden($orden_id, $cita_id){

        $insert = "INSERT INTO lineas_citas_ordenes VALUES (NULL,'$orden_id','$cita_id',0);";
        $save = $this->base_datos->query($insert);
        //Para revisar errores
        /* echo $this->base_datos->error
            die();
            */

        $result = false;
        if ($save) {
            $result = true;
        }
        return $result;
    }

    public function getOrdenSave_Id(){
        $consulta = "SELECT LAST_INSERT_ID() AS 'orden';";
        $query = $this->base_datos->query($consulta);
        $orden_id = $query->fetch_object()->orden;
        
        return $orden_id;
    }
    
    public function edit($id,$estado){
        $consulta = "UPDATE ordenes SET estado='{$estado}' WHERE id='{$id}'";
        $update = $this->base_datos->query($consulta);
        return $update;
    }

}
