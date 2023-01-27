<?php if (isset($_SESSION['combo_servicios']) && count($_SESSION['combo_servicios']) >= 1): ?>
    <h1>Servicios agregados al combo</h1>
    <table class="carrito">
        <tr>
            <th>Imagen</th>
            <th>Nombre</th>
            <th>Duración</th>
            <th>Precio</th>
            <th>Unidades</th>
        </tr>
        <?php
        foreach ($_SESSION['combo_servicios'] as $indice => $elemento):
            $servicio = $elemento['servicio']
            ?>
            <tr>
                <td>
                    <a href="<?= base_url ?>Servicio/ver&id=<?= $servicio->id ?>">
                        <?php if ($servicio->imagen != null): ?>
                            <img src="<?= base_url ?>uploads/imagenes/<?= $servicio->imagen ?>" class='img_carrito'>
                        <?php else: ?>
                            <img src="<?= base_url ?>assets/img/camiseta.png" class='img_carrito'>
                        <?php endif; ?>
                    </a>
                </td>
                <td>
                    <a href="<?= base_url ?>Servicio/ver&id=<?= $servicio->id ?>"><?= $servicio->nombre; ?></a>
                </td>
                <td><?= $servicio->duracion?> hora</td>
                <td><?= $servicio->precio ?></td>
                <td><?= $elemento['unidades']; ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
    <br>
    <div class="clearfix"></div>
    <div class="totales">
        <?php $stats_servicios = Utilidades::statsServiciosAgregados(); ?>
        <h3>Precio Total de Servicios: <?= $stats_servicios['total'] ?> colones</h3>
    </div>
<?php else: ?>
    <h3>No hay servicios para mostrar.</h3>
<?php endif; ?>
