<?php

require_once 'modelos/Combo.php';
require_once 'modelos/Producto.php';
require_once 'modelos/Servicio.php';

//Controlador de los aspectos relacionados a los combos, vistas y métodos.
class ComboController {

    private $edit = false;

    //Obtiene una lista aleatoria de combos para mostrar.
    public function index() {
        
        $combos = new Combo();
        $list = $combos->getRandom(6);
        // renderizar vista        
        require_once 'vistas/combo/destacados.php';
    }
    
    //Solicita la información relacionada a un combo y la muestra en la vista.
    public function ver(){
        if(isset($_GET['id'])){
            $comb = new Combo();
            $combo = $comb->getCombo($_GET['id'])->fetch_object();   
            
            
            Utilidades::deleteSession('combo_productos');
            Utilidades::deleteSession('combo_servicios');

            if (isset($_GET['id']) && is_numeric($_GET['id'])) {
                $edit = true;
                $_SESSION['idCombo'] = $_GET['id'];
    
                $lista_servicios = $comb->getServiciosPorCombo($_GET['id']);
                $lista_productos = $comb->getProductosPorCombo($_GET['id']);
    
                if (!isset($_SESSION['combo_servicios']) && $lista_servicios != false) {
                    foreach($lista_servicios as $indice => $serv ){ 
            
                        $servicio = new Servicio();
                        $servicio = $servicio->getServicio($serv[0])->fetch_object();
                        if (is_object($servicio)) {
                           
                            $_SESSION['combo_servicios'][] = array(
                                "id_servicio" => $servicio->id,
                                "precio" => $servicio->precio,
                                "unidades" => $serv[9],
                                "servicio" => $servicio
                            );
                        }
                    }
                }
                if (!isset($_SESSION['combo_productos']) && $lista_productos != false) {
                    foreach($lista_productos as $indice => $prod ){    
                        $producto = new Producto();
                        $producto = $producto->getProduct($prod[0])->fetch_object();
                        if (is_object($producto)) {
                            $_SESSION['combo_productos'][] = array(
                                "id_producto" => $prod[0],
                                "precio" => $prod[4],
                                "unidades" => $prod[9],
                                "producto" => $producto
                            );
                        }
                    }
                }
            }
        }
        require_once 'vistas/combo/ver.php';
    }

    //Carga la lista de combos registrados.
    public function ver_combos(){

        $combo = new Combo();
        $listCombos = $combo->getAll();

        require_once 'vistas/combo/ver_combos.php';
    }

    //Carga la lista de todos los combos registrados y los muestra en la vista.
    public function gestion() {
        Utilidades::isAdmin();

        if (isset($_SESSION['idCombo'])) {
            Utilidades::deleteSession('idCombo');
        }

        $combo = new Combo();
        $combos = $combo->getAll();

        Utilidades::deleteSession('combo_servicios');
        Utilidades::deleteSession('combo_productos');
        require_once 'vistas/combo/gestion.php';
    }

    //Agrega un producto al combo durante su creación.
    public function agregar_producto() {
        Utilidades::isAdmin();
        if (isset($_GET['id'])) {
            $producto_id = $_GET['id'];
        } else {
            header("Location:" . base_url);
            ob_end_flush();
        }

        if (isset($_SESSION['combo_productos'])) {
            $counter_productos = 0;
            foreach ($_SESSION['combo_productos'] as $indice => $elemento) {
                if ($elemento['id_producto'] == $producto_id) {
                    $_SESSION['combo_productos'][$indice]['unidades']++;
                    $counter_productos++;
                }
            }
        }
        if (!isset($counter_productos) || $counter_productos == 0) {
            $producto = new Producto();
            $producto = $producto->getProduct($producto_id)->fetch_object();
            if (is_object($producto)) {
                $_SESSION['combo_productos'][] = array(
                    "id_producto" => $producto->id,
                    "precio" => $producto->precio,
                    "unidades" => 1,
                    "producto" => $producto
                );
            }
        }

        //var_dump($_SESSION['combo_productos']);
        //die();
        
        $this->create();
    }

    //Agrega un servicio al combo durante su creación.
    public function agregar_servicio() {
        Utilidades::isAdmin();
        if (isset($_GET['id'])) {
            $servicio_id = $_GET['id'];
        } else {
            header("Location:" . base_url);
            ob_end_flush();
        }

        if (isset($_SESSION['combo_servicios'])) {
            $counter_servicios = 0;
            foreach ($_SESSION['combo_servicios'] as $indice => $elemento) {
                if ($elemento['id_servicio'] == $servicio_id) {
                    $_SESSION['combo_servicios'][$indice]['unidades']++;
                    $counter_servicios++;
                }
            }
        }
        if (!isset($counter_servicios) || $counter_servicios == 0) {
            $servicio = new Servicio();
            $servicio = $servicio->getServicio($servicio_id)->fetch_object();
            if (is_object($servicio)) {
                $_SESSION['combo_servicios'][] = array(
                    "id_servicio" => $servicio->id,
                    "precio" => $servicio->precio,
                    "unidades" => 1,
                    "servicio" => $servicio
                );
            }
        }
        
        $this->create();
    }

    //Remueve un producto del combo durante su creación
    public function remove_producto() {
        if(isset($_SESSION['combo_productos']) && isset($_GET['indice'])){
            $indice = $_GET['indice'];
            unset($_SESSION['combo_productos'][$indice]);
        }
        $this->create();
    }

    //Remueve todos los productos del combo durante su creación.
    public function delete_all_productos() {
        unset($_SESSION['combo_productos']);
        $this->create();
    }
    
    //Aumenta la cantidad de un producto en el combo durante su creación.
    public function up_producto(){
        if(isset($_SESSION['combo_productos']) && isset($_GET['indice'])){
            $indice = $_GET['indice'];
            $_SESSION['combo_productos'][$indice]['unidades']++;
        }
        $this->create();
    }

    //Reduce la cantidad de un producto en el combo durante su creación.
    public function down_producto(){
        if(isset($_SESSION['combo_productos']) && isset($_GET['indice'])){
            $indice = $_GET['indice'];
            $_SESSION['combo_productos'][$indice]['unidades']--;
            if($_SESSION['combo_productos'][$indice]['unidades']==0){
                unset($_SESSION['combo_productos'][$indice]);
            }
        }
        $this->create();
    }

    //Remueve un producto del combo durante su creación.
    public function remove_servicio() {
        if(isset($_SESSION['combo_servicios']) && isset($_GET['indice'])){
            $indice = $_GET['indice'];
            unset($_SESSION['combo_servicios'][$indice]);
        }
        $this->create();
    }

    //Remueve todos los servicios del combo durante su creación.
    public function delete_all_servicios() {
        unset($_SESSION['combo_servicios']);
        $this->create();
    }
    
    //Aumenta la cantidad de un servicio en el combo durante su creación.
    public function up_servicio(){
        if(isset($_SESSION['combo_servicios']) && isset($_GET['indice'])){
            $indice = $_GET['indice'];
            $_SESSION['combo_servicios'][$indice]['unidades']++;
        }
        $this->create();
    }
    
    //Reduce la cantidad de un producto en el combo durante su creación.
    public function down_servicio(){
        if(isset($_SESSION['combo_servicios']) && isset($_GET['indice'])){
            $indice = $_GET['indice'];
            $_SESSION['combo_servicios'][$indice]['unidades']--;
            if($_SESSION['combo_servicios'][$indice]['unidades']==0){
                unset($_SESSION['combo_servicios'][$indice]);
            }
        }
        $this->create();
    }

    //Muestra la página de creación de combos, cargando los productos y servicos existentes.
    public function create() {
        Utilidades::isAdmin();

        if (isset($_SESSION['idProduct'])) {
            Utilidades::deleteSession('idProduct');
        }

        $producto = new Producto();
        $productos = $producto->getAll();

        if (isset($_SESSION['idServicio'])) {
            Utilidades::deleteSession('idServicio');
        }

        $servicio = new Servicio();
        $servicios = $servicio->getAll();

        require_once 'vistas/combo/create.php';
    }

    //Valida la infomación y crea un combo
    public function save() {

        if (isset($_POST)) {

            $empty_servicios = false;
            $empty_productos = false;

            if(!isset($_SESSION['combo_servicios'])){
                $empty_servicios = true;
            }
            if(!isset($_SESSION['combo_productos'])){
                $empty_productos = true;
            }

            if(isset($_SESSION['combo_servicios'])){    
                if(count($_SESSION['combo_servicios']) == 0){
                    $empty_servicios = true;
                }
            }
            if(isset($_SESSION['combo_productos'])){
                if(count($_SESSION['combo_productos']) == 0){
                    $empty_productos = true;
                }
            }

            if ($empty_servicios && $empty_productos) {
                header("Location:" . base_url . "Combo/create");
                ob_end_flush();
                $_SESSION['combo_vacio'] = "Debe agregar un servicio o producto al crear un combo.";
                die();
            }

            //var_dump($_POST);
            //die();
            $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : false;
            $descripcion = isset($_POST['descripcion']) ? $_POST['descripcion'] : false;
            $precio = isset($_POST['precio']) ? $_POST['precio'] : false;
            $oferta = isset($_POST['oferta']) ? $_POST['oferta'] : false;
            $imagen = isset($_POST['imagen']) ? $_POST['imagen'] : false;
            // Array de errores 
            $errores = Array();

            // Validar los datos antes de guardarlos en la base de datos.
            // Validar campo nombre

            //if (!empty($nombre) && !is_numeric($nombre) && !preg_match("/[0-9]/", $nombre)) {
            if (!empty($nombre) && !is_numeric($nombre) ) {
                $_SESSION['loadname'] = $nombre;
            } else {
                $errores['nombre'] = "El nombre no es válido.";
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

            if (!empty($oferta) || $oferta == '0') {
                $_SESSION['loadoferta'] = $oferta;
            } else {
                $errores['oferta'] = "Los oferta no es válida.";
            }

            $guardar_usuario = false;

            if (count($errores) == 0) {
                $combo = new Combo();
                $combo->setNombre($nombre);
                $combo->setDescripcion($descripcion);
                $combo->setPrecio($precio);
                $combo->setOferta($oferta);

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
                        $combo->setImagen($filename);
                    }
                }

                if(isset( $_SESSION['idCombo'])){
                    $id =  $_SESSION['idCombo'];
                    $combo->setId($id);
                    $save = $combo->edit();
                    if(isset($_SESSION['combo_servicios'])){
                        $save_servicios = $combo->save_linea_combo_servicios($_SESSION['combo_servicios'], $id);    
                    }
                    if(isset($_SESSION['combo_productos'])){
                        if(isset($save_servicios)){
                            $save_productos = $combo->save_linea_combo_productos($_SESSION['combo_productos'], $save_servicios);
                        }else{   
                            $save_productos = $combo->save_linea_combo_productos($_SESSION['combo_productos'], false);
                        }
                    }
                }else{
                    $save = $combo->save();
                    if(isset($_SESSION['combo_servicios'])){
                        $save_servicios = $combo->save_linea_combo_servicios($_SESSION['combo_servicios'], false);    
                    }
                    if(isset($_SESSION['combo_productos'])){
                        if(isset($save_servicios)){
                            $save_productos = $combo->save_linea_combo_productos($_SESSION['combo_productos'], $save_servicios);
                        }else{   
                            $save_productos = $combo->save_linea_combo_productos($_SESSION['combo_productos'], false);
                        }
                    }
                }

               
                
                if (isset($save_servicios) && !isset( $_SESSION['idCombo'])) {   
                    Utilidades::deleteSession('combo_servicios');   
                } 
                if (isset($save_productos) && !isset( $_SESSION['idCombo'])) {   
                    Utilidades::deleteSession('combo_productos');   
                } 

                if ($save) {
                    $_SESSION['regCombo'] = "complete";
                    Utilidades::deleteSession('loadname');
                    Utilidades::deleteSession('loaddescripcion');
                    Utilidades::deleteSession('loadprecio');
                    Utilidades::deleteSession('loadoferta');
                } else {
                    $_SESSION['regCombo'] = "failed";
                }

            } else {
                $_SESSION['erroresCombo'] = $errores;
            }
        } else {
            $_SESSION['regCombo'] = "failed";
        }

        header("Location: " . base_url . "Combo/create");
        ob_end_flush();
    }

    //Actualiza la información asociada a un combo
    public function update() {

        if (isset($_POST)) {
            //var_dump($_POST);
            //die();
            $imagen = isset($_POST['id']) ? $_POST['id'] : false;
            $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : false;
            $descripcion = isset($_POST['descripcion']) ? $_POST['descripcion'] : false;
            $precio = isset($_POST['precio']) ? $_POST['precio'] : false;
            $oferta = isset($_POST['oferta']) ? $_POST['oferta'] : false;
            $imagen = isset($_POST['imagen']) ? $_POST['imagen'] : false;
            // Array de errores 
            $errores = Array();

            // Validar los datos antes de guardarlos en la base de datos.
            // Validar campo nombre

            if (!empty($id) && is_numeric($id)) {
                $_SESSION['loadid'] = $id;
            } else {
                $errores['id'] = "El id no es válido.";
            }
            if (!empty($nombre) && !is_numeric($nombre) && !preg_match("/[a-zA-Z0-9]/", $nombre)) {
                $_SESSION['loadname'] = $nombre;
            } else {
                $errores['nombre'] = "El nombre no es válido.";
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

            if (!empty($oferta)) {
                $_SESSION['loadoferta'] = $oferta;
            } else {
                $errores['oferta'] = "Los oferta no es válida.";
            }

            $guardar_usuario = false;

            if (count($errores) == 0) {
                $combo = new Combo();
                $combo->setNombre($nombre);
                $combo->setDescripcion($descripcion);
                $combo->setPrecio($precio);
                $combo->setOferta($oferta);

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
                        $combo->setImagen($filename);
                    }
                }

                $combo->setId($_POST['id']);
                $save = $combo->edit();
               
                
                if ($save) {
                    $_SESSION['regCombo'] = "complete";
                    Utilidades::deleteSession('loadname');
                    Utilidades::deleteSession('loaddescripcion');
                    Utilidades::deleteSession('loadprecio');
                    Utilidades::deleteSession('loadoferta');
                } else {
                    $_SESSION['regCombo'] = "failed";
                }

            } else {
                $_SESSION['erroresCombo'] = $errores;
            }
        } else {
            $_SESSION['regCombo'] = "failed";
        }

        header("Location: " . base_url . "Combo/create");
        ob_end_flush();
    }
   
    //Carga los datos y muestra formulario de actualización de un combo
    public function edit() {
        Utilidades::isAdmin();

        if (isset($_SESSION['idProduct'])) {
            Utilidades::deleteSession('idProduct');
        }

        $producto = new Producto();
        $productos = $producto->getAll();

        if (isset($_SESSION['idServicio'])) {
            Utilidades::deleteSession('idServicio');
        }

        $servicio = new Servicio();
        $servicios = $servicio->getAll();

        if (isset($_GET['id']) && is_numeric($_GET['id'])) {
            $edit = true;
            $_SESSION['idCombo'] = $_GET['id'];

            $combo = new Combo();
           
            $lista_servicios = $combo->getServiciosPorCombo($_GET['id']);
            $lista_productos = $combo->getProductosPorCombo($_GET['id']);

            if (!isset($_SESSION['combo_servicios']) && $lista_servicios != false) {
                foreach($lista_servicios as $indice => $serv ){ 
        
                    $servicio = new Servicio();
                    $servicio = $servicio->getServicio($serv[0])->fetch_object();
                    if (is_object($servicio)) {
                       
                        $_SESSION['combo_servicios'][] = array(
                            "id_servicio" => $servicio->id,
                            "precio" => $servicio->precio,
                            "unidades" => $serv[9],
                            "servicio" => $servicio
                        );
                    }
                }
            }
            if (!isset($_SESSION['combo_productos']) && $lista_productos != false) {
                foreach($lista_productos as $indice => $prod ){    
                    $producto = new Producto();
                    $producto = $producto->getProduct($prod[0])->fetch_object();
                    if (is_object($producto)) {
                        $_SESSION['combo_productos'][] = array(
                            "id_producto" => $prod[0],
                            "precio" => $prod[4],
                            "unidades" => $prod[9],
                            "producto" => $producto
                        );
                    }
                }
            }
            
            require_once 'vistas/combo/create.php';
        } else {
            Utilidades::deleteSession('idCombo');
            header("Location:" . base_url . "Combo/gestion");
            ob_end_flush();
        }
    }

    //Borra un combo
    public function delete() {
        Utilidades::isAdmin();

        if (isset($_GET['id'])) {
            $combo = new Combo();
            $combo->setId($_GET['id']);
            $delete = $combo->delete();
            if ($delete) {
                $_SESSION['delete'] = 'complete';
            } else {
                $_SESSION['delete'] = 'failed';
            }
        } else {
            $_SESSION['delete'] = 'failed';
        }
        header("Location:" . base_url . "Combo/gestion");
        ob_end_flush();
    }

}
