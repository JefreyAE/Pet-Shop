<?php if ($gestion): ?>
    <h1>Gestión de órdenes</h1>
<?php else: ?>
    <h1>Mis órdenes</h1>
<?php endif; ?>
    <table class="carrito">
        <tr>
            <th># de orden</th>
            <?php if ($gestion) : ?>
                <th>Usuario</th>
            <?php endif; ?>
            <th>Coste</th>
            <th>Fecha</th>
            <th>Estado</th>
        </tr>
        <?php
        while ($orden = $lista_ordenes->fetch_object()):
            ?>
            <tr>
                <td><a href="<?= base_url ?>Orden/detalle&id=<?= $orden->id ?>"><?= $orden->id ?></a></td>
                <?php if ($gestion) : ?>
                    <td><a href="<?= base_url ?>Usuario/detalle&usuario_id=<?= $orden->usuario_id ?>"><?= $orden->nombre . ' ' . $orden->apellidos ?></a></td>
                <?php endif; ?>
                <td><?= $orden->coste ?> colones</td>
                <td><?= $orden->fecha ?></td>
                <td><?= $orden->estado ?></td>
            </tr>
        <?php endwhile; ?>
    </table>
<br>







