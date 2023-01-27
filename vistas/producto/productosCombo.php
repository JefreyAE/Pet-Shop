<?php if (isset($_SESSION['combo_productos']) && count($_SESSION['combo_productos']) >= 1): ?>
    <h1>Productos agregados al combo</h1>
    <table class="carrito">
        <tr>
            <th>Imagen</th>
            <th>Nombre</th>
            <th>Precio</th>
            <th>Unidades</th>
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
                </td>
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
    <p>No hay productos para mostrar.</p>
<?php endif; ?>
