<?php

//Modelos requeridos por el controlador
require_once 'modelos/Agenda.php';
require_once 'modelos/Orden.php';

//Controlador de las funcionalidades relacionadas con la agenda, sus vistas, entidad y métodos.
class AgendaController{

    public function index(){

    }

    //Método que se encarga mostrar la página de gestión de agendas.
    public function gestion(){
        Utilidades::isAdmin();
       
        $agenda = new Agenda();
        $orden = new Orden();
        Utilidades::deleteSession('idAgenda');

        $agendas = $agenda->getAgendaListadoActivas();

        require_once 'vistas/agenda/gestion.php';
    }

    //Método que muestra la página de creación de agendas por día
    public function create(){
        Utilidades::isAdmin();

        require_once 'vistas/agenda/create.php';
    }

    //Método que muestra al pantalla de edición de la agenda de un día
    public function edit() {
        Utilidades::isAdmin();

        if (isset($_GET['id']) && is_numeric($_GET['id'])) {
            $edit = true;
            $_SESSION['idAgenda'] = $_GET['id'];

            $agenda = new Agenda();

            $horario = $agenda->getAgendaPorId($_SESSION['idAgenda']);
            $_SESSION['horario'] = $horario->fetch_object();

            require_once 'vistas/agenda/create.php';
        } else {
            Utilidades::deleteSession('idAgenda');
            header("Location:" . base_url . "Agenda/gestion");
            ob_end_flush();
        }
    }

    //Método que se habilita la agenda para un día
    public function habilitar(){
        if (isset($_POST)) {
            
            $fecha = isset($_POST['fecha']) ? $_POST['fecha'] : false;
            $hora_6am_cita_id = isset($_POST['hora_6am_cita_id']) ? $_POST['hora_6am_cita_id'] : false;
            $hora_7am_cita_id = isset($_POST['hora_7am_cita_id']) ? $_POST['hora_7am_cita_id'] : false;
            $hora_8am_cita_id = isset($_POST['hora_8am_cita_id']) ? $_POST['hora_8am_cita_id'] : false;
            $hora_9am_cita_id = isset($_POST['hora_9am_cita_id']) ? $_POST['hora_9am_cita_id'] : false;
            $hora_10am_cita_id = isset($_POST['hora_10am_cita_id']) ? $_POST['hora_10am_cita_id'] : false;
            $hora_11am_cita_id = isset($_POST['hora_11am_cita_id']) ? $_POST['hora_11am_cita_id'] : false;
            $hora_12am_cita_id = isset($_POST['hora_12am_cita_id']) ? $_POST['hora_12am_cita_id'] : false;
            $hora_1pm_cita_id = isset($_POST['hora_1pm_cita_id']) ? $_POST['hora_1pm_cita_id'] : false;
            $hora_2pm_cita_id = isset($_POST['hora_2pm_cita_id']) ? $_POST['hora_2pm_cita_id'] : false;
            $hora_3pm_cita_id = isset($_POST['hora_3pm_cita_id']) ? $_POST['hora_3pm_cita_id'] : false;
            $hora_4pm_cita_id = isset($_POST['hora_4pm_cita_id']) ? $_POST['hora_4pm_cita_id'] : false;
            $hora_5pm_cita_id = isset($_POST['hora_5pm_cita_id']) ? $_POST['hora_5pm_cita_id'] : false;
            $hora_6pm_cita_id = isset($_POST['hora_6pm_cita_id']) ? $_POST['hora_6pm_cita_id'] : false;
            // Array de errores 
            $errores = Array();
           
            // Validar los datos antes de guardarlos en la base de datos.
 
            if (!empty($fecha)) {
                $_SESSION['loadfecha'] = $fecha;
            } else {
                $errores['fecha'] = "La fecha no es válida.";
            }
           
            if (!empty($hora_6am_cita_id)) {
                $_SESSION['loadhora_6am_cita_id'] = $hora_6am_cita_id;
                Utilidades::deleteSession('no_checked_hora_6am_cita_id');
            } else {
                if(is_numeric($_SESSION['horario']->hora_6am_cita_id)){
                    $_SESSION['loadhora_6am_cita_id'] = $_SESSION['horario']->hora_6am_cita_id;
                    $hora_6pm_cita_id = $_SESSION['horario']->hora_6am_cita_id;
                    Utilidades::deleteSession('no_checked_hora_6am_cita_id');
                }else{
                    $_SESSION['no_checked_hora_6am_cita_id'] = true;
                    $hora_6am_cita_id = "no_disponible";
                }           
            }
            if (!empty($hora_7am_cita_id)) {
                $_SESSION['loadhora_7am_cita_id'] = $hora_7am_cita_id;
                Utilidades::deleteSession('no_checked_hora_7am_cita_id');
            } else {
                if(is_numeric($_SESSION['horario']->hora_7am_cita_id)){
                    $_SESSION['loadhora_7am_cita_id'] = $_SESSION['horario']->hora_7am_cita_id;
                    $hora_7am_cita_id = $_SESSION['horario']->hora_7am_cita_id;
                    Utilidades::deleteSession('no_checked_hora_7am_cita_id');
                }else{
                    $_SESSION['no_checked_hora_7am_cita_id'] = true;
                    $hora_7am_cita_id = "no_disponible";
                }
            }
            if (!empty($hora_8am_cita_id)) {
                Utilidades::deleteSession('no_checked_hora_8am_cita_id');
                $_SESSION['loadhora_8am_cita_id'] = $hora_8am_cita_id;
            } else {
                if(is_numeric($_SESSION['horario']->hora_8am_cita_id)){
                    $_SESSION['loadhora_8am_cita_id'] = $_SESSION['horario']->hora_8am_cita_id;
                    $hora_8am_cita_id = $_SESSION['horario']->hora_8am_cita_id;
                    Utilidades::deleteSession('no_checked_hora_8am_cita_id');
                }else{
                    $_SESSION['no_checked_hora_8am_cita_id'] = true;
                    $hora_8am_cita_id = "no_disponible";
                }
            }
            if (!empty($hora_9am_cita_id)) {
                Utilidades::deleteSession('no_checked_hora_9am_cita_id');
                $_SESSION['loadhora_9am_cita_id'] = $hora_9am_cita_id;
            } else {
                if(is_numeric($_SESSION['horario']->hora_9am_cita_id)){
                    $_SESSION['loadhora_9am_cita_id'] = $_SESSION['horario']->hora_9am_cita_id;
                    $hora_9am_cita_id = $_SESSION['horario']->hora_9am_cita_id;
                    Utilidades::deleteSession('no_checked_hora_9am_cita_id');
                }else{
                    $_SESSION['no_checked_hora_9am_cita_id'] = true;
                    $hora_9am_cita_id = "no_disponible";
                }
            }
            if (!empty($hora_10am_cita_id)) {
                Utilidades::deleteSession('no_checked_hora_10am_cita_id');
                $_SESSION['loadhora_10am_cita_id'] = $hora_10am_cita_id;
            } else {
                if(is_numeric($_SESSION['horario']->hora_10am_cita_id)){
                    $_SESSION['loadhora_10am_cita_id'] = $_SESSION['horario']->hora_10am_cita_id;
                    $hora_10am_cita_id = $_SESSION['horario']->hora_10am_cita_id;
                    Utilidades::deleteSession('no_checked_hora_10am_cita_id');
                }else{
                    $_SESSION['no_checked_hora_10am_cita_id'] = true;
                    $hora_10am_cita_id = "no_disponible";
                }
            }
            if (!empty($hora_11am_cita_id)) {
                Utilidades::deleteSession('no_checked_hora_11am_cita_id');
                $_SESSION['loadhora_11am_cita_id'] = $hora_11am_cita_id;
            } else {
                if(is_numeric($_SESSION['horario']->hora_11am_cita_id)){
                    $_SESSION['loadhora_11am_cita_id'] = $_SESSION['horario']->hora_11am_cita_id;
                    $hora_11am_cita_id = $_SESSION['horario']->hora_11am_cita_id;
                    Utilidades::deleteSession('no_checked_hora_11am_cita_id');
                }else{
                    $_SESSION['no_checked_hora_11am_cita_id'] = true;
                    $hora_11am_cita_id = "no_disponible";
                }
            }
            if (!empty($hora_12am_cita_id)) {
                Utilidades::deleteSession('no_checked_hora_12am_cita_id');
                $_SESSION['loadhora_12am_cita_id'] = $hora_12am_cita_id;
            } else {
                if(is_numeric($_SESSION['horario']->hora_12am_cita_id)){
                    $_SESSION['loadhora_12am_cita_id'] = $_SESSION['horario']->hora_12am_cita_id;
                    $hora_12am_cita_id = $_SESSION['horario']->hora_12am_cita_id;
                    Utilidades::deleteSession('no_checked_hora_12am_cita_id');
                }else{
                    $_SESSION['no_checked_hora_12am_cita_id'] = true;
                    $hora_12am_cita_id = "no_disponible";
                }
            }

            if (!empty($hora_1pm_cita_id)) {
                Utilidades::deleteSession('no_checked_hora_1pm_cita_id');
                $_SESSION['loadhora_1pm_cita_id'] = $hora_1pm_cita_id;
            } else {
                if(is_numeric($_SESSION['horario']->hora_1pm_cita_id)){
                    $_SESSION['loadhora_1pm_cita_id'] = $_SESSION['horario']->hora_1pm_cita_id;
                    $hora_1pm_cita_id = $_SESSION['horario']->hora_1pm_cita_id;
                    Utilidades::deleteSession('no_checked_hora_1pm_cita_id');
                }else{
                    $_SESSION['no_checked_hora_1pm_cita_id'] = true;
                    $hora_1pm_cita_id = "no_disponible";
                }
            }
            if (!empty($hora_2pm_cita_id)) {
                Utilidades::deleteSession('no_checked_hora_2pm_cita_id');
                $_SESSION['loadhora_2pm_cita_id'] = $hora_2pm_cita_id;
            } else {
                if(is_numeric($_SESSION['horario']->hora_2pm_cita_id)){
                    $_SESSION['loadhora_2pm_cita_id'] = $_SESSION['horario']->hora_2pm_cita_id;
                    $hora_2pm_cita_id = $_SESSION['horario']->hora_2pm_cita_id;
                    Utilidades::deleteSession('no_checked_hora_2pm_cita_id');
                }else{
                    $_SESSION['no_checked_hora_2pm_cita_id'] = true;
                    $hora_2pm_cita_id = "no_disponible";
                }
            }
            if (!empty($hora_3pm_cita_id)) {
                Utilidades::deleteSession('no_checked_hora_3pm_cita_id');
                $_SESSION['loadhora_3pm_cita_id'] = $hora_3pm_cita_id;
            } else {
                if(is_numeric($_SESSION['horario']->hora_3pm_cita_id)){
                    $_SESSION['loadhora_3pm_cita_id'] = $_SESSION['horario']->hora_3pm_cita_id;
                    $hora_3pm_cita_id = $_SESSION['horario']->hora_3pm_cita_id;
                    Utilidades::deleteSession('no_checked_hora_3pm_cita_id');
                }else{
                    $_SESSION['no_checked_hora_3pm_cita_id'] = true;
                    $hora_3pm_cita_id = "no_disponible";
                }
            }
            if (!empty($hora_4pm_cita_id)) {
                Utilidades::deleteSession('no_checked_hora_4pm_cita_id');
                $_SESSION['loadhora_4pm_cita_id'] = $hora_4pm_cita_id;
            } else {
                if(is_numeric($_SESSION['horario']->hora_4pm_cita_id)){
                    $_SESSION['loadhora_4pm_cita_id'] = $_SESSION['horario']->hora_4pm_cita_id;
                    $hora_4pm_cita_id = $_SESSION['horario']->hora_4pm_cita_id;
                    Utilidades::deleteSession('no_checked_hora_4pm_cita_id');
                }else{
                    $_SESSION['no_checked_hora_4pm_cita_id'] = true;
                    $hora_4pm_cita_id = "no_disponible";
                }
            }
            if (!empty($hora_5pm_cita_id)) {
                Utilidades::deleteSession('no_checked_hora_5pm_cita_id');
                $_SESSION['loadhora_5pm_cita_id'] = $hora_5pm_cita_id;
            } else {
                if(is_numeric($_SESSION['horario']->hora_5pm_cita_id)){
                    $_SESSION['loadhora_5pm_cita_id'] = $_SESSION['horario']->hora_5pm_cita_id;
                    $hora_5pm_cita_id = $_SESSION['horario']->hora_5pm_cita_id;
                    Utilidades::deleteSession('no_checked_hora_5pm_cita_id');
                }else{
                    $_SESSION['no_checked_hora_5pm_cita_id'] = true;
                    $hora_5pm_cita_id = "no_disponible";
                }
            }
            if (!empty($hora_6pm_cita_id)) {
                Utilidades::deleteSession('no_checked_hora_6pm_cita_id');
                $_SESSION['loadhora_6pm_cita_id'] = $hora_6pm_cita_id;
            } else {
                if(is_numeric($_SESSION['horario']->hora_6pm_cita_id)){
                    $_SESSION['loadhora_6pm_cita_id'] = $_SESSION['horario']->hora_6pm_cita_id;
                    $hora_6pm_cita_id = $_SESSION['horario']->hora_6pm_cita_id;
                    Utilidades::deleteSession('no_checked_hora_6pm_cita_id');
                }else{
                    $_SESSION['no_checked_hora_6pm_cita_id'] = true;
                    $hora_6pm_cita_id = "no_disponible";
                }
            }
           
            $guardar_agenda = false;
                $agenda = new Agenda();
                
                $agenda->setFecha($fecha);
                $agenda->setHora6amCitaId($hora_6am_cita_id);
                $agenda->setHora7amCitaId($hora_7am_cita_id);
                $agenda->setHora8amCitaId($hora_8am_cita_id);
                $agenda->setHora9amCitaId($hora_9am_cita_id);
                $agenda->setHora10amCitaId($hora_10am_cita_id);
                $agenda->setHora11amCitaId($hora_11am_cita_id);
                $agenda->setHora12amCitaId($hora_12am_cita_id);
                $agenda->setHora1pmCitaId($hora_1pm_cita_id);
                $agenda->setHora2pmCitaId($hora_2pm_cita_id);
                $agenda->setHora3pmCitaId($hora_3pm_cita_id);
                $agenda->setHora4pmCitaId($hora_4pm_cita_id);
                $agenda->setHora5pmCitaId($hora_5pm_cita_id);
                $agenda->setHora6pmCitaId($hora_6pm_cita_id);

                if(isset($_GET['id'])){
                    $id = $_GET['id'];
                    $agenda->setId($id);

                    $fecha_actual = $agenda->getFechaPorId($id);
                    if($fecha_actual != $fecha){

                        $checkFecha = $agenda->checkFecha($fecha);

                        if(!$checkFecha){
                            $save = $agenda->edit();
                            Utilidades::deleteSession('idAgenda');

                        }else{
                            $_SESSION['checkFecha'] = "La fecha ya se encuentra registrada en la agenda.";
                            Utilidades::deleteSession('idAgenda');
                        }
                    }else{
                        $save = $agenda->edit();
                        Utilidades::deleteSession('idAgenda');
                    }
                }else{

                    $checkFecha = $agenda->checkFecha($fecha);

                    if(!$checkFecha){
                        $save = $agenda->save();
                    }else{
                        $_SESSION['checkFecha'] = "La fecha ya se encuentra registrada en la agenda.";
                        header("Location: " . base_url . "Agenda/create");
                        ob_end_flush();
                    }
                }
                
                if ($save) {
                    $_SESSION['regAgenda'] = "complete";
                    Utilidades::deleteSession('loadfecha');
                    Utilidades::deleteSession('loadhora_6am_cita_id');
                    Utilidades::deleteSession('loadhora_7am_cita_id');
                    Utilidades::deleteSession('loadhora_8am_cita_id');
                    Utilidades::deleteSession('loadhora_9am_cita_id');
                    Utilidades::deleteSession('loadhora_10am_cita_id');
                    Utilidades::deleteSession('loadhora_11am_cita_id');
                    Utilidades::deleteSession('loadhora_12am_cita_id');
                    Utilidades::deleteSession('loadhora_1pm_cita_id');
                    Utilidades::deleteSession('loadhora_2pm_cita_id');
                    Utilidades::deleteSession('loadhora_3pm_cita_id');
                    Utilidades::deleteSession('loadhora_4pm_cita_id');
                    Utilidades::deleteSession('loadhora_5pm_cita_id');
                    Utilidades::deleteSession('loadhora_6pm_cita_id');

                    Utilidades::deleteSession('no_checked_hora_6am_cita_id');
                    Utilidades::deleteSession('no_checked_hora_7am_cita_id');
                    Utilidades::deleteSession('no_checked_hora_8am_cita_id');
                    Utilidades::deleteSession('no_checked_hora_9am_cita_id');
                    Utilidades::deleteSession('no_checked_hora_10am_cita_id');
                    Utilidades::deleteSession('no_checked_hora_11am_cita_id');
                    Utilidades::deleteSession('no_checked_hora_12am_cita_id');

                    Utilidades::deleteSession('no_checked_hora_1pm_cita_id');
                    Utilidades::deleteSession('no_checked_hora_2pm_cita_id');
                    Utilidades::deleteSession('no_checked_hora_3pm_cita_id');
                    Utilidades::deleteSession('no_checked_hora_4pm_cita_id');
                    Utilidades::deleteSession('no_checked_hora_5pm_cita_id');
                    Utilidades::deleteSession('no_checked_hora_6pm_cita_id');

                    header("Location: " . base_url . "Agenda/gestion");
                    ob_end_flush();
                } else {
                    $_SESSION['regAgenda'] = "failed";
                    header("Location: " . base_url . "Agenda/create");
                    ob_end_flush();
                }
            }
          
        
    }

    //Método que devuelve las horas disponibles en la agenda por día
    public function horas_disponibles(){
        $horario = null; 

        if(isset($_POST)){
            $fecha = isset($_POST['fecha']) ? $_POST['fecha'] : false;
            //var_dump($fecha);
            $agenda = new Agenda();
            $horario = $agenda->getAgendaPorDia($fecha);
            $_SESSION['horario'] = $horario->fetch_object();
        }

        $_SESSION['fecha_cita'] = $_POST['fecha'];
        
        header('Location:' . base_url . "Orden/index");
        ob_end_flush();
    }

    //Método que se encarga de borrar la agenda de un día
    public function delete() {
        Utilidades::isAdmin();

        if (isset($_GET['id'])) {
            $agenda = new Agenda();
            $agenda->setId($_GET['id']);

            $_SESSION['idAgenda'] = $_GET['id'];

            $horario = $agenda->getAgendaPorId($_SESSION['idAgenda']);      
            $horario = $horario->fetch_object();

            $orden = new Orden();
            $citas = false;

            if(is_numeric($horario->hora_7am_cita_id)){
               $citas = true;
            }
            if(is_numeric($horario->hora_8am_cita_id)){
                $citas = true;
            }
            if(is_numeric($horario->hora_9am_cita_id)){
                $citas = true;
            }
            if(is_numeric($horario->hora_10am_cita_id)){
                $citas = true;
            }
            if(is_numeric($horario->hora_11am_cita_id)){
                $citas = true;
            }
            if(is_numeric($horario->hora_12am_cita_id)){
                $citas = true;
            }   
            if(is_numeric($horario->hora_1pm_cita_id)){
                $citas = true;
            }   
            if(is_numeric($horario->hora_2pm_cita_id)){
                $citas = true;
            } 
            if(is_numeric($horario->hora_3pm_cita_id)){
                $citas = true;
            } 
            if(is_numeric($horario->hora_4pm_cita_id)){
                $citas = true;
            } 
            if(is_numeric($horario->hora_5pm_cita_id)){
                $citas = true;
            } 

            if(!$citas){
                $delete = $agenda->delete();
            }
        
            if ($delete) {
                $_SESSION['delete'] = 'complete';
            } else {
                $_SESSION['delete'] = 'failed';
            }
        } else {
            $_SESSION['delete'] = 'failed';
        }
        header("Location:" . base_url . "Agenda/gestion");
        ob_end_flush();
    }

    //Método que se encarga de registrar la cancelación de una cita
    /*public function cancelarCita($cita_id, $orden_id){
        Utilidades::isIdentity();
  
        $orden = new Orden();

        $cita = new Cita();
        $obj_cita = $cita->getcita($cita_id)->fetch_object();

        $agenda = new Agenda();

        if (is_object($obj_cita)){
            $usuario = $_SESSION['identity'];

            $orden->edit($orden_id, "Cancelada");
            $cita->edit($cita_id, "Cancelada");

            if(Utilidades::isAdminValor()){
                //$agenda->cancelar($obj_cita->fecha, $obj_cita->hora, "no_disponible", $obj_cita->duracion);
                Utilidades::enviarCorreo($usuario->email, "Cancelación", $orden_id, $obj_cita->monto, $cita_id, $obj_cita->fecha, $obj_cita->hora);
            }     
        }
    }*/

    
}