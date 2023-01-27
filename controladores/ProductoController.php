<?php

require_once 'modelos/Producto.php';

class ProductoController {

    private $edit = false;

    //Carga la página de inicio con los productos
    public function index() {
        
        $products = new Producto();
        $list = $products->getRandom(6);
        // renderizar vista        
        require_once 'vistas/producto/destacados.php';
    }
    
    //Muestra el detalle de un producto
    public function ver(){
        if(isset($_GET['id'])){
            $product = new Producto();
            $producto = $product->getProduct($_GET['id'])->fetch_object();         
        }
    
        require_once 'vistas/producto/ver.php';
    }

    //Muestra la pantalla de gestión de productos
    public function gestion() {
        Utilidades::isAdmin();

        if (isset($_SESSION['idProduct'])) {
            Utilidades::deleteSession('idProduct');
        }

        $producto = new Producto();
        $productos = $producto->getAll();

        require_once 'vistas/producto/gestion.php';
    }

    //Muestra la pantalla de creación de productos
    public function create() {
        Utilidades::isAdmin();
        require_once 'vistas/producto/create.php';
    }

    //Crea un nuevo producto
    public function save() {

        if (isset($_POST)) {
            //var_dump($_POST);
            //die();
            $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : false;
            $categoria = isset($_POST['categoria']) ? $_POST['categoria'] : false;
            $descripcion = isset($_POST['descripcion']) ? $_POST['descripcion'] : false;
            $precio = isset($_POST['precio']) ? $_POST['precio'] : false;
            $stock = isset($_POST['stock']) ? $_POST['stock'] : false;
            $oferta = isset($_POST['oferta']) ? $_POST['oferta'] : false;
            $imagen = isset($_POST['imagen']) ? $_POST['imagen'] : false;
            // Array de errores 
            $errores = Array();

            // Validar los datos antes de guardarlos en la base de datos.
            // Validar campo nombre
            //if (!empty($nombre) && !is_numeric($nombre) && !preg_match("/[0-9]/", $nombre)) {
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

            if (!empty($stock) && is_numeric($stock)) {
                $_SESSION['loadstock'] = $stock;
            } else {
                $errores['stock'] = "El stock no es válido.";
            }

            // Validar apellidos
      
            if (!empty($oferta) || $oferta == '0') {
                $_SESSION['loadoferta'] = $oferta;
            } else {
                $errores['oferta'] = "Los oferta no es válida.";
            }

            $guardar_usuario = false;

            if (count($errores) == 0) {
                $producto = new Producto();
                $producto->setNombre($nombre);
                $producto->setCategoria_id($categoria);
                $producto->setDescripcion($descripcion);
                $producto->setPrecio($precio);
                $producto->setStock($stock);
                $producto->setOferta($oferta);

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
                        $producto->setImagen($filename);
                    }
                }
                
                if(isset($_GET['id'])){
                    $id = $_GET['id'];
                    $producto->setId($id);
                    $save = $producto->edit();
                }else{
                    $save = $producto->save();
                }
                
                if ($save) {
                    $_SESSION['regProduct'] = "complete";
                    Utilidades::deleteSession('loadname');
                    Utilidades::deleteSession('loadcategoria');
                    Utilidades::deleteSession('loaddescripcion');
                    Utilidades::deleteSession('loadprecio');
                    Utilidades::deleteSession('loadstock');
                    Utilidades::deleteSession('loadoferta');
                } else {
                    $_SESSION['regProduct'] = "failed";
                }

            } else {
                $_SESSION['erroresProducto'] = $errores;
            }
        } else {
            $_SESSION['regProduct'] = "failed";
        }

        header("Location: " . base_url . "Producto/create");
        ob_end_flush();
    }
   

    //Edita un producto existente
    public function edit() {
        Utilidades::isAdmin();

        if (isset($_GET['id']) && is_numeric($_GET['id'])) {
            $edit = true;
            $_SESSION['idProduct'] = $_GET['id'];
            require_once 'vistas/producto/create.php';
        } else {
            Utilidades::deleteSession('idProduct');
            header("Location:" . base_url . "Producto/gestion");
            ob_end_flush();
        }
    }

    //Borra un producto
    public function delete() {
        Utilidades::isAdmin();

        if (isset($_GET['id'])) {
            $producto = new Producto();
            $producto->setId($_GET['id']);
            $delete = $producto->delete();

            if ($delete) {
                $_SESSION['delete'] = 'complete';
            } else {
                $_SESSION['delete'] = 'failed';
            }
        } else {
            $_SESSION['delete'] = 'failed';
        }
        header("Location:" . base_url . "Producto/gestion");
        ob_end_flush();
    }

}
