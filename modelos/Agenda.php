<?php

class Agenda {

    //Los modelos empleados contienen todos los atributos relacionados a cada entidad y también los
    //las funciones encargadas de obtener o establecer la información de cada objeto
    //Contiene los métodos que se comunican con la base de datos para realizar todas las operaciones CRUD

    private $id;
    private $fecha;
    private $hora_6am_cita_id;
    private $hora_7am_cita_id;
    private $hora_8am_cita_id;
    private $hora_9am_cita_id;
    private $hora_10am_cita_id;
    private $hora_11am_cita_id;
    private $hora_12am_cita_id;
    private $hora_1pm_cita_id;
    private $hora_2pm_cita_id;
    private $hora_3pm_cita_id;
    private $hora_4pm_cita_id;
    private $hora_5pm_cita_id;
    private $hora_6pm_cita_id;

    private $base_datos;

    public function __construct(){
        $this->base_datos = BaseDatos::conectar();
    }
    public function getId()
    {
        return $this->id;
    }
    public function setId($id): self
    {
        $this->id = $id;
        return $this;
    }

    public function getFecha()
    {
        return $this->fecha;
    }
    public function setFecha($fecha): self
    {
        $this->fecha = $fecha;

        return $this;
    }

    public function getHora6amCitaId()
    {
        return $this->hora_6am_cita_id;
    }
    public function setHora6amCitaId($hora_6am_cita_id): self
    {
        $this->hora_6am_cita_id = $this->base_datos->real_escape_string($hora_6am_cita_id);

        return $this;
    }

    public function getHora7amCitaId()
    {
        return $this->hora_7am_cita_id;
    }
    public function setHora7amCitaId($hora_7am_cita_id): self
    {
        $this->hora_7am_cita_id = $this->base_datos->real_escape_string($hora_7am_cita_id);

        return $this;
    }

    public function getHora8amCitaId()
    {
        return $this->hora_8am_cita_id;
    }
    public function setHora8amCitaId($hora_8am_cita_id): self
    {
        $this->hora_8am_cita_id = $this->base_datos->real_escape_string($hora_8am_cita_id);

        return $this;
    }

    public function getHora9amCitaId()
    {
        return $this->hora_9am_cita_id;
    }
    public function setHora9amCitaId($hora_9am_cita_id): self
    {
        $this->hora_9am_cita_id = $this->base_datos->real_escape_string($hora_9am_cita_id);

        return $this;
    }

    public function getHora10amCitaId()
    {
        return $this->hora_10am_cita_id;
    }

    public function setHora10amCitaId($hora_10am_cita_id): self
    {
        $this->hora_10am_cita_id = $this->base_datos->real_escape_string($hora_10am_cita_id);

        return $this;
    }

    public function getHora11amCitaId()
    {
        return $this->hora_11am_cita_id;
    }
    public function setHora11amCitaId($hora_11am_cita_id): self
    {
        $this->hora_11am_cita_id = $this->base_datos->real_escape_string($hora_11am_cita_id);

        return $this;
    }

    public function getHora12amCitaId()
    {
        return $this->hora_12am_cita_id;
    }
    public function setHora12amCitaId($hora_12am_cita_id): self
    {
        $this->hora_12am_cita_id = $this->base_datos->real_escape_string($hora_12am_cita_id);

        return $this;
    }

    public function getHora1pmCitaId()
    {
        return $this->hora_1pm_cita_id;
    }
    public function setHora1pmCitaId($hora_1pm_cita_id): self
    {
        $this->hora_1pm_cita_id = $this->base_datos->real_escape_string($hora_1pm_cita_id);

        return $this;
    }

    public function getHora2pmCitaId()
    {
        return $this->hora_2pm_cita_id;
    }
    public function setHora2pmCitaId($hora_2pm_cita_id): self
    {
        $this->hora_2pm_cita_id = $this->base_datos->real_escape_string($hora_2pm_cita_id);

        return $this;
    }

    public function getHora3pmCitaId()
    {
        return $this->hora_3pm_cita_id;
    }
    public function setHora3pmCitaId($hora_3pm_cita_id): self
    {
        $this->hora_3pm_cita_id = $this->base_datos->real_escape_string($hora_3pm_cita_id);

        return $this;
    }

    public function getHora4pmCitaId()
    {
        return $this->hora_4pm_cita_id;
    }

    public function setHora4pmCitaId($hora_4pm_cita_id): self
    {
        $this->hora_4pm_cita_id = $this->base_datos->real_escape_string($hora_4pm_cita_id);

        return $this;
    }

    function getHora5pmCitaId()
    {
        return $this->hora_5pm_cita_id;
    }
    public function setHora5pmCitaId($hora_5pm_cita_id): self
    {
        $this->hora_5pm_cita_id = $this->base_datos->real_escape_string($hora_5pm_cita_id);

        return $this;
    }

    public function getHora6pmCitaId()
    {
        return $this->hora_6pm_cita_id;
    }
    public function setHora6pmCitaId($hora_6pm_cita_id): self
    {
        $this->hora_6pm_cita_id = $this->base_datos->real_escape_string($hora_6pm_cita_id);

        return $this;
    }

    public function save(){

        $consulta = "INSERT INTO agenda VALUES(NULL,'$this->fecha','$this->hora_6am_cita_id','$this->hora_7am_cita_id','$this->hora_8am_cita_id','$this->hora_9am_cita_id','$this->hora_10am_cita_id','$this->hora_11am_cita_id','$this->hora_12am_cita_id','$this->hora_1pm_cita_id','$this->hora_2pm_cita_id','$this->hora_3pm_cita_id','$this->hora_4pm_cita_id','$this->hora_5pm_cita_id','$this->hora_6pm_cita_id');";
    
        $save = $this->base_datos->query($consulta);

        //echo $this->base_datos->error;
         //die();

        $result = false;
        if($save){
            $result = true;
        }
        return $result;
    }

    public function getAgendaPorId($id){
        $consulta = "SELECT *  FROM agenda WHERE id='$id';";

        $agenda = $this->base_datos->query($consulta);

        // Para revisar errores en la consulta.
        // echo $this->base_datos->error;
        // die();
        $result = false;
        if($agenda){
            return $agenda;
        }

        return $result;
    }

    public function getAgendaPorFecha($fecha){
        $consulta = "SELECT *  FROM agenda WHERE fecha='$fecha';";

        $agenda_dia = $this->base_datos->query($consulta);

        // Para revisar errores en la consulta.
        // echo $this->base_datos->error;
        // die();
        $result = false;
        if($agenda_dia){
            return $agenda_dia;
        }

        return $result;
    }

    public function getAgendaPorFechas($fecha, $dias){
        $mañana        = mktime(0, 0, 0, date("m")  , date("d")+1, date("Y"));

        $agenda_dias = array();

        for($i=0; $i<=$dias; $i++){
            $mañana = mktime(0, 0, 0, date("m")  , date("d") + $i, date("Y"));
            $agenda_dia = $this->getAgendaPorFecha($mañana);
            if($agenda_dia){
                array_push($agenda_dias, $agenda_dia);
            }
        }
    }

    public function edit(){

        $consulta = "UPDATE agenda SET fecha='$this->fecha',hora_6am_cita_id='$this->hora_6am_cita_id',hora_7am_cita_id='$this->hora_7am_cita_id',hora_8am_cita_id='$this->hora_8am_cita_id',hora_9am_cita_id='$this->hora_9am_cita_id',hora_10am_cita_id='$this->hora_10am_cita_id',hora_11am_cita_id='$this->hora_11am_cita_id',hora_12am_cita_id='$this->hora_12am_cita_id',hora_1pm_cita_id='$this->hora_1pm_cita_id',hora_2pm_cita_id='$this->hora_2pm_cita_id',hora_3pm_cita_id='$this->hora_3pm_cita_id',hora_4pm_cita_id='$this->hora_4pm_cita_id',hora_5pm_cita_id='$this->hora_5pm_cita_id',hora_6pm_cita_id='$this->hora_6pm_cita_id'";

        $consulta .=" WHERE id='{$this->id}';";
       
        $update = $this->base_datos->query($consulta);
        
        //echo $this->base_datos->error;
        //echo $consulta;
        //die();
        $result = false;
        if($update){
            $result = true;
        }
        return $result;
    }

    public function checkFecha($fecha){
        $consulta = "SELECT fecha FROM agenda WHERE fecha='$fecha';";

        $existe = $this->base_datos->query($consulta);

        if($existe->fetch_object()){
            return true;
        }else{
            return false;
        }
    }

    public function getFechaPorId($id){
        $consulta = "SELECT fecha FROM agenda WHERE id='$id';";

        $resultado = $this->base_datos->query($consulta);

        $fecha = $resultado->fetch_object()->fecha;
        if($fecha){
            return $fecha;
        }else{
            return false;
        }
    }

    public function getAgendaListadoActivas(){

        $fecha = date("Y-m-d");
        $consulta = "SELECT * FROM agenda WHERE fecha >='$fecha';";

        $agenda = $this->base_datos->query($consulta);

        //echo $this->base_datos->error;
        //die();
        return $agenda;
    }

    public function getAgendaPorDia($fecha){

        $consulta = "SELECT * FROM agenda WHERE fecha='$fecha';";

        $agenda = $this->base_datos->query($consulta);

        //echo $this->base_datos->error;
        //die();
        return $agenda;
    }

    public function updateAgendaPorHora($hora_columna, $cita_id, $fecha){
        $consulta = "UPDATE agenda SET {$hora_columna}='$cita_id' WHERE fecha='$fecha'";

        $update = $this->base_datos->query($consulta);

        $result = false;
        if($update){
            $result = true;
        }
        return $result;
    }

    public function checkDisponibilidadAgenda($hora_columna, $fecha){
        $consulta = "SELECT * FROM agenda WHERE $hora_columna='disponible' AND fecha='$fecha';";

        $resultado = $this->base_datos->query($consulta);

        $result = false;

        $disponible = $resultado->fetch_object();

        if($disponible){
            $result = true;
        }

        return $result;
    }

    public function checkDisponibilidadAgenda2($suma_duracion_horas,$duracion, $fecha){
        $am = true;
        for ($i = 0; $i < $duracion; $i++) {
            $suma_duracion_horas += 1;
            if ($suma_duracion_horas > 12 || $suma_duracion_horas == 1) {
                $suma_duracion_horas = 1;
                $meridiano = "pm_cita_id";
                $am = false;
            } else {
                if($suma_duracion_horas < 6){
                    $am = false;
                    $meridiano = "pm_cita_id";
                }
                if($am){
                    $meridiano = "am_cita_id";
                }
            }
    
            //Revisar Horas de chequeo que no guarde antes de revisar
            $hora_columna = "hora_" . $suma_duracion_horas . $meridiano;

            $consulta = "SELECT * FROM agenda WHERE $hora_columna='disponible' AND fecha='$fecha';";

            $resultado = $this->base_datos->query($consulta);
    
            $disponible = $resultado->fetch_object();
    
            if(!$disponible){
                return true;
            }
            
        }
        return false;
    }

    public function delete(){
        $consulta = "DELETE FROM agenda WHERE id='$this->id'";
        $delete = $this->base_datos->query($consulta);
        
        $result = false;
        if($delete){
            $result = true;
        }
        return $result;
    }

    public function cancelar($fecha,$hora,$estado,$duracion){

        $numero_hora = Utilidades::obtenerHora($hora);

        //$agenda = new Agenda();
        $suma_duracion_horas = $numero_hora - 1;
        $am = true;

        for ($i = 0; $i < $duracion; $i++) {
            $suma_duracion_horas += 1;
            if ($suma_duracion_horas > 12 || $suma_duracion_horas == 1) {
                $suma_duracion_horas = 1;
                $meridiano = "pm_cita_id";
                $am = false;
            } else {
                if ($suma_duracion_horas < 6) {
                    $am = false;
                    $meridiano = "pm_cita_id";
                }
                if ($am) {
                    $meridiano = "am_cita_id";
                }
            }

            //Revisar Horas de chequeo que no guarde antes de revisar
            $hora_columna = "hora_" . $suma_duracion_horas . $meridiano;
            //$update = $agenda->updateAgendaPorHora($hora_columna, $estado, $fecha);
            $consulta = "UPDATE agenda SET {$hora_columna}='{$estado}' WHERE fecha='{$fecha}'";
            $update = $this->base_datos->query($consulta);
        }
        return $update;
  
    }


}
