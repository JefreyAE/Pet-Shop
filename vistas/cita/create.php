<?php if (isset($_SESSION['crear_cita'])) : ?>
    <?php if ($_SESSION['crear_cita']) : ?>
        <div class="clearfix"></div>
        <h1>Su pedido requiere que agende una cita.</h1>

        <?php if (isset($_SESSION['orden']) && $_SESSION['orden'] == 'complete') : ?>
            <!--<div class='alert'><strong>orden completado correctamente.</strong></div>-->
        <?php elseif (isset($_SESSION['orden']) && $_SESSION['orden'] == 'failed') : ?>
            <div class='alert alert-error'><strong>Orden fallida.</strong></div>
        <?php endif; ?>

        <?php echo isset($_SESSION['erroresCita']) ? Utilidades::showError($_SESSION['erroresCita'], "disponibilidad") : ''; ?>

        <div id="form_cita_fecha">
            <div class="form_container">
            <p>Por favor seleccione el día y hora que mas le convenga según la disponibilidad.</p>
            <h2 class="titulo-2-citas">Seleccione el día:</h2>
                <form action="<?= base_url ?>Agenda/horas_disponibles" method="POST">
                    <select name="fecha">
                        <?php if (isset($_SESSION['fecha_cita'])) : ?>
                            <option value="<?= $_SESSION['fecha_cita'] ?>" selected><?= $_SESSION['fecha_cita'] ?></option>
                        <?php endif; ?>
                        <?php foreach ($_SESSION['dias_disponibles'] as $indice => $dia) : ?>
                            <option value="<?= $_SESSION['dias_disponibles'][$indice] ?>"><?= $_SESSION['dias_disponibles'][$indice] ?></option>
                        <?php endforeach; ?>
                    </select>
                    <?php if (isset($_SESSION['dias_disponibles'][0])) : ?>
                        <input  class="btn-form-submit" type="submit" value="Seleccionar" />
                    <?php endif; ?>
                </form>
            </div>
        </div>
        <div class="separador"></div>
        <?php if (isset($_SESSION['horario'])) : ?>
        <div class="form_container">
        <form action="<?= base_url ?>Orden/add" id="form_orden" method="POST">
            
                <h2 class="titulo-2-citas">Seleccione la hora de su cita:</h2>

                    <div class="radio_btn_div">
                        <input type="radio" name="hora" value="hora_7am_cita_id" <?= $_SESSION['horario']->hora_7am_cita_id == "disponible" ? '' : "disabled" ?> />
                        <label class="label_citas <?= $_SESSION['horario']->hora_7am_cita_id == "disponible" ? 'color_green' : "color_red" ?>">De 7:00 am a 8:00 am - <?= $_SESSION['horario']->hora_7am_cita_id == "disponible" ? 'Disponible' : "No disponible" ?></label>
                    </div>
                    <div class="radio_btn_div">
                        <input type="radio" name="hora" value="hora_8am_cita_id" <?= $_SESSION['horario']->hora_8am_cita_id == "disponible" ? '' : "disabled" ?> />
                        <label class="label_citas <?= $_SESSION['horario']->hora_8am_cita_id == "disponible" ? 'color_green' : "color_red" ?>">De 8:00 am a 9:00 am - <?= $_SESSION['horario']->hora_8am_cita_id == "disponible" ? 'Disponible' : "No disponible" ?></label>
                    </div>
                    <div class="radio_btn_div">
                        <input type="radio" name="hora" value="hora_9am_cita_id" <?= $_SESSION['horario']->hora_9am_cita_id == "disponible" ? '' : "disabled" ?> />
                        <label class="label_citas <?= $_SESSION['horario']->hora_9am_cita_id == "disponible" ? 'color_green' : "color_red" ?>">De 9:00 am a 10:00 am - <?= $_SESSION['horario']->hora_9am_cita_id == "disponible" ? 'Disponible' : "No disponible" ?></label>
                    </div>
                    <div class="radio_btn_div">
                        <input type="radio" name="hora" value="hora_10am_cita_id" <?= $_SESSION['horario']->hora_10am_cita_id == "disponible" ? '' : "disabled" ?> />
                        <label class="label_citas <?= $_SESSION['horario']->hora_10am_cita_id == "disponible" ? 'color_green' : "color_red" ?>">De 10:00 am a 11:00 am - <?= $_SESSION['horario']->hora_10am_cita_id == "disponible" ? 'Disponible' : "No disponible" ?></label>
                    </div>
                    <div class="radio_btn_div">
                        <input type="radio" name="hora" value="hora_11am_cita_id" <?= $_SESSION['horario']->hora_11am_cita_id == "disponible" ? '' : "disabled" ?> />
                        <label class="label_citas <?= $_SESSION['horario']->hora_11am_cita_id == "disponible" ? 'color_green' : "color_red" ?>">De 11:00 am a 12:00 am - <?= $_SESSION['horario']->hora_11am_cita_id == "disponible" ? 'Disponible' : "No disponible" ?></label>
                    </div>
                    <div class="radio_btn_div">
                        <input type="radio" name="hora" value="hora_12am_cita_id" <?= $_SESSION['horario']->hora_12am_cita_id == "disponible" ? '' : "disabled" ?> />
                        <label class="label_citas <?= $_SESSION['horario']->hora_12am_cita_id == "disponible" ? 'color_green' : "color_red" ?>">De 12:00 am a 1:00 pm - <?= $_SESSION['horario']->hora_12am_cita_id == "disponible" ? 'Disponible' : "No disponible" ?></label>
                    </div>
                    <div class="radio_btn_div">
                        <input type="radio" name="hora" value="hora_1pm_cita_id" <?= $_SESSION['horario']->hora_1pm_cita_id == "disponible" ? '' : "disabled" ?> />
                        <label class="label_citas <?= $_SESSION['horario']->hora_1pm_cita_id == "disponible" ? 'color_green' : "color_red" ?>">De 1:00 pm a 2:00 pm - <?= $_SESSION['horario']->hora_1pm_cita_id == "disponible" ? 'Disponible' : "No disponible" ?></label>
                    </div>
                    <div class="radio_btn_div">
                        <input type="radio" name="hora" value="hora_2pm_cita_id" <?= $_SESSION['horario']->hora_2pm_cita_id == "disponible" ? '' : "disabled" ?> />
                        <label class="label_citas <?= $_SESSION['horario']->hora_2pm_cita_id == "disponible" ? 'color_green' : "color_red" ?>">De 2:00 pm a 3:00 pm - <?= $_SESSION['horario']->hora_2pm_cita_id == "disponible" ? 'Disponible' : "No disponible" ?></label>
                    </div>
                    <div class="radio_btn_div">
                        <input type="radio" name="hora" value="hora_3pm_cita_id" <?= $_SESSION['horario']->hora_3pm_cita_id == "disponible" ? '' : "disabled" ?> />
                        <label class="label_citas <?= $_SESSION['horario']->hora_3pm_cita_id == "disponible" ? 'color_green' : "color_red" ?>">De 3:00 pm a 4:00 pm - <?= $_SESSION['horario']->hora_3pm_cita_id == "disponible" ? 'Disponible' : "No disponible" ?></label>
                    </div>
                    <div class="radio_btn_div">
                        <input type="radio" name="hora" value="hora_4pm_cita_id" <?= $_SESSION['horario']->hora_4pm_cita_id == "disponible" ? '' : "disabled" ?> />
                        <label class="label_citas <?= $_SESSION['horario']->hora_4pm_cita_id == "disponible" ? 'color_green' : "color_red" ?>">De 4:00 pm a 5:00 pm - <?= $_SESSION['horario']->hora_4pm_cita_id == "disponible" ? 'Disponible' : "No disponible" ?></label>
                    </div>
                    <div class="radio_btn_div">
                        <input type="radio" name="hora" value="hora_5pm_cita_id" <?= $_SESSION['horario']->hora_5pm_cita_id == "disponible" ? '' : "disabled" ?> />
                        <label class="label_citas <?= $_SESSION['horario']->hora_5pm_cita_id == "disponible" ? 'color_green' : "color_red" ?>">De 5:00 pm a 6:00 pm - <?= $_SESSION['horario']->hora_5pm_cita_id == "disponible" ? 'Disponible' : "No disponible" ?></label>
                    </div>
                    <br>
                    <label for="descripcion">Por favor ingrese una breve descripción si su mascota padece de alguna alergía o padecimiento</label>
                    <?php if (isset($_SESSION['idCita'])) : ?>
                        <textarea id="descripcion" name="descripcion" required><?= $cita->descripcion ?></textarea>
                    <?php elseif (isset($_SESSION['loaddescripcion'])) : ?>
                        <textarea id="descripcion" name="descripcion"><?= $_SESSION['loaddescripcion'] ?></textarea>
                        <?php Utilidades::deleteSession('loaddescripcion'); ?>
                    <?php else : ?>
                        <textarea id="descripcion" name="descripcion" required></textarea>
                    <?php endif; ?>
                    <label class="msj-error" id="error_descripcion"></label> 
                    <?php echo isset($_SESSION['erroresCita']) ? Utilidades::showError($_SESSION['erroresCita'], "nombre") : ''; ?>

                    <label for="telefono_1">Ingrese el teléfono de contacto #1</label>
                    <?php if (isset($_SESSION['idCita'])) : ?>
                        <input type="text" id="telefono_1" name="telefono_1" value="<?= $cita->telefono_1 ?>" required title="El teléfono debe tener el formato 8888-8888 ó 88888888">
                    <?php elseif (isset($_SESSION['loadtelefono_1'])) : ?>
                        <input type="text" id="telefono_1" name="telefono_1" value="<?= $_SESSION['loadtelefono_1'] ?>" required title="El teléfono debe tener el formato 8888-8888 ó 88888888"/>
                        <?php Utilidades::deleteSession('loadtelefono_1'); ?>
                    <?php else : ?>
                        <input type="text" id="telefono_1" name="telefono_1" required title="El teléfono debe tener el formato 8888-8888 ó 88888888"/>
                    <?php endif; ?>
                    <label class="msj-error" id="error_telefono_1"></label> 
                    <?php echo isset($_SESSION['erroresCita']) ? Utilidades::showError($_SESSION['erroresCita'], "telefono_1") : ''; ?>

                    <label for="telefono_2">Ingrese el teléfono de contacto #2</label>
                    <?php if (isset($_SESSION['idCita'])) : ?>
                        <input type="text" id="telefono_2" name="telefono_2" value="<?= $cita->telefono_2 ?>" title="El teléfono debe tener el formato 8888-8888 ó 88888888">
                    <?php elseif (isset($_SESSION['loadtelefono_2'])) : ?>
                        <input type="text" id="telefono_2" name="telefono_2" value="<?= $_SESSION['loadtelefono_2'] ?>" required title="El teléfono debe tener el formato 8888-8888 ó 88888888"/>
                        <?php Utilidades::deleteSession('loadtelefono_2'); ?>
                    <?php else : ?>
                        <input  type="text" id="telefono_2" name="telefono_2" required title="El teléfono debe tener el formato 8888-8888 ó 88888888"/>
                    <?php endif; ?>
                    <label class="msj-error" id="error_telefono_2"></label> 
                    <?php echo isset($_SESSION['erroresCita']) ? Utilidades::showError($_SESSION['erroresCita'], "telefono_2") : ''; ?>
                    
                    <label for="nombre">Ingrese el nombre de la mascota</label>
                    <?php if (isset($_SESSION['idCita'])) : ?>
                        <input type="text" id="nombre" name="nombre" value="<?= $cita->nombre ?>" required>
                    <?php elseif (isset($_SESSION['loadnombre'])) : ?>
                        <input type="text" id="nombre" name="nombre" value="<?= $_SESSION['loadnombre'] ?>" required />
                        <?php Utilidades::deleteSession('loadnombre'); ?>
                    <?php else : ?>
                        <input type="text" id="nombre" name="nombre" required />
                    <?php endif; ?>
                    <label class="msj-error" id="error_nombre"></label> 
                    <?php echo isset($_SESSION['erroresCita']) ? Utilidades::showError($_SESSION['erroresCita'], "nombre") : ''; ?>

                    <label for="raza">Ingrese la raza de la mascota</label>
                    <?php if (isset($_SESSION['idCita'])) : ?>
                        <input type="text" id="raza" name="raza" value="<?= $cita->raza ?>" required>
                    <?php elseif (isset($_SESSION['loadraza'])) : ?>
                        <input type="text" id="raza" name="raza" value="<?= $_SESSION['loadraza'] ?>" required />
                        <?php Utilidades::deleteSession('loadraza'); ?>
                    <?php else : ?>
                        <input type="text" id="raza" name="raza" required />
                    <?php endif; ?>
                    <label class="msj-error" id="error_raza"></label> 
                    <?php echo isset($_SESSION['erroresCita']) ? Utilidades::showError($_SESSION['erroresCita'], "raza") : ''; ?>

                    <?php $stats = Utilidades::statsCarrito(); ?>
                    <input type="hidden" name="duracion" value="<?= $_SESSION['duracion_total'] ?>" />
                    <input type="hidden" name="fecha" value="<?= $_SESSION['fecha_cita'] ?>" />
                    <input type="hidden" name="monto" value="<?= $stats['total'] ?>" />
                    <input type="hidden" name="usuario_id" value="<?= $_SESSION['identity']->id ?>" />
                    <input type="hidden" name="agenda_id" value="<?= $_SESSION['horario']->id ?>" />
     
        <?php endif; ?>
        <?php Utilidades::deleteSession('fecha_cita'); ?>
        <?php Utilidades::deleteError() ?>
        <?php endif; ?>                
    <?php endif; ?>