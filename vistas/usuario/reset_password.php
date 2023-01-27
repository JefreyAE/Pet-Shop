<?php if (isset($_SESSION['renovar_password'] )): ?>
    <h1>Se requiere un cambio de contraseña</h1>
<?php else: ?>
    <h1>Cambio de contraseña</h1>
<?php endif; ?>

<?php if (isset($_SESSION['reset']) && $_SESSION['reset'] == 'complete'): ?>
    <div class='alert'><strong>Cambio de contraseña completado correctamente.</strong></div>
<?php elseif (isset($_SESSION['reset']) && $_SESSION['reset'] == 'failed'): ?>
    <div class='alert alert-error'><strong>Reseteo fallido</strong></div>
<?php endif; ?>
<?php Utilidades::deleteSession('reset'); ?>    

<form id="form_reset" action="<?= base_url ?>Usuario/reset" method="POST">
    <label for="password_actual">Ingresa tu clave actual</label>
    <?php if (isset($_SESSION['loadpassword_actual'])): ?>
        <input type="text" id="password_actual" name="password_actual" value=<?= $_SESSION['loadpassword_actual'] ?> required/> 
        <?php Utilidades::deleteSession('loadpassword_actual'); ?>
    <?php else: ?>
        <input type="text" id="password_actual" name="password_actual" required/> 
    <?php endif; ?>  
    <label class="msj-error" id="error_password_actual"></label> 
    <?php echo isset($_SESSION['errores']) ? Utilidades::showError($_SESSION['errores'], "password_actual") : ''; ?>

    <label for="password_1">Ingrese la nueva contraseña</label>
    <?php if (isset($_SESSION['loadpassword_1'])): ?>
        <input type="text" name="password_1" id="password_1" value=<?= $_SESSION['loadpassword_1'] ?> required title="Mínimo ocho y máximo doce caracteres, al menos una letra mayúscula, una letra minúscula, un número y un carácter especial"/> 
        <?php Utilidades::deleteSession('loadpassword_1'); ?>
    <?php else: ?>
        <input type="text" name="password_1"  id="password_1" required title="Mínimo ocho y máximo doce caracteres, al menos una letra mayúscula, una letra minúscula, un número y un carácter especial"/> 
    <?php endif; ?>
    <label class="msj-error" id="error_password_1"></label>  
    <?php echo isset($_SESSION['errores']) ? Utilidades::showError($_SESSION['errores'], "password_1") : ''; ?>

    <label for="password_2">Repita la nueva contraseña</label>
    <?php if (isset($_SESSION['loadpassword_2'])): ?>
        <input type="text" name="password_2"  id="password_2" value=<?= $_SESSION['loadpassword_2'] ?> required title="Mínimo ocho y máximo doce caracteres, al menos una letra mayúscula, una letra minúscula, un número y un carácter especial"/> 
        <?php Utilidades::deleteSession('loadpassword_2'); ?>
    <?php else: ?>
        <input type="text" name="password_2"  id="password_2" required title="Mínimo ocho y máximo doce caracteres, al menos una letra mayúscula, una letra minúscula, un número y un carácter especial"/> 
    <?php endif; ?> 
    <label class="msj-error" id="error_password_2"></label> 
    <?php echo isset($_SESSION['errores']) ? Utilidades::showError($_SESSION['errores'], "password_2") : ''; ?>

    <label class="msj-error centrado" id="error_formulario"></label> 
    <input class="btn-form-submit" id="btn_submit_reset" type="submit" value="Cambiar contraseña">
</form>
<?php Utilidades::deleteError(); ?>
