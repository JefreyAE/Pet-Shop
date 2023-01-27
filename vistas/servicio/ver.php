<h1>Detalle del servicio</h1>
<?php if (isset($servicio)): ?>   
    <div id='detail-product'>
        <div class="image">
            <?php if ($servicio->imagen != null): ?>
                <img src="<?= base_url ?>uploads/imagenes/<?= $servicio->imagen ?>">
            <?php else: ?>
                <img src="<?= base_url ?>assets/img/camiseta.png">
            <?php endif; ?>
        </div>
        <div class="data">
            <h2 class="description"><?= $servicio->nombre ?></h2>
            <p class="price"><?= $servicio->precio ?> colones</p>
            <h3>Descripción del servicio:</h3>
            <br>
            <p class="price"><?= $servicio->descripcion ?></p>
            <a href="<?=base_url?>Carrito/add_servicio&id_servicio=<?=$servicio->id?>" class="button">Comprar</a>
        </div>
    </div>
<?php else: ?>
    <h1>El servicio no existe.</h1>
<?php endif; ?>


