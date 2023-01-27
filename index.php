<?php
ob_start();
session_start();

//Se precargan todas las clases necesarias para el funcionamiento del proyecto
require_once 'autoload.php';
require_once 'config/database.php';
require_once 'config/parametros.php';
require_once 'helpers/utilidades.php';
require_once 'vistas/plantillas/header.php';
require_once 'vistas/plantillas/sidebar.php';

function show_error() {
    $error = new ErrorController;
    $error->index();
}

//Se utiliza  un controlador frontal que maneja las diferentes rutas ingresadas para acceder
//a los diferentes controladores y sus métodos.
if (isset($_GET['controlador'])) {
    $nombre_controlador = $_GET['controlador'] . "Controller";
} elseif (!isset($_GET['controlador']) && !isset($_GET['action'])) {
    $nombre_controlador = controlador_por_defecto;
    $controlador = new $nombre_controlador;
    $action_default = accion_por_defecto;
    $controlador->$action_default();
} else {
    show_error();
    exit();
}

if (@class_exists($_GET['controlador'] . 'Controller')) {
    $controlador = new $nombre_controlador;
    if (isset($_GET['action']) && method_exists($controlador, $_GET['action'])) {
        $action = $_GET['action'];
        $controlador->$action();
    }elseif (!isset($_GET['action'])) {     
        $action_default = accion_por_defecto;
        $controlador->$action_default();
    } else {
        show_error();
    }
}

require_once 'vistas/plantillas/footer.php';





