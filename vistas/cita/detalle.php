<?php if (isset($cita)) : ?>
    <h1>Detalle de la cita</h1>

    <h3>Datos de la cita</h3>
    <table class="separador">
        <tr>
            <th>Cliente</th>
            <th>Hora</th>
            <th>Fecha</th>
            <th>Duración</th>
            <th>Descripción</th>
            <th>Teléfono 1</th>
            <th>Teléfono 2</th>
            <th>Mascota</th>
            <th>Raza</th>
        </tr>
        <tr>
            <td><a href="<?= base_url ?>Usuario/detalle&usuario_id=<?= $usuario->id ?>"><?= $usuario->nombre . ' ' . $usuario->apellidos ?></a></td>
            <td><?= Utilidades::obtenerHora($cita->hora) < 6 ? Utilidades::obtenerHora($cita->hora) . ':00 pm' : Utilidades::obtenerHora($cita->hora) . ':00 am' ?></td>
            <td><?= $cita->fecha ?></td>
            <td><?= $cita->duracion ?></td>
            <td><?= $cita->descripcion ?></td>
            <td><?= $cita->telefono_1 ?></td>
            <td><?= $cita->telefono_2 ?></td>
            <td><?= $cita->nombre ?></td>
            <td><?= $cita->raza ?></td>
        </tr>
    </table>
    <br>
    <?php if($cita->estado == "Habilitada"):?>
        <a href="<?= base_url ?>Cita/cancelarCita&cita_id=<?= $cita->id ?>&orden_id=<?= $orden->id ?>" class="button button-action button-red float_left width_40">Cancelar cita y orden</a>
    <?php else: ?>
        <div class='alert alert-error'><strong>La cita ha sido cancelada.</strong></div>
    <?php endif;?>
        <br>
    <div class="separador"></div>
    <br>
    <h3>Datos de la orden</h3>
    <table class="separador">
        <tr>
            <th>Número de orden</th>
            <th>Estado</th>
            <th>Total a pagar</th> 
        </tr>
        <tr>
            <td><a href="<?= base_url ?>Orden/detalle&id=<?= $orden->id ?>"><?= $orden->id ?></a></td>
            <td><?= Utilidades::showStatus($orden->estado) ?></td>
            <td><?= $orden->coste ?> colones</td>
        </tr>
    </table>
  
    <br>
    <h3>Productos:</h3> <br />

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
        <h3>Total a pagar: <?= $orden->coste ?> colones</h3>
    </div>
<?php endif; ?>