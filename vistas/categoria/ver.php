<?php if (isset($categoria)) : ?>
    <h1><?= $categoria->nombre ?></h1>
    <?php if ($listProducts->num_rows != 0) : ?>
        <?php while ($product = $listProducts->fetch_object()) : ?>
            <div class="product">
                <a href="<?php base_url ?>../Producto/ver&id=<?= $product->id ?>">
                    <?php if ($product->imagen != null) : ?>
                        <img src="<?= base_url ?>uploads/imagenes/<?= $product->imagen ?>">
                    <?php else : ?>
                        <img src="<?= base_url ?>assets/img/ImgenNoDisponible.jpg">
                    <?php endif; ?>
                    <h2><?= $product->nombre ?></h2>
                    <h2>Tipo: Producto</h2>
                </a>
                <p><?= $product->precio ?> colones</p>
                <a href="<?= base_url ?>Carrito/add_producto&id_producto=<?= $product->id ?>" class="button">Comprar</a>
            </div>
        <?php endwhile; ?>
    <?php endif; ?>
    <?php if ($listServicios->num_rows != 0) : ?>
        <?php while ($servicio = $listServicios->fetch_object()) : ?>
            <div class="product">
                <a href="<?php base_url ?>../Servicio/ver&id=<?= $servicio->id ?>">
                    <?php if ($servicio->imagen != null) : ?>
                        <img src="<?= base_url ?>uploads/imagenes/<?= $servicio->imagen ?>">
                    <?php else : ?>
                        <img src="<?= base_url ?>assets/img/ImgenNoDisponible.jpg">
                    <?php endif; ?>
                    <h2><?= $servicio->nombre ?></h2>
                    <h2>Tipo: Servicio</h2>
                    <h2>Duración <?= $servicio->duracion ?> horas</h2>
                </a>
                <p><?= $servicio->precio ?> colones</p>
                <a href="<?= base_url ?>Carrito/add_servicio&id_servicio=<?= $servicio->id ?>" class="button">Comprar</a>
            </div>
        <?php endwhile; ?>
    <?php endif; ?>
    <?php if ($listServicios->num_rows == 0 && $listProducts->num_rows == 0) : ?>
        <p>No hay productos para mostrar.</p>
    <?php endif; ?>

<?php else : ?>
    <h1>La categoría no existe</h1>
<?php endif; ?>