<h1>Detalle del combo</h1>
<?php if (isset($combo)): ?>   
    <div id='detail-product'>
        <div class="image">
            <?php if ($combo->imagen != null): ?>
                <img src="<?= base_url ?>uploads/imagenes/<?= $combo->imagen ?>">
            <?php else: ?>
                <img src="<?= base_url ?>assets/img/ImgenNoDisponible.jpg">
            <?php endif; ?>
        </div>
        <div class="data">
            <h2 class="description"><?= $combo->nombre ?></h2>
            <p class="price"><?= $combo->precio ?> colones</p>
            <h3>Descripción del combo:</h3>
            <br>
            <p class="price"><?= $combo->descripcion ?></p>
            <a href="<?=base_url?>Carrito/add_combo&id_combo=<?=$combo->id?>" class="button">Comprar</a>
        </div>
    </div>
    <div class="clearfix"></div>
    <?php require_once 'vistas/servicio/serviciosCombo.php' ?>
    <?php require_once 'vistas/producto/productosCombo.php'; ?>
<?php else: ?>
    <h1>El combo no existe.</h1>
<?php endif; ?>


