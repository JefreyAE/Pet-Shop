<h1>Gestión de servicios.</h1>

<?php if (isset($_SESSION['delete']) && $_SESSION['delete'] == 'complete') : ?>
    <div class='alert'><strong>Borrado completado correctamente.</strong></div>
<?php elseif (isset($_SESSION['delete']) && $_SESSION['delete'] == 'failed') : ?>
    <div class='alert alert-error'><strong>Borrado fallido.</strong></div>
<?php endif; ?>
<?php Utilidades::deleteSession('delete') ?>

<a class="button button-small" href="<?= base_url ?>Servicio/create">
    Crear servicio
</a>
<table>
    <tr>
        <th>Id</th>
        <th>Nombre</th>
        <th>Descripción</th>
        <th>Precio</th>
        <th>Oferta</th>
        <th>Duración</th>
        <th>Fecha</th>
        <th>Imagen</th>
        <th>Acciones</th>
    </tr>
    <?php while ($servicio = $servicios->fetch_object()) : ?>
        <tr>
            <td><?= $servicio->id; ?></td>
            <td><?= $servicio->nombre; ?></td>
            <td><?= $servicio->descripcion; ?></td>
            <td><?= $servicio->precio; ?></td>
            <td><?= $servicio->oferta; ?></td>
            <td><?= $servicio->duracion; ?> horas</td>
            <td><?= $servicio->fecha; ?></td>
            <td>
                <?php if ($servicio->imagen != null): ?>
                    <img src="<?= base_url ?>uploads/imagenes/<?= $servicio->imagen ?>">
                <?php else: ?>
                    <img src="<?= base_url ?>assets/img/ImgenNoDisponible.jpg">
                <?php endif; ?>
            </td>
            <td>
                <a href="<?= base_url ?>Servicio/edit&id=<?= $servicio->id ?>" class="button button-action">Editar</a>
                <a href="<?= base_url ?>Servicio/delete&id=<?= $servicio->id ?>" class="button button-action button-red">Eliminar</a>
            </td>
        </tr>

    <?php endwhile; ?>
</table>