//Archivo que se encarga de realizar la validaciones para cada uno de los formularios del proyecto
window.addEventListener('load',()=>{

    //Carga de los diferentes formularios en variables para manipularlos y detectarlos
    var form_registro = document.getElementById('form_registro');
    var form_producto = document.getElementById('form_producto');
    var form_servicio = document.getElementById('form_servicio');
    var form_combo = document.getElementById('form_combo');
    var form_orden = document.getElementById('form_orden');
    var form_reset = document.getElementById('form_reset');

    //Funciones especificar para validar cada tipo de dato, campo o input
    function validar_alfanumericos(valor){
        const patron = /^[a-zA-Z0-9,.\s\-\/À-ÿ\u00f1\u00d1]+$/u;
        if (! patron.test(valor)) { 
            return false;
        }
        return true;
    }

    function validar_cedula(valor){
        const patron = /^[1-9][0]\d{3}[0]\d{3}$/;
        if (! patron.test(valor)) { 
            return false;
        }
        return true;
    }

    function validar_password(valor){
        const patron = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,12}$/u;
        if (! patron.test(valor)) { 
            return false;
        }
        return true;
    }

    function validar_numerosTelefonos_l8(valor){

        let longitud = valor.length;
        if(longitud >= 8){
            const patron =  /^[1-9]\d{3}-?\d{4}$/u;
            if (! patron.test(valor)) { 
                return false;
            }
            return true;
        }else{
            return true;
        }
    }

    function validar_numerosTelefonos(valor){

        let longitud = valor.length;
      
        const patron =  /^[1-9]\d{3}-?\d{4}$/u;
        if (! patron.test(valor)) { 
            return false;
        }
        return true;
       
    }

    function format_telefono(elemento){
        var num_tel = elemento.value;
        var string_tel = new String(num_tel);
        var guion = false;
    
        let parte1 = "";
        let parte2 = "";
        var armado = "";
    
        var tamaño = num_tel.length;
        if(tamaño > 5){
            if(string_tel.charAt(4) == '-'){
                guion = true;
            }else{
                guion = false;
            }
        }
    
        if(tamaño == 8){
            if(!guion){
                parte1 = num_tel.slice(0,4);
                parte2 = num_tel.slice(4,8);
                armado = parte1 +"-"+parte2
                elemento.value = armado;
            }
            
        }
    }

    function validar_equal_password(password){
        var equal_password_1 = document.getElementById('password_1');
        var equal_password_2 = document.getElementById('password_2');

        var error_password_1 = document.getElementById('error_password_1');
        var error_password_2 = document.getElementById('error_password_2');

        if(equal_password_1.value != equal_password_2.value){
            if(password == 1){
                error_password_1.innerHTML = "Las contraseñas no coinciden.";
            }
            if(password == 2){
                error_password_2.innerHTML = "Las contraseñas no coinciden.";
            }
            return false;
        }else{
            error_password_1.innerHTML = "";
            error_password_2.innerHTML = "";
            return true;
        }
    }

    function validar_numericos(valor){
        const patron = /^[0-9\.]+$/u;
        if (! patron.test(valor)) { 
            return false;
        }
        return true;
    }

    function validar_correo(valor){
        const patron = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        if (! patron.test(valor)) { 
            return false;
        }
        return true;
    }

    function validar_numerosGuiones(valor){
        const patron = /^[0-9\s\-]+$/u;
        if (! patron.test(valor)) { 
            return false;
        }
        return true;
    }

    //Dependiendo del valor capturado se realizan las validaciones para cada formulario.
    if(form_registro != null){

        //Se capturan los elementos de cada campo, los labels de mensajes y los botones
        var name = document.getElementById('nombre');
        var apellidos = document.getElementById('apellidos');
        var cedula = document.getElementById('cedula');
        var correo = document.getElementById('email');
        var telefono = document.getElementById('telefono');
        var direccion = document.getElementById('direccion');
        var password_1 = document.getElementById('password_1');
        var password_2 = document.getElementById('password_2');

        
        var error_password_1 = document.getElementById('error_password_1');
        var error_password_2 = document.getElementById('error_password_2');

        var btn_submit_register = document.getElementById('btn_submit_register');

        var error_nombre = document.getElementById('error_nombre');
        var error_apellidos = document.getElementById('error_apellidos');
        var error_cedula = document.getElementById('error_cedula');
        var error_correo = document.getElementById('error_correo');
        var error_telefono = document.getElementById('error_telefono');
        var error_direccion = document.getElementById('error_direccion');
        var error_formulario = document.getElementById('error_formulario');

        //Se agregan los listeners para cada campo
        //esto permite realizar la validación con cada letra que ingresa el usuario
        name.addEventListener('keyup', (e)=>{

            var val_nombre = validar_alfanumericos(name.value);
            if(!val_nombre){
                error_nombre.innerHTML = "Solo se permiten entradas de números y letras";
            }else{
                error_nombre.innerHTML = "";
            }
        });

        apellidos.addEventListener('keyup', (e)=>{
   
            var val_apellidos = validar_alfanumericos(apellidos.value);
            if(!val_apellidos){
                error_apellidos.innerHTML = "Solo se permiten entradas alfanuméricas";
            }else{
                error_apellidos.innerHTML = "";
            }
        });

        direccion.addEventListener('keyup', (e)=>{

            var val_direccion = validar_alfanumericos(direccion.value);
            if(!val_direccion){
                error_direccion.innerHTML = "Solo se permiten entradas alfanuméricas";
            }else{
                error_direccion.innerHTML = "";
            }
        });

        correo.addEventListener('keyup', (e)=>{
            var val_correo = validar_correo(correo.value);
            if(!val_correo){
                error_correo.innerHTML = "Solo se permite el formato de correo";
            }else{
                error_correo.innerHTML = "";
            }
        });

        cedula.addEventListener('keyup', (e)=>{
            var val_cedula = validar_cedula(cedula.value);
            if(!val_cedula){
                error_cedula.innerHTML = "Solo se permiten los formatos de número de cédula, 1011110111";
            }else{
                error_cedula.innerHTML = "";
            }
        });

        telefono.addEventListener('keyup', (e)=>{
            var val_telefono = validar_numerosTelefonos_l8(telefono.value);
            if(!val_telefono){
                error_telefono.innerHTML = "Solo se permiten números de teléfono";
            }else{
                error_telefono.innerHTML = "";
            }
            format_telefono(telefono);
        });

        password_1.addEventListener('keyup', (e)=>{

            var val_password_1 = validar_password(password_1.value);
            if(!val_password_1 ){
                error_password_1.innerHTML = "La contraseña debe estar conformada por mínimo ocho y máximo doce caracteres, al menos una letra mayúscula, una letra minúscula, un número y un carácter especial";
            }else{
                error_password_1.innerHTML = "";
                val_password_1 = validar_equal_password(1);
            }
        });

        password_2.addEventListener('keyup', (e)=>{

            var val_password_2 = validar_password(password_2.value);
            if(!val_password_2 ){
                error_password_2.innerHTML = "La contraseña debe estar conformada por mínimo ocho y máximo doce caracteres, al menos una letra mayúscula, una letra minúscula, un número y un carácter especial";
            }else{
                error_password_2.innerHTML = "";
                val_password_2 = validar_equal_password(2);
            }
        });

        //Se valida toda la información ingresada en el formulario al hacer submit
        form_registro.addEventListener('submit', (e)=>{
  
            var val_apellidos = validar_alfanumericos(apellidos.value);
            var val_correo = validar_correo(correo.value);
            var val_direccion = validar_alfanumericos(direccion.value);
            var val_telefono = validar_numerosTelefonos(telefono.value);
            var val_cedula = validar_cedula(cedula.value);
            var val_nombre = validar_alfanumericos(name.value);
            var val_password_1 = validar_password(password_1.value);
            var val_password_2 = validar_password(password_2.value);

            if(!val_password_1 || !val_password_2 || !val_telefono || !val_cedula || !val_correo || !val_apellidos || !val_nombre || !val_direccion){
                error_formulario.innerHTML = "Algunos campos no son válidos, por favor corrija la información ingresada";
                e.preventDefault();
            }else{
                error_formulario.innerHTML = "";
            }
        });

        form_registro.addEventListener('change', (e)=>{
            error_formulario.innerHTML = "";
        });

        //Se valida toda la información ingresada en el formulario al colocar el puntero sobre el botón de submit
        btn_submit_register.addEventListener('mouseover', (e)=>{

            var val_apellidos = validar_alfanumericos(apellidos.value);
            var val_correo = validar_correo(correo.value);
            var val_direccion = validar_alfanumericos(direccion.value);
            var val_telefono = validar_numerosTelefonos(telefono.value);
            var val_cedula = validar_cedula(cedula.value);
            var val_nombre = validar_alfanumericos(name.value);
            var val_password_1 = validar_password(password_1.value);
            var val_password_2 = validar_password(password_2.value);

            if(!val_password_1 || !val_password_2 || !val_telefono || !val_cedula || !val_correo || !val_apellidos || !val_nombre || !val_direccion){
                error_formulario.innerHTML = "Algunos campos no son válidos, por favor corrija la información ingresada";
                e.preventDefault();
            }else{
                error_formulario.innerHTML = "";
            }
        });

    }

    //Sigue la misma lógica del formulario  form_register
    if(form_producto != null){

        var name = document.getElementById('nombre');
        var descripcion = document.getElementById('descripcion');
        var precio = document.getElementById('precio');
        var stock = document.getElementById('stock');

        var error_nombre = document.getElementById('error_nombre');
        var error_descripcion = document.getElementById('error_descripcion');
        var error_precio= document.getElementById('error_precio');
        var error_stock = document.getElementById('error_stock');

        var error_formulario = document.getElementById('error_formulario');

        var btn_submit_producto = document.getElementById('btn_submit_producto');
       
        name.addEventListener('keyup', (e)=>{

            var val_nombre = validar_alfanumericos(name.value);
            if(!val_nombre){
                error_nombre.innerHTML = "Solo se permiten entradas de números y letras";
            }else{
                error_nombre.innerHTML = "";
            }
        });

        descripcion.addEventListener('keyup', (e)=>{
   
            var val_descripcion = validar_alfanumericos(descripcion.value);
            if(!val_descripcion){
                error_descripcion.innerHTML = "Solo se permiten entradas alfanuméricas";
            }else{
                error_descripcion.innerHTML = "";
            }
        });

        precio.addEventListener('keyup', (e)=>{

            var val_precio = validar_numericos(precio.value);
            if(!val_precio){
                error_precio.innerHTML = "Solo se permiten entradas numéricas";
            }else{
                error_precio.innerHTML = "";
            }
        });

        stock.addEventListener('keyup', (e)=>{
            var val_stock = validar_numericos(stock.value);
            if(!val_stock){
                error_stock.innerHTML = "Solo se permiten entradas numéricas";
            }else{
                error_stock.innerHTML = "";
            }
        });

        form_producto.addEventListener('submit', (e)=>{

            var val_nombre = validar_alfanumericos(name.value);
            var val_stock = validar_numericos(stock.value);
            var val_precio = validar_numericos(precio.value);
            var val_descripcion = validar_alfanumericos(descripcion.value);

            if(!val_stock || !val_precio || !val_descripcion ||!val_nombre){
                error_formulario.innerHTML = "Algunos campos no son válidos, por favor corrija la información ingresada";
                e.preventDefault();
            }else{
                error_formulario.innerHTML = "";
            }
        });

        form_producto.addEventListener('change', (e)=>{
            error_formulario.innerHTML = "";
        });

        btn_submit_producto.addEventListener('mouseover', (e)=>{

            var val_nombre = validar_alfanumericos(name.value);
            var val_stock = validar_numericos(stock.value);
            var val_precio = validar_numericos(precio.value);
            var val_descripcion = validar_alfanumericos(descripcion.value);

            if(!val_stock || !val_precio || !val_descripcion ||!val_nombre){
                error_formulario.innerHTML = "Algunos campos no son válidos, por favor corrija la información ingresada";
                e.preventDefault();
            }else{
                error_formulario.innerHTML = "";
            }
        });

    }

    //Sigue la misma lógica del formulario  form_register
    if(form_servicio != null){

        var name = document.getElementById('nombre');
        var descripcion = document.getElementById('descripcion');
        var precio = document.getElementById('precio');

        var error_nombre = document.getElementById('error_nombre');
        var error_descripcion = document.getElementById('error_descripcion');
        var error_precio= document.getElementById('error_precio');

        var error_formulario = document.getElementById('error_formulario');

        var btn_submit_servicio = document.getElementById('btn_submit_servicio');
       
        name.addEventListener('keyup', (e)=>{

            var val_nombre = validar_alfanumericos(name.value);
            if(!val_nombre){
                error_nombre.innerHTML = "Solo se permiten entradas de números y letras";
            }else{
                error_nombre.innerHTML = "";
            }
        });

        descripcion.addEventListener('keyup', (e)=>{
   
            var val_descripcion = validar_alfanumericos(descripcion.value);
            if(!val_descripcion){
                error_descripcion.innerHTML = "Solo se permiten entradas alfanuméricas";
            }else{
                error_descripcion.innerHTML = "";
            }
        });

        precio.addEventListener('keyup', (e)=>{

            var val_precio = validar_numericos(precio.value);
            if(!val_precio){
                error_precio.innerHTML = "Solo se permiten entradas numéricas";
            }else{
                error_precio.innerHTML = "";
            }
        });

        form_servicio.addEventListener('submit', (e)=>{

            var val_nombre = validar_alfanumericos(name.value);
            var val_precio = validar_numericos(precio.value);
            var val_descripcion = validar_alfanumericos(descripcion.value);

            if(!val_precio || !val_descripcion || !val_nombre){
                error_formulario.innerHTML = "Algunos campos no son válidos, por favor corrija la información ingresada";
                e.preventDefault();
            }else{
                error_formulario.innerHTML = "";
            }
        });

        form_servicio.addEventListener('change', (e)=>{
            error_formulario.innerHTML = "";
        });

        btn_submit_servicio.addEventListener('mouseover', (e)=>{

            var val_nombre = validar_alfanumericos(name.value);
            var val_precio = validar_numericos(precio.value);
            var val_descripcion = validar_alfanumericos(descripcion.value);

            if(!val_precio || !val_descripcion ||!val_nombre){
                error_formulario.innerHTML = "Algunos campos no son válidos, por favor corrija la información ingresada";
                e.preventDefault();
            }else{
                error_formulario.innerHTML = "";
            }
        });

    }

    //Sigue la misma lógica del formulario  form_register
    if(form_combo != null){

        var name = document.getElementById('nombre');
        var descripcion = document.getElementById('descripcion');
        var precio = document.getElementById('precio');

        var error_nombre = document.getElementById('error_nombre');
        var error_descripcion = document.getElementById('error_descripcion');
        var error_precio= document.getElementById('error_precio');

        var error_formulario = document.getElementById('error_formulario');

        var btn_submit_combo = document.getElementById('btn_submit_combo');

        name.addEventListener('keyup', (e)=>{

            var val_nombre = validar_alfanumericos(name.value);
            if(!val_nombre){
                error_nombre.innerHTML = "Solo se permiten entradas de números y letras";
            }else{
                error_nombre.innerHTML = "";
            }
        });

        descripcion.addEventListener('keyup', (e)=>{
   
            var val_descripcion = validar_alfanumericos(descripcion.value);
            if(!val_descripcion){
                error_descripcion.innerHTML = "Solo se permiten entradas alfanuméricas";
            }else{
                error_descripcion.innerHTML = "";
            }
        });

        precio.addEventListener('keyup', (e)=>{

            var val_precio = validar_numericos(precio.value);
            if(!val_precio){
                error_precio.innerHTML = "Solo se permiten entradas numéricas";
            }else{
                error_precio.innerHTML = "";
            }
        });

        form_combo.addEventListener('submit', (e)=>{

            var val_nombre = validar_alfanumericos(name.value);
            var val_precio = validar_numericos(precio.value);
            var val_descripcion = validar_alfanumericos(descripcion.value);

            if(!val_precio || !val_descripcion ||!val_nombre){
                error_formulario.innerHTML = "Algunos campos no son válidos, por favor corrija la información ingresada";
                e.preventDefault();
            }else{
                error_formulario.innerHTML = "";
            }
        });

        form_combo.addEventListener('change', (e)=>{
            error_formulario.innerHTML = "";
        });

        btn_submit_combo.addEventListener('mouseover', (e)=>{

            var val_nombre = validar_alfanumericos(name.value);
            var val_precio = validar_numericos(precio.value);
            var val_descripcion = validar_alfanumericos(descripcion.value);

            if(!val_precio || !val_descripcion || !val_nombre){
                error_formulario.innerHTML = "Algunos campos no son válidos, por favor corrija la información ingresada";
                e.preventDefault();
            }else{
                error_formulario.innerHTML = "";
            }
        });
    }

    //Sigue la misma lógica del formulario  form_register
    if(form_orden != null){

        var provincia = document.getElementById('provincia');
        var canton = document.getElementById('canton');
        var distrito = document.getElementById('distrito');
        var localidad = document.getElementById('localidad');
        var direccion = document.getElementById('direccion');

        var error_provincia = document.getElementById('error_provincia');
        var error_canton = document.getElementById('error_canton');
        var error_distrito= document.getElementById('error_distrito');
        var error_localidad= document.getElementById('error_localidad');
        var error_direccion = document.getElementById('error_direccion');

        var error_formulario = document.getElementById('error_formulario');

        var btn_submit_orden = document.getElementById('btn_submit_orden');

        var descripcion = document.getElementById('descripcion');

        if(descripcion != null){

            var telefono_1 = document.getElementById('telefono_1');
            var telefono_2 = document.getElementById('telefono_2');
            var nombre = document.getElementById('nombre');
            var raza = document.getElementById('raza');

            var error_descripcion= document.getElementById('error_descripcion');
            var error_telefono_1= document.getElementById('error_telefono_1');
            var error_telefono_2 = document.getElementById('error_telefono_2');
            var error_nombre = document.getElementById('error_nombre');
            var error_raza = document.getElementById('error_raza');

            telefono_1.addEventListener('keyup', (e)=>{
                var val_telefono_1 = validar_numerosTelefonos_l8(telefono_1.value);
                if(!val_telefono_1){
                    error_telefono_1.innerHTML = "Solo se permiten números de teléfono";
                }else{
                    error_telefono_1.innerHTML = "";
                }
                format_telefono(telefono_1);
            });

            telefono_2.addEventListener('keyup', (e)=>{
                var val_telefono_2 = validar_numerosTelefonos_l8(telefono_2.value);
                if(!val_telefono_2){
                    error_telefono_2.innerHTML = "Solo se permiten números de teléfono";
                }else{
                    error_telefono_2.innerHTML = "";
                }
                format_telefono(telefono_2);
            });

            descripcion.addEventListener('keyup', (e)=>{
                var val_descripcion = validar_alfanumericos(descripcion.value);
                if(!val_descripcion){
                    error_descripcion.innerHTML = "Solo se permiten entradas alfanuméricas";
                }else{
                    error_descripcion.innerHTML = "";
                }
            });

            nombre.addEventListener('keyup', (e)=>{
                var val_nombre = validar_alfanumericos(nombre.value);
                if(!val_nombre){
                    error_nombre.innerHTML = "Solo se permiten entradas alfanuméricas";
                }else{
                    error_nombre.innerHTML = "";
                }
            });

            raza.addEventListener('keyup', (e)=>{
                var val_raza = validar_alfanumericos(raza.value);
                if(!val_raza){
                    error_raza.innerHTML = "Solo se permiten entradas alfanuméricas";
                }else{
                    error_raza.innerHTML = "";
                }
            });
        }

        direccion.addEventListener('keyup', (e)=>{

            var val_direccion = validar_alfanumericos(direccion.value);
            if(!val_direccion){
                error_direccion.innerHTML = "Solo se permiten entradas alfanuméricas";
            }else{
                error_direccion.innerHTML = "";
            }
        });
       
        provincia.addEventListener('keyup', (e)=>{

            var val_provincia = validar_alfanumericos(provincia.value);
            if(!val_provincia){
                error_provincia.innerHTML = "Solo se permiten entradas alfanuméricas";
            }else{
                error_provincia.innerHTML = "";
            }
        });

        canton.addEventListener('keyup', (e)=>{
   
            var val_canton = validar_alfanumericos(canton.value);
            if(!val_canton){
                error_canton.innerHTML = "Solo se permiten entradas alfanuméricas";
            }else{
                error_canton.innerHTML = "";
            }
        });

        distrito.addEventListener('keyup', (e)=>{
   
            var val_distrito = validar_alfanumericos(distrito.value);
            if(!val_distrito){
                error_distrito.innerHTML = "Solo se permiten entradas alfanuméricas";
            }else{
                error_distrito.innerHTML = "";
            }
        });

        localidad.addEventListener('keyup', (e)=>{
   
            var val_localidad = validar_alfanumericos(localidad.value);
            if(!val_localidad){
                error_localidad.innerHTML = "Solo se permiten entradas alfanuméricas";
            }else{
                error_localidad.innerHTML = "";
            }
        });

        form_orden.addEventListener('submit', (e)=>{

            var val_direccion = validar_alfanumericos(direccion.value);
            var val_provincia = validar_alfanumericos(provincia.value);
            var val_canton = validar_alfanumericos(canton.value);
            var val_distrito = validar_alfanumericos(distrito.value);
            var val_localidad = validar_alfanumericos(localidad.value);
            
            if(descripcion != null){

                var val_telefono_1 = validar_numerosTelefonos(telefono_1.value);
                var val_telefono_2 = validar_numerosTelefonos(telefono_2.value);
                var val_descripcion = validar_alfanumericos(descripcion.value);
                var val_nombre = validar_alfanumericos(nombre.value);
                var val_raza = validar_alfanumericos(raza.value);

                if(!val_direccion || !val_provincia || !val_canton || !val_distrito || !val_localidad || !val_telefono_1 || !val_telefono_2 || !val_descripcion || !val_nombre || !val_raza){
                    error_formulario.innerHTML = "Algunos campos no son válidos, por favor corrija la información ingresada";
                    e.preventDefault();
                }else{
                    error_formulario.innerHTML = "";
                }
            }else{
                if(!val_direccion || !val_provincia || !val_canton || !val_distrito || !val_localidad){
                    error_formulario.innerHTML = "Algunos campos no son válidos, por favor corrija la información ingresada";
                    e.preventDefault();
                }else{
                    error_formulario.innerHTML = "";
                }
            }
            
        });

        form_orden.addEventListener('change', (e)=>{
            error_formulario.innerHTML = "";
        });

        btn_submit_orden.addEventListener('mouseover', (e)=>{

            var val_direccion = validar_alfanumericos(direccion.value);
            var val_provincia = validar_alfanumericos(provincia.value);
            var val_canton = validar_alfanumericos(canton.value);
            var val_distrito = validar_alfanumericos(distrito.value);
            var val_localidad = validar_alfanumericos(localidad.value);

            if(descripcion != null){

                var val_telefono_1 = validar_numerosTelefonos(telefono_1.value);
                var val_telefono_2 = validar_numerosTelefonos(telefono_2.value);
                var val_descripcion = validar_alfanumericos(descripcion.value);
                var val_nombre = validar_alfanumericos(nombre.value);
                var val_raza = validar_alfanumericos(raza.value);

                if(!val_direccion || !val_provincia || !val_canton || !val_distrito || !val_localidad || !val_telefono_1 || !val_telefono_2 || !val_descripcion || !val_nombre || !val_raza){
                    error_formulario.innerHTML = "Algunos campos no son válidos, por favor corrija la información ingresada";
                    e.preventDefault();
                }else{
                    error_formulario.innerHTML = "";
                }
            }else{
                if(!val_direccion || !val_provincia || !val_canton || !val_distrito || !val_localidad){
                    error_formulario.innerHTML = "Algunos campos no son válidos, por favor corrija la información ingresada";
                    e.preventDefault();
                }else{
                    error_formulario.innerHTML = "";
                }
            }
        });

    }

    //Sigue la misma lógica del formulario  form_register
    if(form_reset != null){

        var password_actual = document.getElementById('password_actual');
        var password_1 = document.getElementById('password_1');
        var password_2 = document.getElementById('password_2');

        var error_password_actual = document.getElementById('error_password_actual');
        var error_password_1 = document.getElementById('error_password_1');
        var error_password_2 = document.getElementById('error_password_2');

        var error_formulario = document.getElementById('error_formulario');

        var btn_submit_reset = document.getElementById('btn_submit_reset');

        password_actual.addEventListener('keyup', (e)=>{

            var val_password_actual = validar_password(password_actual.value);
            if(!val_password_actual ){
                error_password_actual .innerHTML = "La contraseña debe estar conformada por mínimo y máximo doce caracteress, al menos una letra mayúscula, una letra minúscula, un número y un carácter especial";
            }else{
                error_password_actual .innerHTML = "";
            }
        });

        password_1.addEventListener('keyup', (e)=>{

            var val_password_1 = validar_password(password_1.value);
            if(!val_password_1 ){
                error_password_1.innerHTML = "La contraseña debe estar conformada por mínimo ocho y máximo doce caracteres, al menos una letra mayúscula, una letra minúscula, un número y un carácter especial";
            }else{
                error_password_1.innerHTML = "";
                val_password_1 = validar_equal_password(1);
            }
        });

        password_2.addEventListener('keyup', (e)=>{

            var val_password_2 = validar_password(password_2.value);
            if(!val_password_2 ){
                error_password_2.innerHTML = "La contraseña debe estar conformada por mínimo ocho y máximo doce caracteres, al menos una letra mayúscula, una letra minúscula, un número y un carácter especial";
            }else{
                error_password_2.innerHTML = "";
                val_password_2 = validar_equal_password(2);
            }
        });

        form_reset.addEventListener('submit', (e)=>{

            var val_password_actual = validar_password(password_actual.value);
            var val_password_1 = validar_password(password_1.value);
            var val_password_2 = validar_password(password_2.value);

            if( !val_password_1 || !val_password_2){
                error_formulario.innerHTML = "Algunos campos no son válidos, por favor corrija la información ingresada";
                e.preventDefault();
            }else{
                error_formulario.innerHTML = "";
            }
        });

        form_reset.addEventListener('enter', (e)=>{

            //var val_password_actual = validar_password(password_actual.value);
            var val_password_1 = validar_password(password_1.value);
            var val_password_2 = validar_password(password_2.value);

            if( !val_password_1 || !val_password_2){
                error_formulario.innerHTML = "Algunos campos no son válidos, por favor corrija la información ingresada";
                e.preventDefault();
            }else{
                error_formulario.innerHTML = "";
            }
        });

        form_reset.addEventListener('change', (e)=>{
            error_formulario.innerHTML = "";
        });

        btn_submit_reset.addEventListener('mouseover', (e)=>{

            //var val_password_actual = validar_password(password_actual.value);
            var val_password_1 = validar_password(password_1.value);
            var val_password_2 = validar_password(password_2.value);

            if(!val_password_1 || !val_password_2){
                error_formulario.innerHTML = "Algunos campos no son válidos, por favor corrija la información ingresada";
                e.preventDefault();
            }else{
                error_formulario.innerHTML = "";
            }
        });
    }
})

//Código encargado de configurar la barra de navegación para el responsive
function muestraBarra() {
    var x = document.getElementById("navBarResponsive");
    if (x.className === "nav_container") {
        x.className += " responsive";
    } else {
        x.className = "nav_container";
    }
}

