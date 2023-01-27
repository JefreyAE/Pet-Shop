<?php

require_once 'modelos/Cita.php';
require_once 'modelos/Orden.php';
require_once 'modelos/Agenda.php';
require_once 'modelos/Usuario.php';

//Controllador de los aspectos relacionados con las citas, vistas, modelos y métodos.
class CitaController
{
    //Carga la vista del index de citas
    public function index()
    {
        require_once 'vistas/cita/index.php';
    }

    //Muestra la lista de citas registradas
    public function gestion()
    {
        Utilidades::isAdmin();

        Utilidades::isIdentity();
        $gestion = true;
        $citas = new Cita();
        $lista_citas = $citas->getcitas();
 
        require_once 'vistas/cita/mis_citas.php';
    }

    //Crea una cita con los datos enviados por el usuario
    public function save()
    {
        if (isset($_POST)) {
            //var_dump($_POST);
            //die();
            $usuario_id = isset($_POST['usuario_id']) ? $_POST['usuario_id'] : false;
            $descripcion = isset($_POST['descripcion']) ? $_POST['descripcion'] : false;
            $monto = isset($_POST['monto']) ? $_POST['monto'] : false;
            $fecha = isset($_POST['fecha']) ? $_POST['fecha'] : false;
            $hora = isset($_POST['hora']) ? $_POST['hora'] : false;
            $duracion = isset($_POST['duracion']) ? $_POST['duracion'] : false;
            $telefono_1 = isset($_POST['telefono_1']) ? $_POST['telefono_1'] : false;
            $telefono_2 = isset($_POST['telefono_2']) ? $_POST['telefono_2'] : false;
            $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : false;
            $raza = isset($_POST['raza']) ? $_POST['raza'] : false;
            
            // Array de errores 
            $errores = array();

            // Validar los datos antes de guardarlos en la base de datos.
            //if (!empty($nombre) && !is_numeric($nombre) && !preg_match("/[0-9]/", $nombre)) {
            if (!empty($monto) && is_numeric($monto)) {
                $_SESSION['loadmonto'] = $monto;
            } else {
                $errores['monto'] = "El monto no es válido.";
            }

            if (!empty($hora)) {
                $_SESSION['loadhora'] = $hora;
            } else {
                $errores['hora'] = "Los hora no es válida.";
            }

            if (!empty($descripcion)) {
                $_SESSION['loaddescripcion'] = $descripcion;
            } else {
                $errores['descripcion'] = "La descripción no es válida.";
            }
            if (!empty($telefono_1)) {
                $_SESSION['loadtelefono_1'] = $telefono_1;
            } else {
                $errores['telefono_1'] = "El número de teléfono no es válido.";
            }
            if (!empty($telefono_2)) {
                $_SESSION['loadtelefono_2'] = $telefono_2;
            } else {
                $errores['telefono_1'] = "El número de teléfono no es válido.";
            }
            if (!empty($nombre)) {
                $_SESSION['loadnombre'] = $nombre;
            } else {
                $errores['nombre'] = "El nombre de la mascota no es válido.";
            }
            if (!empty($raza)) {
                $_SESSION['loadraza'] = $raza;
            } else {
                $errores['raza'] = "La raza de la moscota no es válida.";
            }

            if (count($errores) == 0) {
                $cita = new Cita();
                $cita->setUsuario_id($usuario_id);
                $cita->setDescripcion($descripcion);
                $cita->setMonto($monto);
                $cita->setFecha($fecha);
                $cita->setHora($hora);
                $cita->setDuracion($duracion);
                $cita->setTelefono_1($telefono_1);
                $cita->setTelefono_2($telefono_2);
                $cita->setNombre($nombre);
                $cita->setRaza($raza);

                $save = false;
                if (isset($_GET['id'])) {
                    $id = $_GET['id'];
                    $cita->setId($id);
                    //$save = $cita->edit();
                } else {
                    $save = $cita->save();
                }

                if ($save) {
                    $_SESSION['regProduct'] = "complete";
                    Utilidades::deleteSession('loadmonto');
                    Utilidades::deleteSession('loadhora');
                    Utilidades::deleteSession('loaddescripcion');
                    Utilidades::deleteSession('loadtelefono_1');
                    Utilidades::deleteSession('loadtelefono_2');
                    Utilidades::deleteSession('loadnombre');
                    Utilidades::deleteSession('loadraza');

                    $email = $_SESSION['identity']->email;

                    Utilidades::enviarCorreo($email, "Cita", "", $monto, $cita, $fecha, $hora);

                } else {
                    $_SESSION['regCita'] = "failed";
                    header('Location:' . base_url . "Carrito/index");
                    ob_end_flush();
                }
            } else {
                $_SESSION['erroresCita'] = $errores;
            }
        } else {
            $_SESSION['regCita'] = "failed";
            header('Location:' . base_url . "Carrito/index");
            ob_end_flush();
        }

        header('Location:' . base_url . "Orden/index");
        ob_end_flush();
    }

    //Retorna las citas de un usuario
    public function mis_citas()
    {
        Utilidades::isIdentity();
        $gestion = false;
        $citas = new Cita();
        $lista_citas = $citas->getcitasByUser($_SESSION['identity']->id);

        require_once 'vistas/cita/mis_citas.php';
    }

    //Muestra los datos de una cita
    public function detalle()
    {
        Utilidades::isIdentity();
  
        if (isset($_GET['cita_id'])&&is_numeric($_GET['cita_id'])) {
            $orden_id = $_GET['orden_id'];
            $orden = new Orden();
            $orden = $orden->getorden($orden_id)->fetch_object();
            $ord = new Orden();

            $cita_id = $_GET['cita_id'];
            $cita = new Cita();
            $cita = $cita->getcita($cita_id)->fetch_object();


            if (is_object($cita)){
                $usuario = new Usuario();
                $usuario = $usuario->getUsuario($cita->usuario_id)->fetch_object();

                $lista_productos = $ord->getProductosByorden($orden->id);
                $lista_servicios = $ord->getServiciosByorden($orden->id);
                $lista_combos = $ord->getCombosByorden($orden->id);
            }else{
                header("Location: " . base_url . 'Cita/mis_citas');
                ob_end_flush();
            }
            
        } else {
            header("Location: " . base_url . 'Cita/mis_citas');
            ob_end_flush();
        }

        require_once 'vistas/cita/detalle.php';
    }

    //Método que se encarga de registrar la cancelación de una cita
    public function cancelarCita(){
        Utilidades::isIdentity();
  
        if (isset($_GET['cita_id'])&&is_numeric($_GET['cita_id'])) {
            $orden_id = $_GET['orden_id'];
            $orden = new Orden();

            $cita_id = $_GET['cita_id'];
            $cita = new Cita();
            $obj_cita = $cita->getcita($cita_id)->fetch_object();

            $agenda = new Agenda();

            if (is_object($obj_cita)){
                $usuario = new Usuario();
                $usuario = $usuario->getUsuario($obj_cita->usuario_id)->fetch_object();

                $orden->edit($orden_id, "Cancelada");
                $cita->edit($cita_id, "Cancelada");

                if(Utilidades::isAdminValor()){
                    $agenda->cancelar($obj_cita->fecha, $obj_cita->hora, "no_disponible", $obj_cita->duracion);
                    Utilidades::enviarCorreo($usuario->email, "Cancelación", $orden_id, $obj_cita->monto, $cita_id, $obj_cita->fecha, $obj_cita->hora);
                }else{
                    $agenda->cancelar($obj_cita->fecha, $obj_cita->hora, "disponible ", $obj_cita->duracion);
                    Utilidades::enviarCorreoAdmin(email_admin, "Cancelación", $orden_id, $obj_cita->monto, $cita_id, $obj_cita->fecha, $obj_cita->hora,$usuario->nombre,$usuario->telefono, $usuario->email);
                }
                header("Location: " . base_url . 'Cita/mis_citas');
                ob_end_flush();
                
            }else{
                header("Location: " . base_url . 'Cita/mis_citas');
                ob_end_flush();
            }
            
        } else {
            header("Location: " . base_url . 'Cita/mis_citas');
            ob_end_flush();
        }

        require_once 'vistas/cita/detalle.php';
    }
 
}
