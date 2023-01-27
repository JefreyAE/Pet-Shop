<h1>Detalle del producto</h1>
<?php if (isset($producto)): ?>   
    <div id='detail-product'>
        <div class="image">
            <?php if ($producto->imagen != null): ?>
                <img src="<?= base_url ?>uploads/imagenes/<?= $producto->imagen ?>">
            <?php else: ?>
                <img src="<?= base_url ?>assets/img/ImgenNoDisponible.jpg">
            <?php endif; ?>
        </div>
        <div class="data">
            <h2 class="description"><?= $producto->nombre ?></h2>
            <p class="price"><?= $producto->precio ?> colones</p>
            <h3>Descripción del producto:</h3>
            <br>
            <p class="price"><?= $producto->descripcion ?></p>
            <a href="<?=base_url?>Carrito/add_producto&id_producto=<?=$producto->id?>" class="button">Comprar</a>
        </div>
    </div>
<?php else: ?>
    <h1>El producto no existe.</h1>
<?php endif; ?>


