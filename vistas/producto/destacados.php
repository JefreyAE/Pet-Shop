<h1>Algunos de nuestros productos</h1>
<?php if (isset($list)): ?>
    <?php while ($product = $list->fetch_object()): ?>
        <div class="product">
            <a href="<?php base_url ?>Producto/ver&id=<?= $product->id ?>">
                <?php if ($product->imagen != null): ?>
                    <img src="<?= base_url ?>uploads/imagenes/<?= $product->imagen ?>">
                <?php else: ?>
                    <img src="<?= base_url ?>assets/img/ImgenNoDisponible.jpg">
                <?php endif; ?>
                <h2><?= $product->nombre ?></h2>
            </a>
                <p><?= $product->precio ?> colones</p>
            <a href="<?=base_url?>Carrito/add_producto&id_producto=<?=$product->id?>" class="button">Comprar</a>
        </div>
    <?php endwhile; ?>
<?php endif; ?>

