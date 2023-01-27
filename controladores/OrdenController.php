<?php

require_once 'modelos/Orden.php';
require_once 'modelos/Cita.php';
require_once 'modelos/Agenda.php';
require_once 'modelos/Usuario.php';

class OrdenController
{

    //Métetodo index que carga el formulario para creación de órdenes
    public function index()
    {
        $empty_servicios = false;
        $empty_productos = false;
        $empty_combos = false;

        if ((!isset($_SESSION['carrito_servicios']) ) && (!isset($_SESSION['carrito_combos']) ) && (!isset($_SESSION['carrito_productos']))) {
            header("Location:" . base_url . "Carrito/index");
            ob_end_flush();
            $_SESSION['carrito_vacio'] = "Debe agregar un servicio, combo o producto para realizar su orden";
        }

        if(!isset($_SESSION['carrito_servicios'])){
            $empty_servicios = true;
        }
        if(!isset($_SESSION['carrito_productos'])){
            $empty_productos = true;
        }
        if(!isset($_SESSION['carrito_combos'])){
            $empty_combos = true;
        }
        if(isset($_SESSION['carrito_servicios'])){    
            if(count($_SESSION['carrito_servicios']) == 0){
                $empty_servicios = true;
            }
        }
        if(isset($_SESSION['carrito_combos'])){
            if(count($_SESSION['carrito_combos']) == 0){
                $empty_combos = true;
            } 
        }
        if(isset($_SESSION['carrito_productos'])){
            if(count($_SESSION['carrito_productos']) == 0){
                $empty_productos = true;
            }
        }

        if ($empty_servicios && $empty_combos && $empty_productos) {
            $_SESSION['carrito_vacio'] = "Debe agregar un servicio, combo o producto para realizar su orden";
            header("Location:" . base_url . "Carrito/index");
            ob_end_flush();
            
        }
 
        if ($_SESSION['crear_cita']) {
            require_once 'vistas/orden/index.php';
        } else {
            require_once 'vistas/orden/create.php';
        }
   
    }

    //Crea un orden
    public function add()
    {
        if (isset($_POST) && isset($_SESSION['identity'])) {

            $usuario_id = $_SESSION['identity']->id;
            $provincia = isset($_POST['provincia']) ? $_POST['provincia'] : false;
            $canton = isset($_POST['canton']) ? $_POST['canton'] : false;
            $distrito = isset($_POST['distrito']) ? $_POST['distrito'] : false;
            $localidad = isset($_POST['localidad']) ? $_POST['localidad'] : false;
            $direccion = isset($_POST['direccion']) ? $_POST['direccion'] : false;

            $stats = Utilidades::statsCarrito();
            $coste = $stats['total'];
            $estado = '';

            // Array de errores 
            $errores = array();

            // Validar los datos antes de guardarlos en la base de datos.

            if (!empty($provincia) && !is_numeric($provincia) && !preg_match("/[0-9]/", $provincia)) {
                $_SESSION['loadprovincia'] = $provincia;
            } else {
                $errores['provincia'] = "La provincia no es válida.";
            }

            if (!empty($canton) && !is_numeric($canton) && !preg_match("/[0-9]/", $canton)) {
                $_SESSION['loadcanton'] = $canton;
            } else {
                $errores['canton'] = "El nombre del cantón no es válido.";
            }

            if (!empty($distrito) && !is_numeric($distrito) && !preg_match("/[0-9]/", $distrito)) {
                $_SESSION['loaddistrito'] = $distrito;
            } else {
                $errores['distrito'] = "El nombre del distrito no es válido.";
            }

            if (!empty($localidad) && !is_numeric($localidad) && !preg_match("/[0-9]/", $localidad)) {
                $_SESSION['loadlocalidad'] = $localidad;
            } else {
                $errores['localidad'] = "El nombre de la localidad no es válido.";
            }

            if (!empty($direccion)) {
                $_SESSION['loaddireccion'] = $direccion;
            } else {
                $errores['direccion'] = "La direccion no es válida.";
            }

            $save_cita = false;
            if (isset($_POST['usuario_id'])) {
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

                    if (isset($_GET['id'])) {
                        $id = $_GET['id'];
                        $cita->setId($id);
                        //$save_cita = $cita->edit();
                    } else {
                        $save_cita = $cita->save();
                    }
                    $cita_id = $cita->getCitaSave_Id();

                    //AGENDAR POR LA DURACION DE LA CITA

                    $numero_hora = Utilidades::obtenerHora($hora);

                    $agenda = new Agenda();
                    $suma_duracion_horas = $numero_hora - 1;
                    $am = true;

                    //$hora_columna = Utilidades::obtener_hora_columna($suma_duracion_horas);
                    if ($agenda->checkDisponibilidadAgenda2($suma_duracion_horas, $duracion, $fecha)) {
                        $_SESSION['regCita'] = "failed";
                        $errores['disponibilidad'] = "La hora seleccionada no cuenta con los campos requeridos en la agenda debido a su duración total.";
                        $_SESSION['erroresCita'] = $errores;
                        header('Location:' . base_url . "Orden/index");
                        ob_end_flush();
                    } else {

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

                            $update = $agenda->updateAgendaPorHora($hora_columna, $cita_id, $fecha);
                            if (!$update) {
                                $_SESSION['regCita'] = "failed";
                                header('Location:' . base_url . "Orden/index");
                                ob_end_flush();
                            }
                        }

                        if ($save_cita) {
                            $_SESSION['regProduct'] = "complete";
                            Utilidades::deleteSession('loadmonto');
                            Utilidades::deleteSession('loadhora');
                            Utilidades::deleteSession('loaddescripcion');
                            Utilidades::deleteSession('loadtelefono_1');
                            Utilidades::deleteSession('loadtelefono_2');
                            Utilidades::deleteSession('fecha_cita');
                        } else {
                            $_SESSION['regCita'] = "failed";
                            header('Location:' . base_url . "Orden/index");
                            ob_end_flush();
                        }
                    }
                } else {
                    $_SESSION['erroresCita'] = $errores;
                }
            }

            $guardar_orden = false;
            if (count($errores) == 0) {

                $orden = new Orden();
                $orden->setUsuario_id($usuario_id);
                $orden->setProvincia($provincia);
                $orden->setCanton($canton);
                $orden->setDistrito($distrito);
                $orden->setLocalidad($localidad);
                $orden->setDireccion($direccion);
                $orden->setCoste($coste);
                $orden->setEstado($estado);

                $save = false;
                $save = $orden->save();
                $orden_id = $orden->getOrdenSave_Id();

                //Guardar linea orden
                $save_linea = $orden->save_lineas_productos_servicios_combos();

                $save_linea_cita_orden = true;
                if ($save_cita) {
                    $save_linea_cita_orden = $orden->save_lineas_cita_orden($orden_id, $cita_id);

                    $email = $_SESSION['identity']->email;
                    Utilidades::enviarCorreo($email, "Cita", $orden_id, $monto, $cita_id, $fecha, $hora);
                }
                if ($save && $save_linea && $save_linea_cita_orden) {
                    $_SESSION['orden'] = "complete";
                    Utilidades::deleteSession('loadprovincia');
                    Utilidades::deleteSession('loadcanton');
                    Utilidades::deleteSession('loaddistrito');
                    Utilidades::deleteSession('loadlocalidad');
                    Utilidades::deleteSession('loaddireccion');

                    if (!$save_cita) {
                        $email = $_SESSION['identity']->email;
                        Utilidades::enviarCorreo($email, "Compra", $orden_id, $coste, "", "", "");
                    }
                    
                    header("Location: " . base_url . "Orden/confirmado");
                    ob_end_flush();
                } else {
                    $_SESSION['orden'] = "failed";
                }
            } else {
                $_SESSION['errores'] = $errores;
                $_SESSION['orden'] = "failed";
                header("Location: " . base_url . "Orden/index");
                ob_end_flush();
            }
        } else {
            $_SESSION['orden'] = "failed";
            header("Location: " . base_url . "Orden/index");
            ob_end_flush();
        }
    }

    //Muestra la pantalla que confirma la orden realizada
    public function confirmado()
    {
        if (isset($_SESSION['identity'])) {
            $id = $_SESSION['identity']->id;
            $orden = new Orden();
            $orden = $orden->getordenByUser($id);
            $ord = new Orden();
            $lista_productos = $ord->getProductosByorden($orden->id);
            $lista_servicios = $ord->getServiciosByorden($orden->id);
            $lista_combos = $ord->getCombosByorden($orden->id);
        }

        require_once 'vistas/orden/confirmado.php';
    }

    //Carga el listado de todas las ordenes realizadas por un cliente
    public function mis_ordenes()
    {
        Utilidades::isIdentity();
        $gestion = false;
        $ordenes = new Orden();
        $lista_ordenes = $ordenes->getordenesByUser($_SESSION['identity']->id);

        require_once 'vistas/orden/mis_ordenes.php';
    }

    //Muestra la información detallada de una orden
    public function detalle()
    {
        Utilidades::isIdentity();

        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $orden = new Orden();
            $orden = $orden->getorden($id)->fetch_object();
            $ord = new Orden();
            $lista_productos = $ord->getProductosByorden($orden->id);
            $lista_servicios = $ord->getServiciosByorden($orden->id);
            $lista_combos = $ord->getCombosByorden($orden->id);
        } else {
            header("Location: " . base_url . 'Orden/mis_ordenes');
            ob_end_flush();
        }

        require_once 'vistas/orden/detalle.php';
    }

    //Muestra la pantalla de gestión de ordenes
    public function gestion()
    {
        Utilidades::isAdmin();
        $gestion = true;
        $ordenes = new Orden();
        $lista_ordenes = $ordenes->getAll();

        require_once 'vistas/orden/mis_ordenes.php';
    }

    //Muestra el estado de una orden y envía un correo informando al cliente.
    public function estado()
    {
        Utilidades::isAdmin();
        if (isset($_POST)) {
            $orden = new Orden();
            $usuario = new Usuario();
            $cliente = $usuario->getUsuario($_POST['usuario_id'])->fetch_object();

            if($_POST['estado'] == "Enviada"){
                Utilidades::enviarCorreo($cliente->email, "Enviada", $_POST['orden_id'], $_POST['coste'], "", "", "");        
            }

            $cita = $orden->getCitaByorden($_POST['orden_id']);
            if(is_object($cita)){
                if($_POST['estado'] == "Procesada"){
                    Utilidades::enviarCorreo($cliente->email, "Procesada", $_POST['orden_id'], $cita->monto, $cita->id, $cita->fecha, $cita->hora);
                }
            }

            $orden->edit($_POST['orden_id'], $_POST['estado']);
            header("Location:" . base_url . "Orden/detalle&id={$_POST['orden_id']}");

            ob_end_flush();
        } else {
        }
    }
}
