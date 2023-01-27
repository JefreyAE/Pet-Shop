<?php if (isset($_SESSION['idCombo'])): ?>
    <h1>Editar Combo.</h1>
    <?php $url = base_url . "Combo/save&id=".$_SESSION['idCombo']; ?>
    <?php $boton = "Modificar"; ?>
<?php else: ?>
    <h1>Crear nuevo Combo.</h1>
    <?php $url = base_url . "Combo/save"; ?>
    <?php $boton = "Crear"; ?>
<?php endif; ?>

<?php if (isset($_SESSION['regCombo']) && $_SESSION['regCombo'] == 'complete'): ?>
    <div class='alert'><strong>Registro completado correctamente.</strong></div>
<?php elseif (isset($_SESSION['regCombo']) && $_SESSION['regCombo'] == 'failed'): ?>
    <div class='alert alert-error'><strong>Registro fallido.</strong></div>
<?php endif; ?>
<?php if (isset($_SESSION['combo_vacio'])): ?>
    <div class='alert alert-error separador'><strong><?=$_SESSION['combo_vacio']?></strong></div>
    <?php Utilidades::deleteSession('combo_vacio') ?>
<?php endif; ?>

<?php Utilidades::deleteSession('regCombo'); ?>  

<?php if (isset($_SESSION['idCombo'])): ?>
    <?php $combo = Utilidades::showCombo($_SESSION['idCombo'])->fetch_object(); ?>
<?php endif; ?>     

<div class="form_container">
    
    <form action="<?= $url ?>" id="form_combo" method="POST" enctype="multipart/form-data">

        <label for="nombre">Nombre del combo</label>
        <?php if (isset($_SESSION['idCombo'])): ?>
            <input type="text" id="nombre" name="nombre" value=<?= $combo->nombre ?> required/> 
        <?php elseif (isset($_SESSION['loadname'])): ?>
            <input type="text" id="nombre" name="nombre" value=<?= $_SESSION['loadname'] ?> required/> 
            <?php Utilidades::deleteSession('loadname'); ?>
        <?php else: ?>
            <input type="text" id="nombre" name="nombre" required>
        <?php endif; ?>  
        <label class="msj-error" id="error_nombre"></label>   
        <?php echo isset($_SESSION['erroresCombo']) ? Utilidades::showError($_SESSION['erroresCombo'], "nombre") : ''; ?>
        
        <label for="descripcion">Descripción</label>
        <?php if (isset($_SESSION['idCombo'])): ?>
            <textarea id="descripcion" name="descripcion" required><?= $combo->descripcion ?> </textarea>
        <?php elseif (isset($_SESSION['loaddescripcion'])): ?>
            <textarea id="descripcion" name="descripcion" required><?= $_SESSION['loaddescripcion'] ?></textarea> 
            <?php Utilidades::deleteSession('loadname'); ?>
        <?php else: ?>
            <textarea id="descripcion" name="descripcion" required></textarea>
        <?php endif; ?> 
        <label class="msj-error" id="error_descripcion"></label>  
        <?php echo isset($_SESSION['erroresCombo']) ? Utilidades::showError($_SESSION['erroresCombo'], "descripcion") : ''; ?>

        <label for="precio">Precio</label>
        <?php if (isset($_SESSION['idCombo'])): ?>
            <?php if(isset($_SESSION['combo_productos']) || isset($_SESSION['combo_servicios'])): ?>
                <?php $_total_price = Utilidades::statsServiciosAgregados()['total'] + Utilidades::statsProductosAgregados()['total'] ?>
                <input type="number" id="precio" name="precio" value=<?= $combo->precio ?> required/> 
                <label for="precio">Costo de productos y servicios: <?= $_total_price ?></label>
            <?php else: ?>
                <input type="number" id="precio" name="precio" value=<?= $combo->precio ?> required/> 
            <?php endif; ?>   
        <?php elseif (isset($_SESSION['loadprecio'])): ?>
            <input type="number" id="precio"  name="precio" value=<?= $_SESSION['loadprecio'] ?> required/> 
            <?php Utilidades::deleteSession('loadprecio'); ?>
        <?php elseif(isset($_SESSION['combo_productos']) || isset($_SESSION['combo_servicios'])): ?>
            <?php $_total_price = Utilidades::statsServiciosAgregados()['total'] + Utilidades::statsProductosAgregados()['total'] ?>
            <input type="number" id="precio" name="precio" value=<?= $_total_price ?> required/> 
        <?php else: ?>
            <input type="number" id="precio" name="precio" required>
        <?php endif; ?>    
        <label class="msj-error" id="error_precio"></label> 
        <?php echo isset($_SESSION['erroresCombo']) ? Utilidades::showError($_SESSION['erroresCombo'], "precio") : ''; ?>

        <label for="oferta">Oferta</label>
        <select name="oferta" >
            <?php if (isset($_SESSION['idCombo'])): ?>
                <?php if ($combo->oferta == "1"): ?>
                    <option value="1" selected>Si</option>
                    <option value="0">No</option>
                <?php else: ?>
                    <option value="1">Si</option>
                    <option value="0" selected>No</option>
                <?php endif; ?>    
            <?php else: ?>  
                <option value="1">Si</option>
                <option value="0" selected>No</option>
            <?php endif; ?>
        </select>  
        <?php if (isset($_SESSION['loadoferta'])): ?>
            <?php Utilidades::deleteSession('loadoferta'); ?>
        <?php endif; ?>  
        <?php echo isset($_SESSION['erroresCombo']) ? Utilidades::showError($_SESSION['erroresCombo'], "oferta") : ''; ?>

        <label for="imagen">Imagen</label>
        <?php if (isset($_SESSION['idCombo']) && !empty($combo->imagen)): ?>
            <img src="<?= base_url ?>uploads/imagenes/<?= $combo->imagen; ?>">
        <?php endif; ?>
        <input type="file" name="imagen" >

        <?php if (isset($_SESSION['idCombo'])): ?>
            <input type="hidden" value="<?= $combo->id ?>" name="id">
        <?php endif; ?>
        <label class="msj-error centrado" id="error_formulario"></label> 
        <input class="btn-form-submit" id="btn_submit_combo" type="submit" value="<?= $boton ?>">
    </form>
    <?php Utilidades::deleteError() ?>
</div>
<div class="separador"></div>

<?php require_once 'vistas/servicio/serviciosAgregados.php' ?>
<?php require_once 'vistas/producto/productosAgregados.php'; ?>
<?php require_once 'vistas/producto/listado.php'; ?>
<?php require_once 'vistas/servicio/listado.php'; ?>