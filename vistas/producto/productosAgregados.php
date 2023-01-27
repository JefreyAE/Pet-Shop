<?php if (isset($_SESSION['combo_productos']) && count($_SESSION['combo_productos']) >= 1): ?>
    <h1>Productos agregados al combo</h1>
    <table class="carrito">
        <tr>
            <th>Imagen</th>
            <th>Nombre</th>
            <th>Precio</th>
            <th>Unidades</th>
            <th>Acciones</th>
        </tr>
        <?php
        foreach ($_SESSION['combo_productos'] as $indice => $elemento):
            $producto = $elemento['producto']
            ?>
            <tr>
                <td>
                    <a href="<?= base_url ?>Producto/ver&id=<?= $producto->id ?>">
                        <?php if ($producto->imagen != null): ?>
                            <img src="<?= base_url ?>uploads/imagenes/<?= $producto->imagen ?>" class='img_carrito'>
                        <?php else: ?>
                            <img src="<?= base_url ?>assets/img/ImgenNoDisponible.jpg" class='img_carrito'>
                        <?php endif; ?>
                    </a>
                </td>
                <td>
                    <a href="<?= base_url ?>Producto/ver&id=<?= $producto->id ?>"><?= $producto->nombre; ?></a>
                </td>
                <td><?= $producto->precio ?></td>
                <td>
                    <?= $elemento['unidades']; ?>
                    <div class="updown-unidades">
                        <a href="<?= base_url ?>Combo/up_producto&indice=<?= $indice ?>" class="button">+</a>
                        <a href="<?= base_url ?>Combo/down_producto&indice=<?= $indice ?>" class="button ">-</a>
                    </div>
                </td>
                <td><a href="<?= base_url ?>Combo/remove_producto&indice=<?= $indice ?>" class="button button-carrito button-red">Quitar</a></td>
            </tr>
        <?php endforeach; ?>
    </table>
    <br>
    <div class="clearfix"></div>
    <div class="totales">
        <?php $stats_productos = Utilidades::statsProductosAgregados(); ?>
        <h3>Precio Total de Productos: <?= $stats_productos['total'] ?> colones</h3>
    </div>
<?php else: ?>
    <h3>No hay productos para mostrar.</h3>
<?php endif; ?>
