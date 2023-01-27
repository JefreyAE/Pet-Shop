<?php

require_once 'modelos/Servicio.php';

class ServicioController {

    private $edit = false;

    //Obtiene la lista de servicios pra mostrarla
    public function index() {
        
        $servicios = new Servicio();
        $list = $servicios->getRandom(6);
        // renderizar vista        
        require_once 'vistas/servicio/destacados.php';
    }
    
    //Muestra el detalle de un servicio
    public function ver(){
        if(isset($_GET['id'])){
            $service = new Servicio();
            $servicio = $service->getServicio($_GET['id'])->fetch_object();         
        }
    
        require_once 'vistas/servicio/ver.php';
    }

    //Muestra la página de gestión de servicios
    public function gestion() {
        Utilidades::isAdmin();

        if (isset($_SESSION['idServicio'])) {
            Utilidades::deleteSession('idServicio');
        }

        $servicio = new Servicio();
        $servicios = $servicio->getAll();

        require_once 'vistas/servicio/gestion.php';
    }

    //Muestra la pantalla de creación de servicios
    public function create() {
        Utilidades::isAdmin();
        require_once 'vistas/servicio/create.php';
    }

    //Guarda o crea un servicio
    public function save() {

        if (isset($_POST)) {
            //var_dump($_POST);
            //die();
            $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : false;
            $categoria = isset($_POST['categoria']) ? $_POST['categoria'] : false;
            $descripcion = isset($_POST['descripcion']) ? $_POST['descripcion'] : false;
            $precio = isset($_POST['precio']) ? $_POST['precio'] : false;
            $duracion = isset($_POST['duracion']) ? $_POST['duracion'] : false;
            $oferta = isset($_POST['oferta']) ? $_POST['oferta'] : false;
            $imagen = isset($_POST['imagen']) ? $_POST['imagen'] : false;
            // Array de errores 
            $errores = Array();

            // Validar los datos antes de guardarlos en la base de datos.
            // Validar campo nombre
            if (!empty($nombre) && !is_numeric($nombre)) {
                $_SESSION['loadname'] = $nombre;
            } else {
                $errores['nombre'] = "El nombre no es válido.";
            }

            // Validar apellidos
            if (!empty($categoria)) {
                $_SESSION['loadcategoria'] = $categoria;
            } else {
                $errores['categoria'] = "Los categoria no es válida.";
            }

            if (!empty($descripcion)) {
                $_SESSION['loaddescripcion'] = $descripcion;
            } else {
                $errores['descripcion'] = "La descripción no es válida.";
            }

            if (!empty($precio) && is_numeric($precio)) {
                $_SESSION['loadprecio'] = $precio;
            } else {
                $errores['precio'] = "El precio no es válido.";
            }

            if (!empty($duracion) && is_numeric($duracion)) {
                $_SESSION['loadduracion'] = $duracion;
            } else {
                $errores['duracion'] = "La duración no es válido.";
            }

            // Validar apellidos
            if (!empty($oferta) || $oferta == '0') {
                $_SESSION['loadoferta'] = $oferta;
            } else {
                $errores['oferta'] = "Los oferta no es válida.";
            }


            $guardar_usuario = false;

            if (count($errores) == 0) {
                $servicio = new Servicio();
                $servicio->setNombre($nombre);
                $servicio->setCategoria_id($categoria);
                $servicio->setDescripcion($descripcion);
                $servicio->setPrecio($precio);
                $servicio->setDuracion($duracion);
                $servicio->setOferta($oferta);

                // Guardar la imagen.
                if (isset($_FILES['imagen'])) {
                    $file = $_FILES['imagen'];
                    $filename = $file['name'];
                    $mimetype = $file['type'];

                    //var_dump($file);
                    //die();

                    if ($mimetype == 'image/jpg' || $mimetype == 'image/jpeg' || $mimetype == 'image/png' || $mimetype == 'image/gif') {
                        if (!is_dir("uploads/imagenes")) {
                            mkdir("uploads/imagenes/", 0777, true);
                        }

                        move_uploaded_file($file['tmp_name'], 'uploads/imagenes/' . $filename);
                        $servicio->setImagen($filename);
                    }
                }
                
                if(isset($_GET['id'])){
                    $id = $_GET['id'];
                    $servicio->setId($id);
                    $save = $servicio->edit();
                }else{
                    $save = $servicio->save();
                }
                
                if ($save) {
                    $_SESSION['regServicio'] = "complete";
                    Utilidades::deleteSession('loadname');
                    Utilidades::deleteSession('loadcategoria');
                    Utilidades::deleteSession('loaddescripcion');
                    Utilidades::deleteSession('loadprecio');
                    Utilidades::deleteSession('loadduracion');
                    Utilidades::deleteSession('loadoferta');
                } else {
                    $_SESSION['regServicio'] = "failed";
                }

            } else {
                $_SESSION['erroresServicio'] = $errores;
            }
        } else {
            $_SESSION['regServicio'] = "failed";
        }

        header("Location: " . base_url . "Servicio/create");
        ob_end_flush();
    }
   

    //Modifica un servicio existente
    public function edit() {
        Utilidades::isAdmin();

        if (isset($_GET['id']) && is_numeric($_GET['id'])) {
            $edit = true;
            $_SESSION['idServicio'] = $_GET['id'];
            require_once 'vistas/servicio/create.php';
        } else {
            Utilidades::deleteSession('idServicio');
            header("Location:" . base_url . "Servicio/gestion");
            ob_end_flush();
        }
    }

    //Borra un servicio
    public function delete() {
        Utilidades::isAdmin();

        if (isset($_GET['id'])) {
            $servicio = new Servicio();
            $servicio->setId($_GET['id']);
            $delete = $servicio->delete();
            if ($delete) {
                $_SESSION['delete'] = 'complete';
            } else {
                $_SESSION['delete'] = 'failed';
            }
        } else {
            $_SESSION['delete'] = 'failed';
        }
        header("Location:" . base_url . "Servicio/gestion");
        ob_end_flush();
    }

}
