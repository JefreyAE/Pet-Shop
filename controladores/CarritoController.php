<?php

//require_once 'modelos/Carrito.php';
require_once 'modelos/Producto.php';
require_once 'modelos/Servicio.php';
require_once 'modelos/Combo.php';
require_once 'modelos/Cita.php';
require_once 'modelos/Agenda.php';


//Clase Carrito controler que se encarga de administrar los aspectos relacionados al carrito de compras
//
class CarritoController
{
    //Index muestra el contenido del carrito
    public function index()
    {
        //Utilidades::deleteSession('carrito_servicio');  

        $_SESSION['crear_cita'] = false;
        $_SESSION['duracion_total'] = 0;
        
        if (isset($_SESSION['carrito_servicios']) && count($_SESSION['carrito_servicios']) >= 1){
            $_SESSION['crear_cita'] = true;
            //var_dump($_SESSION['carrito_servicios']);
            foreach($_SESSION['carrito_servicios'] as $servicio ){
                $_SESSION['duracion_total'] += ($servicio['servicio']->duracion)*($servicio['unidades']);
            }
        }
      
        if (isset($_SESSION['carrito_combos']) && count($_SESSION['carrito_combos']) >= 1){

            foreach($_SESSION['carrito_combos'] as $combo){

                $combo_id = $combo['id_combo'];

                $comb = new Combo();
                $tiene_servicios = $comb->checkServicios($combo_id);

                if($tiene_servicios){
                    $_SESSION['crear_cita'] = true;
                    $lista_servicios = $comb->getServiciosPorCombo($combo['id_combo']);
                    //var_dump($lista_servicios);
                    foreach($lista_servicios as $indice => $serv ){    
                        $_SESSION['duracion_total'] += $serv[6]*$serv[9];
                    }
                }                
            }
        }

        if($_SESSION['crear_cita']){
            $dias_disponibles = array();
            $agenda = new Agenda();

            $lista_dias_agendados = $agenda->getAgendaListadoActivas();
            while($dia = $lista_dias_agendados->fetch_object()){
                array_push($dias_disponibles, $dia->fecha);
            }
            $_SESSION['dias_disponibles'] = $dias_disponibles;
        }

        require_once 'vistas/carrito/index.php';
    }

    //Agrega un producto al carrito
    public function add_producto()
    {
        if (isset($_GET['id_producto'])) {
            if (isset($_GET['id_producto'])) {
                $producto_id = $_GET['id_producto'];
            } else {
                header("Location:" . base_url);
            }

            if (isset($_SESSION['carrito_productos'])) {
                $counter = 0;
                foreach ($_SESSION['carrito_productos'] as $indice => $elemento) {
                    if ($elemento['id_producto'] == $producto_id) {
                        $_SESSION['carrito_productos'][$indice]['unidades']++;
                        $counter++;
                    }
                }
            }
            if (!isset($counter) || $counter == 0) {
                $producto = new Producto();
                $producto = $producto->getProduct($producto_id)->fetch_object();
                if (is_object($producto)) {
                    $_SESSION['carrito_productos'][] = array(
                        "id_producto" => $producto->id,
                        "precio" => $producto->precio,
                        "unidades" => 1,
                        "producto" => $producto
                    );
                }
            }
        }
      
        header('Location:' . base_url . "Carrito/index");
        ob_end_flush();
    }

    //Agrega un servicio al carrito
    public function add_servicio(){
        if (isset($_GET['id_servicio'])) {
            if (isset($_GET['id_servicio'])) {
                $servicio_id = $_GET['id_servicio'];
            } else {
                header("Location:" . base_url);
                ob_end_flush();
            }

            if (isset($_SESSION['carrito_servicios'])) {
                $counter = 0;
                foreach ($_SESSION['carrito_servicios'] as $indice => $elemento) {
                    if ($elemento['id_servicio'] == $servicio_id) {
                        $_SESSION['carrito_servicios'][$indice]['unidades']++;
                        $counter++;
                    }
                }
            }
            if (!isset($counter) || $counter == 0) {
                $servicio = new Servicio();
                $servicio = $servicio->getServicio($servicio_id)->fetch_object();
                if (is_object($servicio)) {
                    $_SESSION['carrito_servicios'][] = array(
                        "id_servicio" => $servicio->id,
                        "precio" => $servicio->precio,
                        "unidades" => 1,
                        "servicio" => $servicio
                    );
                }
            }
        }
        header('Location:' . base_url . "Carrito/index");
        ob_end_flush();
    }

    //Agrega un combo al carrito
    public function add_combo(){
        if (isset($_GET['id_combo'])) {
            if (isset($_GET['id_combo'])) {
                $combo_id = $_GET['id_combo'];
            } else {
                header("Location:" . base_url);
                ob_end_flush();
            }

            if (isset($_SESSION['carrito_combos'])) {
                $counter = 0;
                foreach ($_SESSION['carrito_combos'] as $indice => $elemento) {
                    if ($elemento['id_combo'] == $combo_id) {
                        $_SESSION['carrito_combos'][$indice]['unidades']++;
                        $counter++;
                    }
                }
            }
            if (!isset($counter) || $counter == 0) {
                $combo = new Combo();
                $combo = $combo->getCombo($combo_id)->fetch_object();
                if (is_object($combo)) {
                    $_SESSION['carrito_combos'][] = array(
                        "id_combo" => $combo->id,
                        "precio" => $combo->precio,
                        "unidades" => 1,
                        "combo" => $combo
                    );
                }
            }
        }
        header('Location:' . base_url . "Carrito/index");
        ob_end_flush();
    }

    //Remueve un producto del carrito
    public function remove_producto(){
        if (isset($_SESSION['carrito_productos']) && isset($_GET['indice'])) {
            $indice = $_GET['indice'];
            unset($_SESSION['carrito_productos'][$indice]);
        }
        header('Location:' . base_url . "Carrito/index");
        ob_end_flush();
    }

    //Remueve un servicio del carrito
    public function remove_servicio(){
        if (isset($_SESSION['carrito_servicios']) && isset($_GET['indice'])) {
            $indice = $_GET['indice'];
            unset($_SESSION['carrito_servicios'][$indice]);
        }
        header('Location:' . base_url . "Carrito/index");
        ob_end_flush();
    }

    //Remueve un combo del carrito
    public function remove_combo()
    {
        if (isset($_SESSION['carrito_combos']) && isset($_GET['indice'])) {
            $indice = $_GET['indice'];
            unset($_SESSION['carrito_combos'][$indice]);
        }
        header('Location:' . base_url . "Carrito/index");
        ob_end_flush();
    }

    //Remueve el contenido de todo el carrito
    public function delete_all()
    {
        unset($_SESSION['carrito_productos']);
        unset($_SESSION['carrito_servicios']);
        unset($_SESSION['carrito_combos']);
        header('Location:' . base_url . "Carrito/index");
        ob_end_flush();
    }

    //Aumenta la cantidad de un producto en el carrito
    public function up_producto()
    {
        if (isset($_SESSION['carrito_productos']) && isset($_GET['indice'])) {
            $indice = $_GET['indice'];
            $_SESSION['carrito_productos'][$indice]['unidades']++;
        }
        header('Location:' . base_url . "Carrito/index");
        ob_end_flush();
    }

    //Aumenta la cantidad de un servicio en el carrito
    public function up_servicio()
    {
        if (isset($_SESSION['carrito_servicios']) && isset($_GET['indice'])) {
            $indice = $_GET['indice'];
            $_SESSION['carrito_servicios'][$indice]['unidades']++;
        }
        header('Location:' . base_url . "Carrito/index");
        ob_end_flush();
    }

    //Aumenta la cantidad de un combo en el carrito
    public function up_combo()
    {
        if (isset($_SESSION['carrito_combos']) && isset($_GET['indice'])) {
            $indice = $_GET['indice'];
            $_SESSION['carrito_combos'][$indice]['unidades']++;
        }
        header('Location:' . base_url . "Carrito/index");
        ob_end_flush();
    }

    //Reduce la cantidad de un producto en el carrito
    public function down_producto()
    {
        if (isset($_SESSION['carrito_productos']) && isset($_GET['indice'])) {
            $indice = $_GET['indice'];
            $_SESSION['carrito_productos'][$indice]['unidades']--;
            if ($_SESSION['carrito_productos'][$indice]['unidades'] == 0) {
                unset($_SESSION['carrito_productos'][$indice]);
            }
        }
        header('Location:' . base_url . "Carrito/index");
        ob_end_flush();
    }

    //Reduce la cantidad de un servicio en el carrito
    public function down_servicio()
    {
        if (isset($_SESSION['carrito_servicios']) && isset($_GET['indice'])) {
            $indice = $_GET['indice'];
            $_SESSION['carrito_servicios'][$indice]['unidades']--;
            if ($_SESSION['carrito_servicios'][$indice]['unidades'] == 0) {
                unset($_SESSION['carrito_servicios'][$indice]);
            }
        }
        header('Location:' . base_url . "Carrito/index");
        ob_end_flush();
    }

    //Reduce la cantidad de un combo en el carrito
    public function down_combo()
    {
        if (isset($_SESSION['carrito_combos']) && isset($_GET['indice'])) {
            $indice = $_GET['indice'];
            $_SESSION['carrito_combos'][$indice]['unidades']--;
            if ($_SESSION['carrito_combos'][$indice]['unidades'] == 0) {
                unset($_SESSION['carrito_combos'][$indice]);
            }
        }
        header('Location:' . base_url . "Carrito/index");
        ob_end_flush();
    }

    
}
