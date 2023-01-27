<?php

require_once 'modelos/Usuario.php';

class UsuarioController {

    public function index() {
        echo "Controlador Usuario, Accion Index.";
    }

    //Muestra la pantalla de registro de usuarios
    public function registro() {
        require_once 'vistas/usuario/registro.php';
    }

    //Muestra la pantalla de gestión de usuarios
    public function gestion()
    {
        Utilidades::isAdmin();

        Utilidades::isIdentity();
        $gestion = true;
        $usuario = new Usuario();
        $lista_usuarios = $usuario->getUsuarios();

        require_once 'vistas/usuario/lista_usuarios.php';
    }

    //Muestra la información detallada de un usuario
    public function detalle()
    {
        Utilidades::isAdmin();
  
        if (isset($_GET['usuario_id'])) {
        
            $usuario_id = $_GET['usuario_id'];
            $usuario = new Usuario();
            $usuario = $usuario->getUsuario($usuario_id)->fetch_object();
           
        } else {
            header("Location: " . base_url . 'Usuario/lista_usuarios.php');
            ob_end_flush();
        }

        require_once 'vistas/usuario/detalle.php';
    }

    //Guarda o registra un usuario nuevo
    public function save(){
        //Utilidades::isAdmin();
        
        if (isset($_POST)) {          
            $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : false;
            $apellidos = isset($_POST['apellidos']) ? $_POST['apellidos'] : false;
            $email = isset($_POST['email']) ? $_POST['email'] : false;
            $password = isset($_POST['password_1']) ? $_POST['password_1'] : false;
            $telefono = isset($_POST['telefono']) ? $_POST['telefono'] : false;
            $direccion = isset($_POST['direccion']) ? $_POST['direccion'] : false;
            $cedula = isset($_POST['cedula']) ? $_POST['cedula'] : false;
            $password_2 = isset($_POST['password_2']) ? $_POST['password_2'] : false;

            // Array de errores 
            $errores = Array();

            // Validar los datos antes de guardarlos en la base de datos.
            // Validar campo nombre
            if (!empty($nombre) && !is_numeric($nombre) && !preg_match("/[0-9]/", $nombre)) {
                $_SESSION['loadname'] = $nombre;
            } else {
                $errores['nombre'] = "El nombre no es válido.";
            }

            // Validar apellidos
            if (!empty($apellidos) && !is_numeric($apellidos) && !preg_match("/[0-9]/", $apellidos)) {
                $_SESSION['loadapellidos'] = $apellidos;
            } else {               
                $errores['apellidos'] = "Los apellidos no son válidos.";
            }

            // Validar el email
            if (!empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $_SESSION['loademail'] = $email;
            } else {
                $errores['email'] = "El correo no es válido.";
            }

            // Validar contraseña
            if (!empty($password)) {
                $_SESSION['loadpassword_1'] = $password;
            } else {
                $errores['password_1'] = "El campo password esta vacio.";
            }

            if(!empty($password_2) && !empty($password)){
                if ($password != $password_2) {
                    $errores['password_1'] = "Las contraseñas no coinciden.";
                    $errores['password_2'] = "Las contraseñas no coinciden.";
                }
            }

            // Validar telefono
            if (!empty($telefono)) {
                $_SESSION['loadtelefono'] = $telefono;
            } else {
                $errores['telefono'] = "El campo telefono esta vacio.";
            }

            if (!empty($direccion)) {
                $_SESSION['loaddireccion'] = $direccion;
            } else {
                $errores['direccion'] = "El campo de dirección esta vacio.";
            }

            if (!empty($cedula)) {
                $_SESSION['loadcedula'] = $cedula;
            } else {
                $errores['cedula'] = "El campo de cédula esta vacio.";
            }
    
            $guardar_usuario = false;
            if (count($errores) == 0) {
                $usuario = new Usuario;

                $check = $usuario->usuarioCheckEmail($email);

                if($check != null){
                    $_SESSION['register'] = "failed";
                    header("Location: " . base_url . "Usuario/registro");
                    ob_end_flush();
                    die();
                }
                
                $usuario->setNombre($nombre);
                $usuario->setApellidos($apellidos);
                $usuario->setEmail($email);
                $usuario->setPassword($password);
                $usuario->setTelefono($telefono);
                $usuario->setDireccion($direccion);
                $usuario->setCedula($cedula);

                $save = $usuario->save();

                if($save){
                    $_SESSION['register'] = "complete";
                    Utilidades::deleteSession('loadname');
                    Utilidades::deleteSession('loadapellidos');
                    Utilidades::deleteSession('loadpassword_1');
                    Utilidades::deleteSession('loademail');
                    Utilidades::deleteSession('loadtelefono');
                    Utilidades::deleteSession('loaddireccion');
                    Utilidades::deleteSession('loadcedula');

                    Utilidades::enviarCorreo($email, "Registro", "", "", "", "", "");

                }else{
                    $_SESSION['register'] = "failed";
                }
            }else{
                $_SESSION['errores'] = $errores;
            }
        } else {
            $_SESSION['register'] = "failed";
        }

        header("Location: " . base_url . "Usuario/registro");   
        ob_end_flush();
    }

    //Muestra la pantalla de cambio de contraseña
    public function reset_password(){
        require_once 'vistas/usuario/reset_password.php';
    }

    //Realiza el cambio de una contraseña
    public function reset(){

        if (isset($_POST)) {          
            $password_actual = isset($_POST['password_actual']) ? $_POST['password_actual'] : false;
            $password_1 = isset($_POST['password_1']) ? $_POST['password_1'] : false;
            $password_2 = isset($_POST['password_2']) ? $_POST['password_2'] : false;

            // Array de errores 
            $errores = Array();
   
            // Validar contraseña
            if (!empty($password_actual)) {
                $_SESSION['loadpassword_actual'] = $password_actual;
            } else {
                $errores['password_actual'] = "El campo password esta vacio.";
            }

            if (!empty($password_1)) {
                $_SESSION['loadpassword_1'] = $password_1;
            } else {
                $errores['password_1'] = "El campo password esta vacio.";
            }

            if (!empty($password_2)) {
                $_SESSION['loadpassword_2'] = $password_2;
            } else {
                $errores['password_2'] = "El campo password esta vacio.";
            }

            if(!empty($password_2) && !empty($password_1)){
                if ($password_1 != $password_2) {
                    $errores['password_1'] = "Las contraseñas no coinciden.";
                    $errores['password_2'] = "Las contraseñas no coinciden.";
                }
            }

            $edit = false;

            if (count($errores) == 0) {
                $usuario = new Usuario;

                $usuario->setId($_SESSION['renovar_password']->id);
                $usuario->setPassword($password_actual);
                $usuario->setEmail($_SESSION['renovar_password']->email);

                $validar_contraseña_actual = $usuario->login();
 
                if ($validar_contraseña_actual && is_object($validar_contraseña_actual)) {
                    $usuario->setPassword($password_1);

                    $validar_contraseña_nueva = $usuario->login();
                    if ($validar_contraseña_nueva && is_object($validar_contraseña_nueva)) {
                        $errores['password_1'] = "La nueva contraseña no debe ser igual que la anterior.";
                        $_SESSION['errores'] = $errores;
                    } else {
                        $edit = $usuario->edit(); 
                    }
                } else {
                    $errores['password_actual'] = "La contraseña no es correcta.";
                    $_SESSION['errores'] = $errores;            
                }

                if($edit){
                    $_SESSION['reset'] = "complete";
                    Utilidades::deleteSession('loadpassword_actual');
                    Utilidades::deleteSession('loadpassword_1');
                    Utilidades::deleteSession('loadpassword_2');
                    if ($_SESSION['renovar_password']->rol == 'admin') {
                        $_SESSION['admin'] = true;
                    }
                    $_SESSION['identity'] = $_SESSION['renovar_password'];
                }else{
                    $_SESSION['reset'] = "failed";
                }
            }else{
                $_SESSION['errores'] = $errores;
            }
        } else {
            $_SESSION['reset'] = "failed";
        }

        header("Location: " . base_url . "Usuario/reset_password");   
        ob_end_flush();
    }

    //Método de logueo a la cuenta del cliente
    public function login() {
        if (isset($_POST)) {
            //Identificar al usuario.          
            //Consulta sql.
            $usuario = new Usuario();
            $usuario->setEmail(trim($_POST['email']));
            $usuario->setPassword(trim($_POST['password']));
            $identity = $usuario->login();
            //Crear una session.
        
            if ($identity && is_object($identity)) {
                $_SESSION['identity'] = $identity;
                $_SESSION['renovar_password'] = $identity;

                if ($identity->rol == 'admin') {
                    $_SESSION['admin'] = true;
                }

                //var_dump($identity->password_date);
                //var_dump(date('Y-m-d'));
                $now = new DateTime(date('Y-m-d'));
                $password_date = new DateTime($identity->password_date);
                $dif = $now->diff($password_date);

                $diferencia_dias = $dif->format('%a');

                if($diferencia_dias > 30){
                    //var_dump($dif->format('%a'));
                    Utilidades::deleteSession('admin');
                    Utilidades::deleteSession('identity');
                    require_once 'vistas/usuario/reset_password.php';
                    die();
                }  

            } else {
                $_SESSION['error_login'] = "Identificación fallida.";
            }
        }

        Utilidades::deleteSession('carrito_servicios');
        Utilidades::deleteSession('carrito_productos');
        Utilidades::deleteSession('carrito_combos');

        header("Location:" . base_url);
        ob_end_flush();

    }

    //Cierra la sesión del usuario
    public function logout() {
        if (isset($_SESSION['identity'])) {
            Utilidades::deleteSession('identity');
        }
        if (isset($_SESSION['admin'])) {
            Utilidades::deleteSession('admin');
        }

        Utilidades::deleteSession('carrito_servicios');
        Utilidades::deleteSession('carrito_productos');
        Utilidades::deleteSession('carrito_combos');
        header("Location:" . base_url);
        ob_end_flush();
    }

}
