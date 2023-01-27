<?php if (isset($orden)) : ?>
    <h1>Detalle de la orden</h1>
    <div class="container_basic">
            <h3>Datos para pago de la orden:</h3>
            <br>
            <p>Puedes realizar la transferencia
            bancaria a la cuenta CR 4901 0200 0092 8226 7297 o al número de SINPE móvil 8731-1111</p>
    </div>
    <br>
    <?php if (isset($_SESSION['admin'])) : ?>
        <div class="container_basic">
            <h3>Cambiar estado de la orden:</h3>
            <form action="<?= base_url ?>Orden/estado" method="post">
                <input type="hidden" value="<?= $orden->id ?>" name="orden_id" />
                <input type="hidden" value="<?= $orden->usuario_id ?>" name="usuario_id" />
                <input type="hidden" value="<?= $orden->coste ?>" name="coste" />
                <label for='estado'>Cambiar estado:</label>
                <select name="estado">
                    <option value="Confirmada" <?= (($orden->estado) == 'Confirmada' ? 'selected' : ''); ?>>Pendiente</option>
                    <option value="Preparación" <?= (($orden->estado) == 'Preparación' ? 'selected' : ''); ?>>En preparación</option>
                    <option value="Lista" <?= (($orden->estado) == 'Lista' ? 'selected' : ''); ?>>Preparado para enviar</option>
                    <option value="Enviada" <?= (($orden->estado) == 'Enviada' ? 'selected' : ''); ?>>Enviada</option>
                    <option value="Procesada" <?= (($orden->estado) == 'Procesada' ? 'selected' : ''); ?>>Procesada</option>
                    <option value="Cancelada" <?= (($orden->estado) == 'Cancelada' ? 'selected' : ''); ?>>Cancelada</option>
                </select>
                <input type="submit" class="btn-form-submit" value="Cambiar estado" />
            </form>
        </div>
        <br>
    <?php endif; ?>
    
    <div class="detalle detalle-orden">
            <h3 class="separador">Datos del envío:</h3>
            <table class="separador">
                <tr>
                    <th>Provincia</th>
                    <th>Cantón</th>
                    <th>Distrito</th>
                    <th>Localidad</th>
                    <th>Dirección</th>
                </tr>
                <tr>
                    <td><?= $orden->provincia ?></td>
                    <td><?= $orden->canton ?></td>
                    <td><?= $orden->distrito ?></td>
                    <td><?= $orden->localidad ?></td>
                    <td><?= $orden->direccion ?></td>
                </tr>
            </table>

            <h3 class="separador">Datos de la orden:</h3>
            <table class="separador">
                <tr>
                    <th>Estado</th>
                    <th>Número de orden</th>
                    <th>Total a pagar</th>
                </tr>
                <tr>
                    <td><?= Utilidades::showStatus($orden->estado) ?></td>
                    <td><?= $id ?></td>
                    <td><?= $orden->coste ?></td>
                </tr>
            </table>
               
        <h3 class="separador">Productos:</h3> <br />

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