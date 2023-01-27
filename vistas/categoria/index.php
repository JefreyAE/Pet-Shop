<h1>Gestionar categorías.</h1>
<a class="button button-small" href="<?=base_url?>Categoria/create">Crear categoría</a>
<table >
    <tr>
        <th>Número de Id</th>
        <th>Nombre de categoría</th>
        <th>Acciones</th>
    </tr>
<?php while($cat = $categorias->fetch_object()): ?>
    <tr>
        <td><?=$cat->id;?></td>
        <td><?=$cat->nombre;?></td>
        <td>
            <a href="<?= base_url ?>Categoria/delete&id=<?= $cat->id ?>" class="button button-action button-red">Eliminar</a>
        </td>
    </tr>
<?php endwhile; ?>
</table>

