<?php


class Usuario{

    //Los modelos empleados contienen todos los atributos relacionados a cada entidad y también los
    //las funciones encargadas de obtener o establecer la información de cada objeto
    //Contiene los métodos que se comunican con la base de datos para realizar todas las operaciones CRUD
    
    private $id;
    private $nombre;
    private $apellidos;
    private $email;
    private $password;
    private $password_date;
    private $rol;
    private $image;
    private $telefono;
    private $direccion;
    private $cedula;
    
    //  Conexion a la base de datos;
    private $base_datos;
    
    public function __construct() {
        $this->base_datos = BaseDatos::conectar();
    }
    
    function getId() {
        return $this->id;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getPassword_Date() {
        return password_hash($this->base_datos->real_escape_string($this->password_date), PASSWORD_BCRYPT, ['cost' => 4]);
    }

    function getApellidos() {
        return $this->apellidos;
    }

    function getEmail() {
        return $this->email;
    }

    function getPassword() {
        return password_hash($this->base_datos->real_escape_string($this->password), PASSWORD_BCRYPT, ['cost' => 4]);
    }

    function getRol() {
        return $this->rol;
    }

    function getImage() {
        return $this->image;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setPassword_Date($password_date) {
        $this->password_date = $password_date;
    }

    function setNombre($nombre) {
        $this->nombre = $this->base_datos->real_escape_string($nombre);
    }

    function setApellidos($apellidos) {
        $this->apellidos = $this->base_datos->real_escape_string($apellidos);
    }

    function setEmail($email) {
        $this->email = $this->base_datos->real_escape_string($email);
    }

    function setPassword($password) {
        $this->password = $password;
    }

    function setRol($rol) {
        $this->rol = $rol;
    }

    function setImage($image) {
        $this->image = $this->base_datos->real_escape_string($image);
    }

    public function getTelefono(){
        return $this->telefono;
    }

    public function setTelefono($telefono){
        $this->telefono = $this->base_datos->real_escape_string($telefono);
    }

    public function getDireccion(){
        return $this->direccion;
    }

    public function setDireccion($direccion){
        $this->direccion = $this->base_datos->real_escape_string($direccion);
    }

    public function getCedula(){
        return $this->cedula;
    }

    public function setCedula($cedula){
        $this->cedula = $this->base_datos->real_escape_string($cedula);
    }

    public function save(){
        $consulta = "INSERT INTO usuarios VALUES (null,'{$this->nombre}','{$this->apellidos}','{$this->email}','{$this->getPassword()}','user', null,'{$this->getTelefono()}','{$this->getDireccion()}','{$this->getCedula()}', CURDATE());";
        $save = $this->base_datos->query($consulta);   
        
        $result = false;
        if($save){
            $result = true;
        } 
            return $result;        
    }

    public function getUsuarios(){
      
        $consulta = "SELECT u.id, u.nombre, u.apellidos, u.email, u.rol, u.imagen, u.telefono, u.direccion, u.cedula  FROM usuarios u;";
        $usuarios = $this->base_datos->query($consulta);

        return $usuarios;
    }

    public function getUsuario($id){
      
        $consulta = "SELECT u.id, u.nombre, u.apellidos, u.email, u.rol, u.imagen, u.telefono, u.direccion, u.cedula, u.password_date FROM usuarios u WHERE id='$id';";
        $usuario = $this->base_datos->query($consulta);

        //var_dump($this->base_datos->error);
        //die();
        return $usuario;
    }

    public function usuarioCheckEmail($email){
      
        $consulta = "SELECT u.email  FROM usuarios u WHERE email='$email';";
        $email = $this->base_datos->query($consulta);

        //var_dump($this->base_datos->error);
        //die();
        return $email->fetch_object();
    }
    
    public function login(){
        $result = false;
        
        //Comprobar si existe el usuario.   
        $consulta = "SELECT * FROM usuarios WHERE email = '$this->email'";
        $login = $this->base_datos->query($consulta);
        
        if($login && $login->num_rows == 1){
            $usuario =$login->fetch_object();
            //Verificar la constraseña.
            $verify = password_verify($this->password, $usuario->password);
            //var_dump($this->password);
            //var_dump($usuario->password);
            //die();
            
            if($verify){               
                $result = $usuario;
            }
        }else{
            $result = false;
        }     
        return $result;
    }

    public function edit(){
        $consulta = "UPDATE usuarios SET password_date=CURDATE(), password='{$this->getPassword()}' WHERE id='{$this->id}';";
       
        $update = $this->base_datos->query($consulta);
        
        $result = false;
        if($update){
            $result = true;
        }
        return $result;
    }
}
