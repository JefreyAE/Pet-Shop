<?php if (isset($usuario)) : ?>
    <h1>Detalle del cliente</h1>

    <h3>Datos de la usuario</h3>
    <br />
    <div class="detalle detalle-usuario">
        <p><strong>Nombre:</strong> <?= $usuario->nombre ?></p>
        <p><strong>Cédula:</strong> <?= $usuario->cedula ?></p>
        <p><strong>Rol:</strong> <?= $usuario->rol ?></p>
        <p><strong>Dirección:</strong> <?= $usuario->direccion ?></p>
        <p><strong>Teléfono:</strong> <a href="tel:<?= $usuario->telefono ?>"><?= $usuario->telefono ?></a></p>
        <p><strong>Correo electrónico:</strong> <?= $usuario->email ?></p>
    </div>

<?php endif; ?>