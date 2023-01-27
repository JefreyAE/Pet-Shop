
<?php if ($edit == true): ?>
    <h1>Editar combo.</h1>
    <?= $url = base_url . "Combo/update"; ?>
<?php else: ?>
    <h1>Crear nuevo combo.</h1>
    <?= $url = base_url . "Combo/save"; ?>
<?php endif; ?>

<?php if (isset($_SESSION['regCombo']) && $_SESSION['regCombo'] == 'complete'): ?>
    <div class='alert'><strong>Registro completado correctamente.</strong></div>
<?php elseif (isset($_SESSION['regCombo']) && $_SESSION['regCombo'] == 'failed'): ?>
    <div class='alert alert-error'><strong>Registro fallido.</strong></div>
<?php endif; ?>
<?php Utilidades::deleteSession('regCombo'); ?>  

<?php if (isset($_SESSION['idCombo'])): ?>
    <?php $combo = Utilidades::showCombo($_SESSION['idCombo'])->fetch_object(); ?>
<?php endif; ?>     

<div class="form_container">
    <form action="<?= $url ?>" method="POST" enctype="multipart/form-data">

        <label for="nombre">Nombre del combo</label>
        <?php if (isset($_SESSION['idCombo'])): ?>
            <input type="text" name="nombre" value=<?= $combo->nombre ?> required/> 
        <?php elseif (isset($_SESSION['loadname'])): ?>
            <input type="text" name="nombre" value=<?= $_SESSION['loadname'] ?> required/> 
            <?php Utilidades::deleteSession('loadname'); ?>
        <?php else: ?>
            <input type="text" name="nombre" required>
        <?php endif; ?>   
        <?php echo isset($_SESSION['erroresCombo']) ? Utilidades::showError($_SESSION['erroresCombo'], "nombre") : ''; ?>
        <label for="descripcion">Descripción</label>
        <?php if (isset($_SESSION['idCombo'])): ?>
            <textarea name="descripcion" required><?= $combo->descripcion ?> </textarea>
        <?php elseif (isset($_SESSION['loaddescripcion'])): ?>
            <textarea name="descripcion" required><?= $_SESSION['loaddescripcion'] ?></textarea> 
            <?php Utilidades::deleteSession('loaddescripcion'); ?>
        <?php else: ?>
            <textarea name="descripcion" required></textarea>
        <?php endif; ?>   
        <?php echo isset($_SESSION['erroresCombo']) ? Utilidades::showError($_SESSION['erroresCombo'], "descripcion") : ''; ?>

        <label for="precio">Precio</label>
        <?php if (isset($_SESSION['idCombo'])): ?>
            <input type="number" name="precio" value=<?= $combo->precio ?> required/> 
        <?php elseif (isset($_SESSION['loadprecio'])): ?>
            <input type="number" name="precio" value=<?= $_SESSION['loadprecio'] ?> required/> 
            <?php Utilidades::deleteSession('loadprecio'); ?>
        <?php else: ?>
            <input type="number" name="precio" required>
        <?php endif; ?>   
        <?php echo isset($_SESSION['erroresCombo']) ? Utilidades::showError($_SESSION['erroresCombo'], "precio") : ''; ?>

        <label for="oferta">Oferta</label>
        <?php if (isset($_SESSION['idCombo'])): ?>
            <input type="text" name="oferta" value=<?= $combo->oferta ?> required/> 
        <?php elseif (isset($_SESSION['loadoferta'])): ?>
            <input type="text" name="oferta" value=<?= $_SESSION['loadoferta'] ?> required/> 
            <?php Utilidades::deleteSession('loadoferta'); ?>
        <?php else: ?>
            <input type="text" name="oferta" required>
        <?php endif; ?>   
        <?php echo isset($_SESSION['erroresCombo']) ? Utilidades::showError($_SESSION['erroresCombo'], "oferta") : ''; ?>

        <label for="imagen">Imagen</label>
        <input type="file" name="imagen" required>

        <input type="hidden" name="id" value='<?= $_GET['id'] ?>'>

        <input class="btn-form-submit" type="submit" name="submit" value="Editar">
    </form>
    <?php Utilidades::deleteError() ?>
</div>