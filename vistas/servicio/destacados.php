<h1>Algunos de nuestros servicios</h1>
<?php if (isset($list)): ?>
    <?php while ($servicio = $list->fetch_object()): ?>
        <div class="product">
            <a href="<?php base_url ?>Servicio/ver&id=<?= $servicio->id ?>">
                <?php if ($servicio->imagen != null): ?>
                    <img src="<?= base_url ?>uploads/imagenes/<?= $servicio->imagen ?>">
                <?php else: ?>
                    <img src="<?= base_url ?>assets/img/ImgenNoDisponible.jpg">
                <?php endif; ?>
                <h2><?= $servicio->nombre ?></h2>
            </a>
                <p><?= $servicio->precio ?> euros</p>
            <a href="<?=base_url?>Carrito/add&id=<?=$servicio->id?>" class="button">Comprar</a>
        </div>
    <?php endwhile; ?>
<?php endif; ?>

