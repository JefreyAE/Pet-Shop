<h1>Gestión de agenda</h1>
<?php if (isset($_SESSION['delete']) && $_SESSION['delete'] == 'complete') : ?>
    <div class='alert'><strong>Borrado completado correctamente.</strong></div>
<?php elseif (isset($_SESSION['delete']) && $_SESSION['delete'] == 'failed') : ?>
    <div class='alert alert-error'><strong>No es posible borrar una agenda con citas asociadas.</strong></div>
<?php endif; ?>
<?php Utilidades::deleteSession('delete') ?>
<a class="button button-small" href="<?= base_url ?>Agenda/create">
    Habilitar agenda
</a>
<table id="tabla-agenda">
    <tr>
        <th>Fecha</th>
        <!--<th>6am-7am</th>-->
        <th>7am-8am</th>
        <th>8am-9am</th>
        <th>9am-10am</th>
        <th>10am-11am</th>
        <th>11am-12am</th>
        <th>12pm-1pm</th>
        <th>1pm-2pm</th>
        <th>2pm-3pm</th>
        <th>3pm-4pm</th>
        <th>4pm-5pm</th>
        <th>5pm-6pm</th>
        <th>Opciones</th>
    </tr>
    <?php if (isset($agendas)) : ?>
        <?php while ($agenda = $agendas->fetch_object()) : ?>
            <tr>
                <td><?= $agenda->fecha; ?></td>
                <!--<td><?= $agenda->hora_6am_cita_id; ?></td>-->
                <?php if ($agenda->hora_7am_cita_id == "disponible") : ?>
                    <td><img src="<?= base_url ?>assets/img/disponible.png"></td>
                <?php elseif ($agenda->hora_7am_cita_id == "no_disponible") : ?>
                    <td><img src="<?= base_url ?>assets/img/no_disponible.png"></td>
                <?php else : ?>
                    <td><a href="<?= base_url ?>Cita/detalle&cita_id=<?= $agenda->hora_7am_cita_id ?>&orden_id=<?= $orden->getOrdenByCita($agenda->hora_7am_cita_id)->orden_id ?>">Ver cita</a></td>
                <?php endif; ?>
                <?php if ($agenda->hora_8am_cita_id == "disponible") : ?>
                    <td><img src="<?= base_url ?>assets/img/disponible.png"></td>
                <?php elseif ($agenda->hora_8am_cita_id == "no_disponible") : ?>
                    <td><img src="<?= base_url ?>assets/img/no_disponible.png"></td>
                <?php else : ?>
                    <td><a href="<?= base_url ?>Cita/detalle&cita_id=<?= $agenda->hora_8am_cita_id ?>&orden_id=<?= $orden->getOrdenByCita($agenda->hora_8am_cita_id)->orden_id ?>">Ver cita</a></td>
                <?php endif; ?>
                <?php if ($agenda->hora_9am_cita_id == "disponible") : ?>
                    <td><img src="<?= base_url ?>assets/img/disponible.png"></td>
                <?php elseif ($agenda->hora_9am_cita_id == "no_disponible") : ?>
                    <td><img src="<?= base_url ?>assets/img/no_disponible.png"></td>
                <?php else : ?>
                    <td><a href="<?= base_url ?>Cita/detalle&cita_id=<?= $agenda->hora_9am_cita_id ?>&orden_id=<?= $orden->getOrdenByCita($agenda->hora_9am_cita_id)->orden_id ?>">Ver cita</a></td>
                <?php endif; ?>
                <?php if ($agenda->hora_10am_cita_id == "disponible") : ?>
                    <td><img src="<?= base_url ?>assets/img/disponible.png"></td>
                <?php elseif ($agenda->hora_10am_cita_id == "no_disponible") : ?>
                    <td><img src="<?= base_url ?>assets/img/no_disponible.png"></td>
                <?php else : ?>
                    <td><a href="<?= base_url ?>Cita/detalle&cita_id=<?= $agenda->hora_10am_cita_id ?>&orden_id=<?= $orden->getOrdenByCita($agenda->hora_10am_cita_id)->orden_id ?>">Ver cita</a></td>
                <?php endif; ?>
                <?php if ($agenda->hora_11am_cita_id == "disponible") : ?>
                    <td><img src="<?= base_url ?>assets/img/disponible.png"></td>
                <?php elseif ($agenda->hora_11am_cita_id == "no_disponible") : ?>
                    <td><img src="<?= base_url ?>assets/img/no_disponible.png"></td>
                <?php else : ?>
                    <td><a href="<?= base_url ?>Cita/detalle&cita_id=<?= $agenda->hora_11am_cita_id ?>&orden_id=<?= $orden->getOrdenByCita($agenda->hora_11am_cita_id)->orden_id ?>">Ver cita</a></td>
                <?php endif; ?>
                <?php if ($agenda->hora_12am_cita_id == "disponible") : ?>
                    <td><img src="<?= base_url ?>assets/img/disponible.png"></td>
                <?php elseif ($agenda->hora_12am_cita_id == "no_disponible") : ?>
                    <td><img src="<?= base_url ?>assets/img/no_disponible.png"></td>
                <?php else : ?>
                    <td><a href="<?= base_url ?>Cita/detalle&cita_id=<?= $agenda->hora_12am_cita_id ?>&orden_id=<?= $orden->getOrdenByCita($agenda->hora_12am_cita_id)->orden_id ?>">Ver cita</a></td>
                <?php endif; ?>

                <?php if ($agenda->hora_1pm_cita_id == "disponible") : ?>
                    <td><img src="<?= base_url ?>assets/img/disponible.png"></td>
                <?php elseif ($agenda->hora_1pm_cita_id == "no_disponible") : ?>
                    <td><img src="<?= base_url ?>assets/img/no_disponible.png"></td>
                <?php else : ?>
                    <td><a href="<?= base_url ?>Cita/detalle&cita_id=<?= $agenda->hora_1pm_cita_id ?>&orden_id=<?= $orden->getOrdenByCita($agenda->hora_1pm_cita_id)->orden_id ?>">Ver cita</a></td>
                <?php endif; ?>
                <?php if ($agenda->hora_2pm_cita_id == "disponible") : ?>
                    <td><img src="<?= base_url ?>assets/img/disponible.png"></td>
                <?php elseif ($agenda->hora_2pm_cita_id == "no_disponible") : ?>
                    <td><img src="<?= base_url ?>assets/img/no_disponible.png"></td>
                <?php else : ?>
                    <td><a href="<?= base_url ?>Cita/detalle&cita_id=<?= $agenda->hora_2pm_cita_id ?>&orden_id=<?= $orden->getOrdenByCita($agenda->hora_2pm_cita_id)->orden_id ?>">Ver cita</a></td>
                <?php endif; ?>
                <?php if ($agenda->hora_3pm_cita_id == "disponible") : ?>
                    <td><img src="<?= base_url ?>assets/img/disponible.png"></td>
                <?php elseif ($agenda->hora_3pm_cita_id == "no_disponible") : ?>
                    <td><img src="<?= base_url ?>assets/img/no_disponible.png"></td>
                <?php else : ?>
                    <td><a href="<?= base_url ?>Cita/detalle&cita_id=<?= $agenda->hora_3pm_cita_id ?>&orden_id=<?= $orden->getOrdenByCita($agenda->hora_3pm_cita_id)->orden_id ?>">Ver cita</a></td>
                <?php endif; ?>
                <?php if ($agenda->hora_4pm_cita_id == "disponible") : ?>
                    <td><img src="<?= base_url ?>assets/img/disponible.png"></td>
                <?php elseif ($agenda->hora_4pm_cita_id == "no_disponible") : ?>
                    <td><img src="<?= base_url ?>assets/img/no_disponible.png"></td>
                <?php else : ?>
                    <td><a href="<?= base_url ?>Cita/detalle&cita_id=<?= $agenda->hora_4pm_cita_id ?>&orden_id=<?= $orden->getOrdenByCita($agenda->hora_4pm_cita_id)->orden_id ?>">Ver cita</a></td>
                    <?php endif; ?><?php if ($agenda->hora_5pm_cita_id == "disponible") : ?>
                    <td><img src="<?= base_url ?>assets/img/disponible.png"></td>
                <?php elseif ($agenda->hora_5pm_cita_id == "no_disponible") : ?>
                    <td><img src="<?= base_url ?>assets/img/no_disponible.png"></td>
                <?php else : ?>
                    <td><a href="<?= base_url ?>Cita/detalle&cita_id=<?= $agenda->hora_5pm_cita_id ?>&orden_id=<?= $orden->getOrdenByCita($agenda->hora_5pm_cita_id)->orden_id ?>">Ver cita</a></td>
                <?php endif; ?>

                <!--<td><?= $agenda->hora_6pm_cita_id; ?></td>-->
                <td>
                    <a href="<?= base_url ?>Agenda/edit&id=<?= $agenda->id ?>" class="button button-action">Editar</a>
                    <a href="<?= base_url ?>Agenda/delete&id=<?= $agenda->id ?>" class="button button-action button-red">Eliminar</a>
                </td>
            </tr>
        <?php endwhile; ?>
    <?php endif; ?>
</table>