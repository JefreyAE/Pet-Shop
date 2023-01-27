<?php

require_once 'modelos/Categoria.php';
require_once 'modelos/Producto.php';
require_once 'modelos/Servicio.php';

//Clase que se encarga de manejar los aspectos relacionados a las categorías
class CategoriaController {

    //Muestra la vista de categorías
    public function index() {
        Utilidades::isAdmin();
        $categoria = new Categoria();
        $categorias = $categoria->getAll();

        require_once 'vistas/categoria/index.php';
    }
    
    //Muestra y carga los productos y servicios relacionados a una categoría
    public function ver(){
        if(isset($_GET['id'])){
            $cat = new Categoria();
            $products = new Producto();
            $servicios = new Servicio();

            $categoria = $cat->getCategoria($_GET['id']);
            
            $listServicios = $servicios->getServiciosByCategoria($_GET['id']);
            $listProducts = $products->getProductsByCategoria($_GET['id']);
        }
        require_once('vistas/categoria/ver.php');
    }

    //Muestra la pantalla de creación de categorías
    public function create() {
        Utilidades::isAdmin();
        require_once 'vistas/categoria/create.php';
    }

    //Crea un categoría
    public function save() {
        Utilidades::isAdmin();
        
        //Guardar a categoria.
        if(isset($_POST) && isset($_POST['nombre'])){
            $categoria = new Categoria();
            $categoria->setNombre(trim($_POST['nombre']));
            $categoria->save();
        }
        
        header("Location:".base_url."Categoria/index");
        ob_end_flush();
    }

    //Borra una categoría
    public function delete() {
        Utilidades::isAdmin();

        if (isset($_GET['id'])) {
            $categoria = new Categoria();
            $categoria->setId($_GET['id']);
            $delete = $categoria->delete();
            if ($delete) {
                $_SESSION['delete'] = 'complete';
            } else {
                $_SESSION['delete'] = 'failed';
            }
        } else {
            $_SESSION['delete'] = 'failed';
        }
        header("Location:" . base_url . "Categoria/index");
        ob_end_flush();
    }

}
