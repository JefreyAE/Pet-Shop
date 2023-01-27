<?php if (isset($_SESSION['orden']) && $_SESSION['orden'] == 'complete') : ?>
    <h1>Tu orden se ha confirmado</h1>
    <p>
        Tu orden ha sido guardada, una vez realices la transferencia
        bancaria a la cuenta <?= numero_iban ?> o al número de SINPE móvil <?= telefono_sinpe ?> y te comuniques con la vendedora, será procesada.
    </p>
    <br>
    <?php if (isset($orden)) : ?>
        <h3>Datos del orden</h3>
        <br />
        <p>Número de orden: <?= $orden->id ?> </p>
        <p>Total a pagar: <?= $orden->coste ?> colones </p><br/>
        <h3>Productos: </h3><br />

        <table class="carrito">
            <tr>
                <th>Imagen</th>
                <th>Nombre</th>
                <th>Precio</th>
                <th>Unidades</th>
            </tr>
            <?php if (isset($lista_productos)) : ?>
                <?php while ($producto = $lista_productos->fetch_object()) : ?>
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
                        <td><?= $producto->precio ?></td>
                        <td><?= $producto->unidades ?></td>
                    </tr>
                <?php endwhile; ?>
            <?php endif; ?>
            <?php if (isset($lista_servicios)) : ?>
                <?php while ($servicio = $lista_servicios->fetch_object()) : ?>
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
                        <td><?= $servicio->precio ?></td>
                        <td><?= $servicio->unidades ?></td>
                    </tr>
                <?php endwhile; ?>
            <?php endif; ?>
            <?php if (isset($lista_combos)) : ?>
                <?php while ($combo = $lista_combos->fetch_object()) : ?>
                    <tr>
                        <td>
                            <a href="<?= base_url ?>Combo/ver&id=<?= $combo->id ?>">
                                <?php if ($combo->imagen != null) : ?>
                                    <img src="<?= base_url ?>uploads/imagenes/<?= $combo->imagen ?>" class='img_carrito'>
                                <?php else : ?>
                                    <img src="<?= base_url ?>assets/img/ImgenNoDisponible.jpg" class='img_carrito'>
                                <?php endif; ?>
                            </a>
                        </td>
                        <td>
                            <a href="<?= base_url ?>Combo/ver&id=<?= $combo->id ?>"><?= $combo->nombre; ?></a>
                        </td>
                        <td><?= $combo->precio ?></td>
                        <td><?= $combo->unidades ?></td>
                    </tr>
                <?php endwhile; ?>
            <?php endif; ?>
        </table>
        <br>
        <div class="total-carrito">
            <?php $stats = Utilidades::statsCarrito(); ?>
            <h3>Total a pagar: <?= $stats['total'] ?> colones</h3>
        </div>

    <?php else : ?>
    <?php endif; ?>
<?php elseif (isset($_SESSION['orden']) && $_SESSION['orden'] != 'complete') : ?>
    <h1>Tu orden NO se ha confirmado</h1>
<?php endif; ?>