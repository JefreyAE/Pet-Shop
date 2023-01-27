<h1>Gestión de combos.</h1>

<?php if (isset($_SESSION['delete']) && $_SESSION['delete'] == 'complete') : ?>
    <div class='alert'><strong>Borrado completado correctamente.</strong></div>
<?php elseif (isset($_SESSION['delete']) && $_SESSION['delete'] == 'failed') : ?>
    <div class='alert alert-error'><strong>Borrado fallido.</strong></div>
<?php endif; ?>
<?php Utilidades::deleteSession('delete') ?>

<a class="button button-small" href="<?= base_url ?>Combo/create">
    Crear combo
</a>
<table>
    <tr>
        <th>Id</th>
        <th>Nombre</th>
        <th>Descripción</th>
        <th>Precio</th>
        <th>Oferta</th>
        <th>Fecha</th>
        <th>Imagen</th>
        <th>Acciones</th>
    </tr>
    <?php while ($combo = $combos->fetch_object()) : ?>
        <tr>
            <td><?= $combo->id; ?></td>
            <td><?= $combo->nombre; ?></td>
            <td><?= $combo->descripcion; ?></td>
            <td><?= $combo->precio; ?></td>
            <td><?= $combo->oferta; ?></td>
            <td><?= $combo->fecha; ?></td>
            <td>
                <?php if ($combo->imagen != null) : ?>
                    <img src="<?= base_url ?>uploads/imagenes/<?= $combo->imagen; ?>">
                <?php else : ?>
                    <img src="<?= base_url ?>assets/img/ImgenNoDisponible.jpg">
                <?php endif; ?>
            </td>
            <td>
                <a href="<?= base_url ?>Combo/edit&id=<?= $combo->id ?>" class="button button-action">Editar</a>
                <a href="<?= base_url ?>Combo/delete&id=<?= $combo->id ?>" class="button button-action button-red">Eliminar</a>
            </td>
        </tr>

    <?php endwhile; ?>
</table>