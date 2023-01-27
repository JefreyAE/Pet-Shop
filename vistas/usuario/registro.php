<h1>Registrarse</h1>
<?php if (isset($_SESSION['register']) && $_SESSION['register'] == 'complete'): ?>
    <div class='alert'><strong>Registro completado correctamente.</strong></div>
<?php elseif (isset($_SESSION['register']) && $_SESSION['register'] == 'failed'): ?>
    <div class='alert alert-error'><strong>Registro fallido. Ingresa un correo diferente.</strong></div>
<?php endif; ?>
<?php Utilidades::deleteSession('register'); ?>    

<form id="form_registro" action="<?= base_url ?>Usuario/save" method="POST">
    <label for="nombre">Nombre</label>
    <?php if (isset($_SESSION['loadname'])): ?>
        <input type="text" id="nombre" name="nombre" value=<?= $_SESSION['loadname'] ?> required/> 
        <?php Utilidades::deleteSession('loadname'); ?>
    <?php else: ?>
        <input type="text" id="nombre" name="nombre" required/> 
    <?php endif; ?>  
    <label class="msj-error" id="error_nombre"></label> 
    <?php echo isset($_SESSION['errores']) ? Utilidades::showError($_SESSION['errores'], "nombre") : ''; ?>

    <label for="apellidos">Apellidos</label>
    <?php if(isset($_SESSION['loadapellidos'])): ?>
        <input type="text" id="apellidos" name="apellidos" value=<?= $_SESSION['loadapellidos'] ?> required/> 
        <?php Utilidades::deleteSession('loadapellidos'); ?>
    <?php else: ?>
        <input type="text" id="apellidos" name="apellidos" required/> 
    <?php endif; ?>
    <label class="msj-error" id="error_apellidos"></label>   
    <?php echo isset($_SESSION['errores']) ? Utilidades::showError($_SESSION['errores'], "apellidos") : ''; ?>

    <label for="cedula">Cédula</label>
    <?php if(isset($_SESSION['loadcedula'])): ?>
        <input type="text" id="cedula" name="cedula" value=<?= $_SESSION['loadcedula'] ?> placeholder="  Ejemplo: 101110111" title="La cédula debe tener el formato 1011110111" required/> 
        <?php Utilidades::deleteSession('loadcedula'); ?>
    <?php else: ?>
        <input type="text" id="cedula" name="cedula" placeholder="  Ejemplo: 101110111" title="La cédula debe tener el formato 1011110111" required/> 
    <?php endif; ?>
    <label class="msj-error" id="error_cedula"></label>   
    <?php echo isset($_SESSION['errores']) ? Utilidades::showError($_SESSION['errores'], "cedula") : ''; ?>

    <label for="email">Correo</label>
    <?php if (isset($_SESSION['loademail'])): ?>
        <input type="email" id="email" name="email" value=<?= $_SESSION['loademail'] ?> required/> 
        <?php Utilidades::deleteSession('loademail'); ?>
    <?php else: ?>
        <input type="email" id="email" name="email" required/> 
    <?php endif; ?> 
    <label class="msj-error" id="error_correo"></label> 
    <?php echo isset($_SESSION['errores']) ? Utilidades::showError($_SESSION['errores'], "email") : ''; ?>

    <label for="telefono">Teléfono</label>
    <?php if (isset($_SESSION['loadtelefono'])): ?>
        <input type="text" id="telefono" name="telefono" value=<?= $_SESSION['loadtelefono'] ?> title="El teléfono debe tener el formato 8888-8888 ó 88888888" required/> 
        <?php Utilidades::deleteSession('loadtelefono'); ?>
    <?php else: ?>
        <input type="text" id="telefono" name="telefono" required title="El teléfono debe tener el formato 8888-8888 ó 88888888"/> 
    <?php endif; ?> 
    <label class="msj-error" id="error_telefono"></label> 
    <?php echo isset($_SESSION['errores']) ? Utilidades::showError($_SESSION['errores'], "telefono") : ''; ?>

    <label for="direccion">Dirección</label>
    <?php if (isset($_SESSION['loaddireccion'])): ?>
        <textarea type="text" id="direccion" name="direccion"><?= $_SESSION['loaddireccion'] ?></textarea>
        <?php Utilidades::deleteSession('loaddireccion'); ?>
    <?php else: ?>
        <textarea type="text" id="direccion" name="direccion"></textarea>
    <?php endif; ?> 
    <label class="msj-error" id="error_direccion"></label> 
    <?php echo isset($_SESSION['errores']) ? Utilidades::showError($_SESSION['errores'], "direccion") : ''; ?>

    <label for="password_1">Ingrese la contraseña</label>
    <?php if (isset($_SESSION['loadpassword_1'])): ?>
        <input type="text" name="password_1" id="password_1" value=<?= $_SESSION['loadpassword_1'] ?> required title="Mínimo y máximo doce caracteres, al menos una letra mayúscula, una letra minúscula, un número y un carácter especial"/> 
        <?php Utilidades::deleteSession('loadpassword_1'); ?>
    <?php else: ?>
        <input type="text" name="password_1"  id="password_1" required title="Mínimo ocho y máximo doce caracteres, al menos una letra mayúscula, una letra minúscula, un número y un carácter especial"/> 
    <?php endif; ?>
    <label class="msj-error" id="error_password_1"></label>  
    <?php echo isset($_SESSION['errores']) ? Utilidades::showError($_SESSION['errores'], "password_1") : ''; ?>

    <label for="password_2">Repita la contraseña</label>
    <?php if (isset($_SESSION['loadpassword_2'])): ?>
        <input type="text" name="password_2"  id="password_2" value=<?= $_SESSION['loadpassword_2'] ?> required title="Mínimo y máximo doce caracteres, al menos una letra mayúscula, una letra minúscula, un número y un carácter especial"/> 
        <?php Utilidades::deleteSession('loadpassword_2'); ?>
    <?php else: ?>
        <input type="text" name="password_2"  id="password_2" required title="Mínimo ocho y máximo doce caracteress, al menos una letra mayúscula, una letra minúscula, un número y un carácter especial"/> 
    <?php endif; ?> 
    <label class="msj-error" id="error_password_2"></label> 
    <?php echo isset($_SESSION['errores']) ? Utilidades::showError($_SESSION['errores'], "password_2") : ''; ?>

    <label class="msj-error centrado" id="error_formulario"></label> 
    <input class="btn-form-submit" id="btn_submit_register" type="submit" value="Registrar">
</form>
<?php Utilidades::deleteError(); ?>
