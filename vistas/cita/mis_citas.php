<?php if ($gestion) : ?>
    <h1>Gestión de citas</h1>
<?php else : ?>
    <h1>Mis citas</h1>
<?php endif; ?>

<table class="carrito">
    <tr>
        <th># de cita</th>
        <?php if ($gestion) : ?>
            <th>Usuario</th>
            <th>Teléfono</th>
        <?php endif; ?>
        <th>Fecha</th>
        <th>Hora</th>
        <th>Duración estimada</th>
        <th># de orden</th>
        <th>Estado</th>
    </tr>
    <?php while ($cita = $lista_citas->fetch_object()) : ?>
        <tr>
            <td><a href="<?= base_url ?>Cita/detalle&cita_id=<?= $cita->id ?>&orden_id=<?= $cita->orden_id ?>"><?= $cita->id ?></a></td>
            <?php if ($gestion) : ?>
                <td><a href="<?= base_url ?>Usuario/detalle&usuario_id=<?= $cita->usuario_id ?>"><?= $cita->nombre . ' ' . $cita->apellidos ?></a></td>
                <td><?= $cita->telefono ?></td>
            <?php endif; ?>
            <td><?= $cita->fecha ?></td>
            <td><?= Utilidades::obtenerHora($cita->hora) < 6 ? Utilidades::obtenerHora($cita->hora) . ':00 pm' : Utilidades::obtenerHora($cita->hora) . ':00 am' ?></td>
            <td><?= $cita->duracion ?></td>
            <td><a href="<?= base_url ?>Orden/detalle&id=<?= $cita->orden_id ?>"><?= $cita->orden_id ?></a></td>
            <td><?= $cita->estado ?></td>
        </tr>
    <?php endwhile; ?>
</table>
<br>