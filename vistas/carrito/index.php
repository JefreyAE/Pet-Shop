<h1>Carrito de Compras</h1>
<table class="carrito">
    <tr>
        <th>Imagen</th>
        <th>Nombre</th>
        <th>Tipo</th>
        <th>Precio</th>
        <th>Unidades</th>
        <th>Acciones</th>
    </tr>
    <?php if (isset($_SESSION['carrito_productos']) && count($_SESSION['carrito_productos']) >= 1) : ?>
        <?php foreach ($_SESSION['carrito_productos'] as $indice => $elemento) :  $producto = $elemento['producto'] ?>
            <tr>
                <td>
                    <a href="<?= base_url ?>Producto/ver&id=<?= $producto->id ?>">
                        <?php if ($producto->imagen != null) : ?>
                            <img src="<?= base_url ?>uploads/imagenes/<?= $producto->imagen ?>" class='img_carrito'>
                        <?php else : ?>
                            <img src="<?= base_url ?>assets/img/ImgenNoDisponible.jpg" class='img_carrito'>
                        <?php endif; ?>
                    </a>
                </td>
                <td>
                    <a href="<?= base_url ?>Producto/ver&id=<?= $producto->id ?>"><?= $producto->nombre; ?></a>
                </td>
                <td>Producto</td>
                <td><?= $producto->precio ?></td>
                <td>

                    <?= $elemento['unidades']; ?>
                    <div class="updown-unidades">
                        <a href="<?= base_url ?>Carrito/up_producto&indice=<?= $indice ?>" class="button">+</a>
                        <a href="<?= base_url ?>Carrito/down_producto&indice=<?= $indice ?>" class="button ">-</a>
                    </div>
                </td>
                <td><a href="<?= base_url ?>Carrito/remove_producto&indice=<?= $indice ?>" class="button button-carrito button-red">Quitar</a></td>
            </tr>
        <?php endforeach; ?>
    <?php endif; ?>

    <?php if (isset($_SESSION['carrito_servicios']) && count($_SESSION['carrito_servicios']) >= 1) : ?>
        <?php foreach ($_SESSION['carrito_servicios'] as $indice => $elemento) :
            $servicio = $elemento['servicio'] ?>
            <tr>
                <td>
                    <a href="<?= base_url ?>Servicio/ver&id=<?= $servicio->id ?>">
                        <?php if ($servicio->imagen != null) : ?>
                            <img src="<?= base_url ?>uploads/imagenes/<?= $servicio->imagen ?>" class='img_carrito'>
                        <?php else : ?>
                            <img src="<?= base_url ?>assets/img/ImgenNoDisponible.jpg" class='img_carrito'>
                        <?php endif; ?>
                    </a>
                </td>
                <td>
                    <a href="<?= base_url ?>Servicio/ver&id=<?= $servicio->id ?>"><?= $servicio->nombre; ?></a>
                </td>
                <td>Servicio</td>
                <td><?= $servicio->precio ?></td>
                <td>
                    <?= $elemento['unidades']; ?>
                    <div class="updown-unidades">
                        <a href="<?= base_url ?>Carrito/up_servicio&indice=<?= $indice ?>" class="button">+</a>
                        <a href="<?= base_url ?>Carrito/down_servicio&indice=<?= $indice ?>" class="button ">-</a>
                    </div>
                </td>
                <td><a href="<?= base_url ?>Carrito/remove_servicio&indice=<?= $indice ?>" class="button button-carrito button-red">Quitar</a></td>
            </tr>
        <?php endforeach; ?>
    <?php endif; ?>

    <?php if (isset($_SESSION['carrito_combos']) && count($_SESSION['carrito_combos']) >= 1) : ?>
        <?php foreach ($_SESSION['carrito_combos'] as $indice => $elemento) :
            $combo = $elemento['combo'] ?>
            <tr>
                <td>
                    <a href="<?= base_url ?>Combo/ver&id=<?= $combo->id ?>">
                        <?php if ($combo->imagen != null) : ?>
                            <img src="<?= base_url ?>uploads/imagenes/<?= $combo->imagen ?>" class='img_carrito'>
                        <?php else : ?>
                            <img src="<?= base_url ?>assets/img/ImgenNoDisponible.jpg" class='img_carrito'>
                        <?php endif; ?>
                    </a>
                <td>
                    <a href="<?= base_url ?>Combo/ver&id=<?= $combo->id ?>"><?= $combo->nombre; ?></a>
                </td>
                <td>Combo</td>
                <td><?= $combo->precio ?></td>
                <td>
                    <?= $elemento['unidades']; ?>
                    <div class="updown-unidades">
                        <a href="<?= base_url ?>Carrito/up_combo&indice=<?= $indice ?>" class="button">+</a>
                        <a href="<?= base_url ?>Carrito/down_combo&indice=<?= $indice ?>" class="button ">-</a>
                    </div>
                </td>
                <td><a href="<?= base_url ?>Carrito/remove_combo&indice=<?= $indice ?>" class="button button-carrito button-red">Quitar</a></td>
            </tr>
        <?php endforeach; ?>
    <?php endif; ?>
</table>
<br>
<div class="delete-carrito">
    <a href="<?= base_url ?>Carrito/delete_all" class="button button-red">Vaciar carrito</a>
</div>
<div class="total-carrito">
    <?php $stats = Utilidades::statsCarrito(); ?>
    <h3>Precio Total: <?= $stats['total'] ?> colones</h3>
    <a href="<?= base_url ?>Orden/index" class="button button-pedido">Realizar orden</a>
</div>
<div class="clearfix"></div>
<?php if (isset($_SESSION['carrito_vacio'])): ?>
    <div class='alert alert-error separador'><strong><?=$_SESSION['carrito_vacio']?></strong></div>
    <?php Utilidades::deleteSession('carrito_vacio') ?>
<?php endif; ?>