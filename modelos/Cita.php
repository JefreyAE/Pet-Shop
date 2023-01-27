<?php

Class Cita{

    //Los modelos empleados contienen todos los atributos relacionados a cada entidad y también los
    //las funciones encargadas de obtener o establecer la información de cada objeto
    //Contiene los métodos que se comunican con la base de datos para realizar todas las operaciones CRUD
    
    private $id;
    private $usuario_id;
    private $descripcion;
    private $monto;
    private $fecha;
    private $hora;
    private $duracion;
    private $telefono_1;
    private $telefono_2;
    private $nombre;
    private $raza;
    private $estado;

    private $base_datos;

    public function __construct(){
        $this->base_datos = BaseDatos::conectar();
    } 

    public function getId(){
        return $this->id;
    }

    public function setId($id){
        $this->id = $this->base_datos->real_escape_string($id);
    }

    public function getEstado(){
        return $this->estado;
    }

    public function setEstado($estado){
        $this->estado = $this->base_datos->real_escape_string($estado);
    }

    public function getUsuario_id(){
        $this->usuario_id;
    }
    public function setUsuario_id($usuario_id){
        $this->usuario_id = $this->base_datos->real_escape_string($usuario_id);
    }

    public function getDescripcion(){
        $this->descripcion;
    }
    public function setDescripcion($descripcion){
        $this->descripcion = $this->base_datos->real_escape_string($descripcion);
    }

    public function setNombre($nombre){
        $this->nombre = $this->base_datos->real_escape_string($nombre);
    }

    public function getNombre(){
        return $this->nombre;
    }

    public function setRaza($raza){
        $this->raza = $this->base_datos->real_escape_string($raza);
    }

    public function getRaza(){
        return $this->raza;
    }

    public function getMonto(){
        $this->monto;
    }

    public function setMonto($monto){
        $this->monto = $this->base_datos->real_escape_string($monto);
    }

    public function getFecha(){
        return $this->fecha;
    }

    public function setFecha($fecha){
        $this->fecha = $fecha;
    }

    public function getHora(){
        return $this->hora;
    }

    public function setHora($hora){
        $this->hora = $this->base_datos->real_escape_string($hora);
    }

    public function getDuracion(){
        return $this->duracion;
    }

    public function setDuracion($duracion){
        $this->duracion = $this->base_datos->real_escape_string($duracion);
    }

    public function getTelefono_1(){
        return $this->telefono_1;
    }

    public function setTelefono_1($telefono_1){
        $this->telefono_1 = $this->base_datos->real_escape_string($telefono_1);
    }

    public function getTelefono_2(){
        return $this->telefono_2;
    }

    public function setTelefono_2($telefono_2){
        $this->telefono_2 = $this->base_datos->real_escape_string($telefono_2);
    }

    public function save(){
        
        $consulta = "INSERT INTO citas VALUES (NULL,' $this->usuario_id', ' $this->descripcion',' $this->monto',' $this->fecha',' $this->hora',' $this->duracion',' $this->telefono_1',' $this->telefono_2',' $this->nombre',' $this->raza', 'Habilitada');";
        
        $save = $this->base_datos->query($consulta);

        $result = false;
        if($save){
            $result = true;
        }
        return $result;
    }

    public function getCitaSave_Id(){
        $consulta = "SELECT LAST_INSERT_ID() AS 'cita';";
        $query = $this->base_datos->query($consulta);
        $cita_id = $query->fetch_object()->cita;
        
        return $cita_id;
    }

    public function getCita($id){
        $consulta = "SELECT * FROM citas WHERE id=$id;";
        $cita = $this->base_datos->query($consulta);
        return $cita;
    }

    public function getCitas(){
        $consulta = "SELECT c.*, l.orden_id AS orden_id, u.nombre AS nombre, u.apellidos AS apellidos, u.cedula AS cedula, u.telefono AS telefono FROM citas c "
                . "INNER JOIN lineas_citas_ordenes l ON l.cita_id=c.id "
                . "INNER JOIN usuarios u ON u.id=c.usuario_id "
                . "ORDER BY c.id DESC ";
        $cita = $this->base_datos->query($consulta);
        return $cita;
    }

    public function delete(){
        $consulta = "DELETE FROM citas WHERE id='$this->id';";
        $delete = $this->base_datos->query($consulta);

        $result = false;
        if($delete){
            $result = true;
        }
        return $result;
    }

    public function getcitasByUser($id) {
        $consulta = "SELECT c.*, l.orden_id AS orden_id FROM citas c "
                . "INNER JOIN lineas_citas_ordenes l ON l.cita_id=c.id "
                . "WHERE c.usuario_id={$id} ORDER BY c.id DESC ";
        $citas = $this->base_datos->query($consulta);
        /*echo $consulta;
        echo $this->base_datos->error;
        var_dump($orden);
        die();*/
        return $citas;
    }

    public function edit($id,$estado){
        $consulta = "UPDATE citas SET estado='{$estado}' WHERE id='{$id}'";
        $update = $this->base_datos->query($consulta);
        return $update;
    }

}