<?php

class Utilidades
{
    //La clase utilidades es un "Helper" o ayudador con multiples funciones útiles
    //que se usan en todas las capas de la aplicación

    //Borra cualquier variable de sesión
    public static function deleteSession($name)
    {
        if (isset($_SESSION[$name])) {
            $_SESSION[$name] = null;
            unset($_SESSION[$name]);

        }
        return $name;
    }

    //Muestra mensajes de error como HTML
    public static function showError($errores, $campo)
    {
        $alerta = '';
        if (isset($errores[$campo]) && !empty($campo)) {
            $alerta = "<div class='alert alert-error'>" . $errores[$campo] . "</div>";
        }
        return $alerta;
    }

    //Borra los errores almacenados en sesiones
    public static function deleteError()
    {
        if (isset($_SESSION['errores'])) {
            $_SESSION['errores'] = null;
            unset($_SESSION['errores']);
            $borrado = true;
        }

        if (isset($_SESSION['erroresProducto'])) {
            $_SESSION['erroresProducto'] = null;
            unset($_SESSION['erroresProducto']);
            $borrado = true;
        }
        if (isset($_SESSION['erroresCombo'])) {
            $_SESSION['erroresCombo'] = null;
            unset($_SESSION['erroresCombo']);
            $borrado = true;
        }
        if (isset($_SESSION['erroresServicio'])) {
            $_SESSION['erroresServicio'] = null;
            unset($_SESSION['erroresServicio']);
            $borrado = true;
        }
    }

    //Valida que el usuario es administrador
    public static function isAdmin()
    {

        if (!isset($_SESSION['admin'])) {
            header("Location:" . base_url);
        } else {
            return true;
        }
    }

    //Devuelve un boleano si el usuario es administrador o no
    public static function isAdminValor()
    {
        if (!isset($_SESSION['admin'])) {
            return false;
        } else {
            return true;
        }
    }

    //Valida que el usuario se encuentra registrado y logueado
    public static function isIdentity()
    {

        if (!isset($_SESSION['identity'])) {
            header("Location:" . base_url);
        } else {
            return true;
        }
    }

    //Devuelve un boleano si el usuario se encuentra logueado
    public static function isIdentityValor()
    {

        if (!isset($_SESSION['identity'])) {
            return false;
        } else {
            return true;
        }
    }

    //Carga las categorías
    public static function showCategorias()
    {
        require_once 'modelos/Categoria.php';
        $categoria = new Categoria();
        $categorias = $categoria->getAll();
        return $categorias;
    }

    //Carga los productos
    public static function showProducto($id)
    {
        require_once 'modelos/Producto.php';
        $producto = new Producto();
        $producto = $producto->getProduct($id);
        return $producto;
    }

    //Carga la agenda
    public static function showAgenda($id)
    {
        require_once 'modelos/Agenda.php';
        $agenda = new Agenda();
        $agenda = $agenda->getAgendaPorId($id);
        return $agenda;
    }

    //Carga los combos
    public static function showCombo($id)
    {
        require_once 'modelos/Combo.php';
        $combo = new Combo();
        $combo = $combo->getCombo($id);
        return $combo;
    }

    //Carga los servicios
    public static function showServicio($id)
    {
        require_once 'modelos/Servicio.php';
        $servicio = new Servicio();
        $servicio = $servicio->getServicio($id);
        return $servicio;
    }

    //Carga y calcula los valores almacenados en el carrito
    public static function statsCarrito()
    {
        $stats = array(
            'count' => 0,
            'total' => 0
        );

        if (isset($_SESSION['carrito_productos'])) {
            foreach ($_SESSION['carrito_productos'] as $elemento) {
                $stats['count'] += $elemento['unidades'];
                $stats['total'] += $elemento['unidades'] * $elemento['producto']->precio;
            }
        }
        if (isset($_SESSION['carrito_servicios'])) {
            foreach ($_SESSION['carrito_servicios'] as $elemento) {
                $stats['count'] += $elemento['unidades'];
                $stats['total'] += $elemento['unidades'] * $elemento['servicio']->precio;
            }
        }
        if (isset($_SESSION['carrito_combos'])) {
            foreach ($_SESSION['carrito_combos'] as $elemento) {
                $stats['count'] += $elemento['unidades'];
                $stats['total'] += $elemento['unidades'] * $elemento['combo']->precio;
            }
        }

        return $stats;
    }

    //Carga los productos agregados al combo
    public static function statsProductosAgregados()
    {
        $stats = array(
            'count' => 0,
            'total' => 0
        );

        if (isset($_SESSION['combo_productos'])) {
            foreach ($_SESSION['combo_productos'] as $elemento) {
                $stats['count'] += $elemento['unidades'];
                $stats['total'] += $elemento['unidades'] * $elemento['producto']->precio;
            }
        }

        return $stats;
    }

    //Carga los servicios agregados al combo
    public static function statsServiciosAgregados()
    {
        $stats = array(
            'count' => 0,
            'total' => 0
        );

        if (isset($_SESSION['combo_servicios'])) {
            foreach ($_SESSION['combo_servicios'] as $elemento) {
                $stats['count'] += $elemento['unidades'];
                $stats['total'] += $elemento['unidades'] * $elemento['servicio']->precio;
            }
        }

        return $stats;
    }

    //Carga el estatus de las ordenes
    public static function showStatus($status)
    {
        $value = 'Pendiente';
        if ($status == 'Confirmada') {
            $value = 'Pendiente';
        } elseif ($status == 'Preparación') {
            $value = 'En preparación';
        } elseif ($status == 'Lista') {
            $value = 'Preparado para enviar';
        } elseif ($status == 'Enviada') {
            $value = 'Enviada';
        }elseif ($status == 'Cancelada') {
            $value = 'Cancelada';
        }elseif ($status == 'Procesada') {
            $value = 'Procesada';
        }
        return $value;
    }

    //Da el formato adecuado a la hora al ser almacenada
    public static function obtenerHora($hora)
    {
        $hora = str_replace(' ','',$hora);
        $array_hora = str_split($hora);
        $numero_hora = $array_hora[5];
        if ($array_hora[5] == 1 && is_numeric($array_hora[6])) {
            $numero_hora = $array_hora[5] . $array_hora[6];
        }

        return $numero_hora;
    }

    //Da el formato adecuado a la hora al ser almacenada para colocar el meridiano adecuado
    public static function obtener_hora_columna($suma_duracion_horas)
    {
        if ($suma_duracion_horas > 12) {
            $suma_duracion_horas = 1;
            $meridiano = "pm_cita_id";
        } else {
            $meridiano = "am_cita_id";
        }
        $hora_columna = "hora_" . $suma_duracion_horas . $meridiano;

        return $hora_columna;
    }

    //Envía correos al cliente dependiendo del tipo de mensaje o acción
    public static function enviarCorreo($email, $tipo, $orden, $monto, $cita, $fecha_cita, $hora){

        $destinatario = $email; 
         

        if($tipo == "Registro"){
            $asunto = "Registro en tienda Golden Grooming Pet&Shop";
            $cuerpo = ' 
                <html> 
                    <head> 
                        <title>Registro exitoso</title> 
                    </head> 
                    <body> 
                        <h1>Golden Grooming Pet&Shop te da la bienvenida.</h1> 
                        <p> 
                            <b>Gracias por registrarte en nuestra tienda.</b>.
                            Puedes visitarnos en la dirección web, <a href="'.base_url.'">'.base_url.'</a> y adquirir los productos y servicios que desees.
                        </p> 
                    </body> 
                </html> 
            '; 
        }

        if($tipo == "Compra"){
            $asunto = "Orden de compra registrada";
            $cuerpo = ' 
                <html> 
                    <head> 
                        <title>Compra exitosa</title> 
                    </head> 
                    <body> 
                        <h1>Golden Grooming Pet&Shop te agradece por adquirir nuestros productos.</h1> 
                        <p>
                            Tu orden ha sido guardada, una vez realices la transferencia
                            bancaria ha la cuenta '.numero_iban.' o al número de SINPE móvil '.telefono_sinpe.' y te comuniques con la vendedora, será procesada.
                        </p>
                        <p> 
                            <h3>Datos del orden</h3>
                            <p>Número de orden: '.$orden.' </p>
                            <p>Total a pagar: '.$monto.' colones </p><br/>
                            Puesdes visitarnos en la dirección web, <a href="'.base_url.'">'.base_url.'</a> y adquirir los productos y servicios que desees.
                        </p> 
                    </body> 
                </html> 
            '; 
        }
        if($tipo == "Enviada"){
            $asunto = "Orden enviada";
            $cuerpo = ' 
                <html> 
                    <head> 
                        <title>Envio</title> 
                    </head> 
                    <body> 
                        <h1>Golden Grooming Pet&Shop le informa que su orden ha sido enviada.</h1> 
                        <p>
                            Tu orden ha sido enviada
                            puedes comunicarte al número móvil '.telefono_sinpe.' con la vendedora, para mas información.
                        </p>
                        <p> 
                            <h3>Datos del orden</h3>
                            <p>Número de orden: '.$orden.' </p>
                            <p>Total de la orden: '.$monto.' colones </p><br/>
                            Puesdes visitarnos en la dirección web, <a href="'.base_url.'">'.base_url.'</a> y adquirir los productos y servicios que desees.
                        </p> 
                    </body> 
                </html> 
            '; 
        }

        if($tipo == "Cita"){
            $asunto = "Cita y Orden de compra registradas";
            $time = preg_split('[_]',$hora);
            $cuerpo = ' 
                <html> 
                    <head> 
                        <title>Se ha registrado una cita</title> 
                    </head> 
                    <body> 
                        <h1>Golden Grooming Pet&Shop.</h1> 
                        <p> 
                            <h3>Datos de la cita</h3>
                            <p>Número de cita: '.$cita.' </p>
                            <p>Número de orden: '.$orden.' </p>
                            <p>Fecha de la cita: '.$fecha_cita.' </p>
                            <p>Hora de la cita: '.$time[1].' </p>
                            <p>Total a pagar: '.$monto.' colones </p><br/>
                            Puesdes visitarnos en la dirección web, <a href="'.base_url.'">'.base_url.'</a> y adquirir los productos y servicios que desees.
                        </p> 
                    </body> 
                </html> 
            '; 
        }

        if($tipo == "Cita_user"){
            $asunto = "Cita y Orden de compra registradas";
            $time = preg_split('[_]',$hora);
            $cuerpo = ' 
                <html> 
                    <head> 
                        <title>Registro de cita exitoso</title> 
                    </head> 
                    <body> 
                        <h1>Golden Grooming Pet&Shop te agradece por adquirir nuestros servicios.</h1> 
                        <p>
                            Tu orden a sido guardada, una vez realices la transferencia
                            bancaria a la cuenta '.numero_iban.' o al número de SINPE móvil '.telefono_sinpe.' y te comuniques con la vendedora, será procesada.
                        </p>
                        <p> 
                            <h3>Datos de la cita</h3>
                            <p>Número de cita: '.$cita.' </p>
                            <p>Número de orden: '.$orden.' </p>
                            <p>Fecha de la cita: '.$fecha_cita.' </p>
                            <p>Hora de la cita: '.$time[1].' </p>
                            <p>Total a pagar: '.$monto.' colones </p><br/>
                            Puesdes visitarnos en la dirección web, <a href="'.base_url.'">'.base_url.'</a> y adquirir los productos y servicios que desees.
                        </p> 
                    </body> 
                </html> 
            '; 
        }

        if($tipo == "Procesada"){
            $asunto = "Tu cita y orden han sido procesadas";
            $time = preg_split('[_]',$hora);
            $cuerpo = ' 
                <html> 
                    <head> 
                        <title>Registro confirmado</title> 
                    </head> 
                    <body> 
                        <h1>Golden Grooming Pet&Shop te agradece por adquirir nuestros servicios.</h1> 
                        <p>
                            Tu cita y orden han sido procesadas
                            puedes comunicarte al número móvil '.telefono_sinpe.' con la vendedora, para mas información.
                        </p>
                        <p> 
                            <h3>Datos de la cita</h3>
                            <p>Número de cita: '.$cita.' </p>
                            <p>Número de orden: '.$orden.' </p>
                            <p>Fecha de la cita: '.$fecha_cita.' </p>
                            <p>Hora de la cita: '.$time[1].' </p>
                            <p>Total a pagar: '.$monto.' colones </p><br/>
                            Puesdes visitarnos en la dirección web, <a href="'.base_url.'">'.base_url.'</a> y adquirir los productos y servicios que desees.
                        </p> 
                    </body> 
                </html> 
            '; 
        }

        if($tipo == "Cancelación"){
            $asunto = "Tu cita ha sido cancelada";
            $time = preg_split('[_]',$hora);
            $cuerpo = ' 
                <html> 
                    <head> 
                        <title>Cancelacion</title> 
                    </head> 
                    <body> 
                        <h1>Lamentamos informar que su cita ha sido cancelada.</h1> 
                        <p>
                            Tu cita fue cancelada por el administrador de la tienda por favor comunicate al número '.telefono_sinpe.' para mas información.
                        </p>
                        <p> 
                        <h3>Datos de la cita</h3>
                            <p>Número de cita: '.$cita.' </p>
                            <p>Número de orden: '.$orden.' </p>
                            <p>Fecha de la cita: '.$fecha_cita.' </p>
                            <p>Hora de la cita: '.$time[1].' </p>
                            Puesdes visitarnos en la dirección web, <a href="'.base_url.'">'.base_url.'</a> y adquirir los productos y servicios que desees.
                        </p> 
                    </body> 
                </html> 
            '; 
        }

        //Definición de datos para en el header
        $headers = "MIME-Version: 1.0\r\n"; 
        $headers .= "Content-type: text/html; charset=iso-8859-1\r\n"; 
        $headers .= "From: Golden Grooming Pet&Shop <tienditagoldengrooming@gmail.com>\r\n"; 
        $headers .= "Reply-To: tienditagoldengrooming@gmail.com\r\n"; 
        $headers .= "Return-path: tienditagoldengrooming@gmail.com\r\n"; 
        $headers .= "Cc: tienditagoldengrooming@gmail.com\r\n"; 
        mail($destinatario,$asunto,$cuerpo,$headers); 
    }

    //Envía correos al administrador dependiendo del tipo de mensaje o acción
    public static function enviarCorreoAdmin($email, $tipo, $orden, $monto, $cita, $fecha_cita, $hora,$nombre_usuario,$telefono,$correo_usuario){

        $destinatario = $email; 
         
        if($tipo == "Cancelación"){
            $asunto = "Una cita ha sido cancelada";
            $time = preg_split('[_]',$hora);
            $cuerpo = ' 
                <html> 
                    <head> 
                        <title>Cancelación</title> 
                    </head> 
                    <body> 
                        <h1>Una cita ha sido cancelada.</h1> 
                        <p>
                            La cita del cliente '.$nombre_usuario.' con número de teléfono '.$telefono.' y correo '.$correo_usuario.' ha sido cancelada.
                        </p>
                        <p> 
                        <h3>Datos de la cita</h3>
                            <p>Número de cita: '.$cita.' </p>
                            <p>Número de orden: '.$orden.' </p>
                            <p>Fecha de la cita: '.$fecha_cita.' </p>
                            <p>Hora de la cita: '.$time[1].' </p>
                            <p>Monto: '.$monto.' </p>
                            Puesdes visitarnos en la dirección web, <a href="'.base_url.'">'.base_url.'</a> y adquirir los productos y servicios que desees.
                        </p> 
                    </body> 
                </html> 
            '; 
        }

        //Definición de datos para en el header
        $headers = "MIME-Version: 1.0\r\n"; 
        $headers .= "Content-type: text/html; charset=iso-8859-1\r\n"; 

        //dirección del remitente 
        $headers .= "From: Golden Grooming Pet&Shop <tienditagoldengrooming@gmail.com>\r\n"; 

        $headers .= "Reply-To: tienditagoldengrooming@gmail.com\r\n"; 

        $headers .= "Return-path: tienditagoldengrooming@gmail.com\r\n"; 

        $headers .= "Cc: tienditagoldengrooming@gmail.com\r\n"; 

        mail($destinatario,$asunto,$cuerpo,$headers); 

    }
}
