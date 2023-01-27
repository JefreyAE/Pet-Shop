<h1>Gestión de usuarios registrados</h1>

<table class="carrito">
    <tr>
        <th># de usuario</th>
        <th>Usuario</th>
        <th>Cédula</th>
        <th>Rol</th>
    </tr>
    <?php while ($usuario = $lista_usuarios->fetch_object()) : ?>
        <tr>
            <td><a href="<?= base_url ?>Usuario/detalle&usuario_id=<?= $usuario->id ?>"><?= $usuario->id ?></a></td>
            <td><a href="<?= base_url ?>Usuario/detalle&usuario_id=<?= $usuario->id ?>"><?= $usuario->nombre . ' ' . $usuario->apellidos ?></a></td>
            <td><?= $usuario->cedula ?></td>
            <td><?= $usuario->rol ?></td>
        </tr>
    <?php endwhile; ?>
</table>
<br>