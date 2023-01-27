<?php if (isset($_SESSION['idAgenda'])) : ?>
    <h1>Editar Agenda.</h1>
    <?php $url = base_url . "Agenda/habilitar&id=" . $_SESSION['idAgenda']; ?>
    <?php $boton = "Modificar"; ?>
<?php else : ?>
    <h1>Habilitar agenda.</h1>
    <?php $url = base_url . "Agenda/habilitar"; ?>
    <?php $boton = "Habilitar"; ?>
<?php endif; ?>

<?php if (isset($_SESSION['regAgenda']) && $_SESSION['regAgenda'] == 'complete') : ?>
    <div class='alert'><strong>Registro completado correctamente.</strong></div>
<?php elseif (isset($_SESSION['regAgenda']) && $_SESSION['regAgenda'] == 'failed') : ?>
    <div class='alert alert-error'><strong>Registro fallido.</strong></div>
    <?php if (isset($_SESSION['checkFecha'])) : ?>
        <div class='alert alert-error'><strong><?= $_SESSION['checkFecha'] ?></strong></div>
        <?php Utilidades::deleteSession('checkFecha') ?>
    <?php endif; ?>
<?php endif; ?>
<?php Utilidades::deleteSession('regAgenda'); ?>

<?php if (isset($_SESSION['idAgenda'])) : ?>
    <?php $agenda = Utilidades::showAgenda($_SESSION['idAgenda'])->fetch_object(); ?>
<?php endif; ?>

<div class="form_agenda">
    <form action="<?= $url ?>" method="POST">

        <label for="fecha">Seleccione la fecha:</label>
        <?php if (isset($_SESSION['idAgenda'])) : ?>
            <input type="date" name="fecha" value=<?= $agenda->fecha ?> required />
        <?php elseif (isset($_SESSION['loadname'])) : ?>
            <input type="date" name="fecha" value=<?= $_SESSION['loadfecha'] ?> required />
            <?php Utilidades::deleteSession('loadfecha'); ?>
        <?php else : ?>
            <input type="date" name="fecha" style="width:50%" required>
        <?php endif; ?>

        <label id="title_seleccion" for="hora_6am_cita_id">Seleccione las horas que desea que esten disponibles para las citas:</label>
        <!--<?php if (isset($_SESSION['idAgenda'])) : ?>
            <input class="agenda_checkbox" type="checkbox" name="hora_6am_cita_id" value=<?= $agenda->hora_6am_cita_id ?> checked />
        <?php elseif (isset($_SESSION['loadhora_6am_cita_id'])) : ?>
            <input class="agenda_checkbox" type="checkbox" name="hora_6am_cita_id" value=<?= $_SESSION['loadhora_6am_cita_id'] ?> checked />
            <?php Utilidades::deleteSession('loadhora_6am_cita_id'); ?>
        <?php elseif (isset($_SESSION['no_checked_hora_6am_cita_id'])) : ?>
            <?php Utilidades::deleteSession('no_checked_hora_6am_cita_id'); ?>
            <input class="agenda_checkbox" type="checkbox" name="hora_6am_cita_id" value="disponible" />
        <?php else : ?>
            <input class="agenda_checkbox" type="checkbox" name="hora_6am_cita_id" value="disponible" checked />
        <?php endif; ?>
        <label class="checkboxs_label" for="hora_6am_cita_id">De 6:00 am a 7:00 am</label>
        -->

        <?php if (isset($_SESSION['idAgenda'])) : ?>
            <input class="agenda_checkbox" type="checkbox" name="hora_7am_cita_id" checked <?= is_numeric($_SESSION['horario']->hora_7am_cita_id) ? "disabled" : ""?> value="<?=!is_numeric($_SESSION['horario']->hora_7am_cita_id) ? "disponible" : $_SESSION['horario']->hora_7am_cita_id ?>" />
        <?php elseif (isset($_SESSION['loadhora_7am_cita_id'])) : ?>
            <input class="agenda_checkbox" type="checkbox" name="hora_7am_cita_id" value="disponible" checked />
            <?php Utilidades::deleteSession('loadhora_7am_cita_id'); ?>
        <?php elseif (isset($_SESSION['no_checked_hora_7am_cita_id'])) : ?>
            <?php Utilidades::deleteSession('no_checked_hora_7am_cita_id'); ?>
            <input class="agenda_checkbox" type="checkbox" name="hora_7am_cita_id" value="disponible" />
        <?php else : ?>
            <input class="agenda_checkbox" type="checkbox" name="hora_7am_cita_id" value="disponible" checked />
        <?php endif; ?>
            <label class="checkboxs_label" for="hora_7am_cita_id" >De 7:00 am a 8:00 am</label>


        <?php if (isset($_SESSION['idAgenda'])) : ?>
            <input class="agenda_checkbox" type="checkbox" name="hora_8am_cita_id" checked <?= is_numeric($_SESSION['horario']->hora_8am_cita_id) ? "disabled" : ""?> value="<?=!is_numeric($_SESSION['horario']->hora_8am_cita_id) ? "disponible" : $_SESSION['horario']->hora_8am_cita_id ?>" />
        <?php elseif (isset($_SESSION['loadhora_8am_cita_id'])) : ?>
            <input class="agenda_checkbox" type="checkbox" name="hora_8am_cita_id" value="disponible" checked />
            <?php Utilidades::deleteSession('loadhora_8am_cita_id'); ?>
        <?php elseif (isset($_SESSION['no_checked_hora_8am_cita_id'])) : ?>
            <?php Utilidades::deleteSession('no_checked_hora_8am_cita_id'); ?>
            <input class="agenda_checkbox" type="checkbox" name="hora_8am_cita_id" value="disponible" />
        <?php else : ?>
            <input class="agenda_checkbox" type="checkbox" name="hora_8am_cita_id" value="disponible" checked />
        <?php endif; ?>
        <label class="checkboxs_label" for="hora_8am_cita_id">De 8:00 am a 9:00 am</label>


        <?php if (isset($_SESSION['idAgenda'])) : ?>
            <input class="agenda_checkbox" type="checkbox" name="hora_9am_cita_id" checked <?= is_numeric($_SESSION['horario']->hora_9am_cita_id) ? "disabled" : ""?> value="<?=!is_numeric($_SESSION['horario']->hora_9am_cita_id) ? "disponible" : $_SESSION['horario']->hora_9am_cita_id ?>"  />
        <?php elseif (isset($_SESSION['loadhora_9am_cita_id'])) : ?>
            <input class="agenda_checkbox" type="checkbox" name="hora_9am_cita_id" value="disponible" checked />
            <?php Utilidades::deleteSession('loadhora_9am_cita_id'); ?>
        <?php elseif (isset($_SESSION['no_checked_hora_9am_cita_id'])) : ?>
            <?php Utilidades::deleteSession('no_checked_hora_9am_cita_id'); ?>
            <input class="agenda_checkbox" type="checkbox" name="hora_9am_cita_id" value="disponible" />
        <?php else : ?>
            <input class="agenda_checkbox" type="checkbox" name="hora_9am_cita_id" value="disponible" checked />
        <?php endif; ?>
        <label class="checkboxs_label" for="hora_9am_cita_id">De 9:00 am a 10:00 am</label>


        <?php if (isset($_SESSION['idAgenda'])) : ?>
            <input class="agenda_checkbox" type="checkbox" name="hora_10am_cita_id" checked <?= is_numeric($_SESSION['horario']->hora_10am_cita_id) ? "disabled" : ""?> value="<?=!is_numeric($_SESSION['horario']->hora_10am_cita_id) ? "disponible" : $_SESSION['horario']->hora_10am_cita_id ?>" />
        <?php elseif (isset($_SESSION['loadhora_10am_cita_id'])) : ?>
            <input class="agenda_checkbox" type="checkbox" name="hora_10am_cita_id" value="disponible" checked />
            <?php Utilidades::deleteSession('loadhora_10am_cita_id'); ?>
        <?php elseif (isset($_SESSION['no_checked_hora_10am_cita_id'])) : ?>
            <?php Utilidades::deleteSession('no_checked_hora_10am_cita_id'); ?>
            <input class="agenda_checkbox" type="checkbox" name="hora_10am_cita_id" value="disponible" />
        <?php else : ?>
            <input class="agenda_checkbox" type="checkbox" name="hora_10am_cita_id" value="disponible" checked />
        <?php endif; ?>
        <label class="checkboxs_label" for="hora_10am_cita_id">De 10:00 am a 11:00 am</label>


        <?php if (isset($_SESSION['idAgenda'])) : ?>
            <input class="agenda_checkbox" type="checkbox" name="hora_11am_cita_id" checked <?= is_numeric($_SESSION['horario']->hora_11am_cita_id) ? "disabled" : ""?> value="<?=!is_numeric($_SESSION['horario']->hora_11am_cita_id) ? "disponible" : $_SESSION['horario']->hora_11am_cita_id ?>" />
        <?php elseif (isset($_SESSION['loadhora_11am_cita_id'])) : ?>
            <input class="agenda_checkbox" type="checkbox" name="hora_11am_cita_id" value="disponible" checked />
            <?php Utilidades::deleteSession('loadhora_11am_cita_id'); ?>
        <?php elseif (isset($_SESSION['no_checked_hora_11am_cita_id'])) : ?>
            <?php Utilidades::deleteSession('no_checked_hora_11am_cita_id'); ?>
            <input class="agenda_checkbox" type="checkbox" name="hora_11am_cita_id" value="disponible" />
        <?php else : ?>
            <input class="agenda_checkbox" type="checkbox" name="hora_11am_cita_id" value="disponible" checked />
        <?php endif; ?>
        <label class="checkboxs_label" for="hora_11am_cita_id">De 11:00 am a 12:00 am</label>


        <?php if (isset($_SESSION['idAgenda'])) : ?>
            <input class="agenda_checkbox" type="checkbox" name="hora_12am_cita_id" checked <?= is_numeric($_SESSION['horario']->hora_12am_cita_id) ? "disabled" : ""?> value="<?=!is_numeric($_SESSION['horario']->hora_12am_cita_id) ? "disponible" : $_SESSION['horario']->hora_12am_cita_id ?>" />
        <?php elseif (isset($_SESSION['loadhora_12am_cita_id'])) : ?>
            <input class="agenda_checkbox" type="checkbox" name="hora_12am_cita_id" value="disponible" checked />
            <?php Utilidades::deleteSession('loadhora_12am_cita_id'); ?>
        <?php elseif (isset($_SESSION['no_checked_hora_12am_cita_id'])) : ?>
            <?php Utilidades::deleteSession('no_checked_hora_12am_cita_id'); ?>
            <input class="agenda_checkbox" type="checkbox" name="hora_12am_cita_id" value="disponible" />
        <?php else : ?>
            <input class="agenda_checkbox" type="checkbox" name="hora_12am_cita_id" value="disponible" checked />
        <?php endif; ?>
        <label class="checkboxs_label" for="hora_12am_cita_id">De 12:00 am a 1:00 pm</label>


        <?php if (isset($_SESSION['idAgenda'])) : ?>
            <input class="agenda_checkbox" type="checkbox" name="hora_1pm_cita_id" checked <?= is_numeric($_SESSION['horario']->hora_1pm_cita_id) ? "disabled" : ""?> value="<?=!is_numeric($_SESSION['horario']->hora_1pm_cita_id) ? "disponible" : $_SESSION['horario']->hora_1pm_cita_id ?>" />
        <?php elseif (isset($_SESSION['loadhora_1pm_cita_id'])) : ?>
            <input class="agenda_checkbox" type="checkbox" name="hora_1pm_cita_id" value="disponible" checked />
            <?php Utilidades::deleteSession('loadhora_1pm_cita_id'); ?>
        <?php elseif (isset($_SESSION['no_checked_hora_1pm_cita_id'])) : ?>
            <?php Utilidades::deleteSession('no_checked_hora_1pm_cita_id'); ?>
            <input class="agenda_checkbox" type="checkbox" name="hora_1pm_cita_id" value="disponible" />
        <?php else : ?>
            <input class="agenda_checkbox" type="checkbox" name="hora_1pm_cita_id" value="disponible" checked />
        <?php endif; ?>
        <label class="checkboxs_label" for="hora_1pm_cita_id">De 1:00 pm a 2:00 pm</label>

        <?php if (isset($_SESSION['idAgenda'])) : ?>
            <input class="agenda_checkbox" type="checkbox" name="hora_2pm_cita_id" checked <?= is_numeric($_SESSION['horario']->hora_2pm_cita_id) ? "disabled" : ""?> value="<?=!is_numeric($_SESSION['horario']->hora_2pm_cita_id) ? "disponible" : $_SESSION['horario']->hora_2pm_cita_id ?>"/>
        <?php elseif (isset($_SESSION['loadhora_2pm_cita_id'])) : ?>
            <input class="agenda_checkbox" type="checkbox" name="hora_2pm_cita_id" value="disponible" checked />
            <?php Utilidades::deleteSession('loadhora_2pm_cita_id'); ?>
        <?php elseif (isset($_SESSION['no_checked_hora_2pm_cita_id'])) : ?>
            <?php Utilidades::deleteSession('no_checked_hora_2pm_cita_id'); ?>
            <input class="agenda_checkbox" type="checkbox" name="hora_2pm_cita_id" value="disponible" />
        <?php else : ?>
            <input class="agenda_checkbox" type="checkbox" name="hora_2pm_cita_id" value="disponible" checked />
        <?php endif; ?>
        <label class="checkboxs_label" for="hora_2pm_cita_id">De 2:00 pm a 3:00 pm</label>

        <?php if (isset($_SESSION['idAgenda'])) : ?>
            <input class="agenda_checkbox" type="checkbox" name="hora_3pm_cita_id" checked <?= is_numeric($_SESSION['horario']->hora_3pm_cita_id) ? "disabled" : ""?> value="<?=!is_numeric($_SESSION['horario']->hora_3pm_cita_id) ? "disponible" : $_SESSION['horario']->hora_3pm_cita_id ?>"/>
        <?php elseif (isset($_SESSION['loadhora_3pm_cita_id'])) : ?>
            <input class="agenda_checkbox" type="checkbox" name="hora_3pm_cita_id" value="disponible" checked />
            <?php Utilidades::deleteSession('loadhora_3pm_cita_id'); ?>
        <?php elseif (isset($_SESSION['no_checked_hora_3pm_cita_id'])) : ?>
            <?php Utilidades::deleteSession('no_checked_hora_3pm_cita_id'); ?>
            <input class="agenda_checkbox" type="checkbox" name="hora_3pm_cita_id" value="disponible" />
        <?php else : ?>
            <input class="agenda_checkbox" type="checkbox" name="hora_3pm_cita_id" value="disponible" checked />
        <?php endif; ?>
        <label class="checkboxs_label" for="hora_3pm_cita_id">De 3:00 pm a 4:00 pm</label>

        <?php if (isset($_SESSION['idAgenda'])) : ?>
            <input class="agenda_checkbox" type="checkbox" name="hora_4pm_cita_id" checked <?= is_numeric($_SESSION['horario']->hora_4pm_cita_id) ? "disabled" : ""?> value="<?=!is_numeric($_SESSION['horario']->hora_4pm_cita_id) ? "disponible" : $_SESSION['horario']->hora_4pm_cita_id ?>"/>
        <?php elseif (isset($_SESSION['loadhora_4pm_cita_id'])) : ?>
            <input class="agenda_checkbox" type="checkbox" name="hora_4pm_cita_id" value="disponible" checked />
            <?php Utilidades::deleteSession('loadhora_4pm_cita_id'); ?>
        <?php elseif (isset($_SESSION['no_checked_hora_4pm_cita_id'])) : ?>
            <?php Utilidades::deleteSession('no_checked_hora_4pm_cita_id'); ?>
            <input class="agenda_checkbox" type="checkbox" name="hora_4pm_cita_id" value="disponible" />
        <?php else : ?>
            <input class="agenda_checkbox" type="checkbox" name="hora_4pm_cita_id" value="disponible" checked />
        <?php endif; ?>
        <label class="checkboxs_label" for="hora_4pm_cita_id">De 4:00 pm a 5:00 pm</label>

        <?php if (isset($_SESSION['idAgenda'])) : ?>
            <input class="agenda_checkbox" type="checkbox" name="hora_5pm_cita_id" checked <?= is_numeric($_SESSION['horario']->hora_5pm_cita_id) ? "disabled" : ""?> value="<?=!is_numeric($_SESSION['horario']->hora_5pm_cita_id) ? "disponible" : $_SESSION['horario']->hora_5pm_cita_id ?>"/>
        <?php elseif (isset($_SESSION['loadhora_5pm_cita_id'])) : ?>
            <input class="agenda_checkbox" type="checkbox" name="hora_5pm_cita_id" value="disponible" checked />
            <?php Utilidades::deleteSession('loadhora_5pm_cita_id'); ?>
        <?php elseif (isset($_SESSION['no_checked_hora_5pm_cita_id'])) : ?>
            <?php Utilidades::deleteSession('no_checked_hora_5pm_cita_id'); ?>
            <input class="agenda_checkbox" type="checkbox" name="hora_5pm_cita_id" value="disponible" />
        <?php else : ?>
            <input class="agenda_checkbox" type="checkbox" name="hora_5pm_cita_id" value="disponible" checked />
        <?php endif; ?>
        <label class="checkboxs_label" for="hora_5pm_cita_id">De 5:00 pm a 6:00 pm</label>

        <!--<?php if (isset($_SESSION['idAgenda'])) : ?>
            <input class="agenda_checkbox" type="checkbox" name="hora_6pm_cita_id" value="disponible" checked />
        <?php elseif (isset($_SESSION['loadhora_6pm_cita_id'])) : ?>
            <input class="agenda_checkbox" type="checkbox" name="hora_6pm_cita_id" value="disponible" checked />
            <?php Utilidades::deleteSession('loadhora_6pm_cita_id'); ?>
        <?php elseif (isset($_SESSION['no_checked_hora_6pm_cita_id'])) : ?>
            <?php Utilidades::deleteSession('no_checked_hora_6am_cita_id'); ?>
            <input class="agenda_checkbox" type="checkbox" name="hora_6pm_cita_id" value="disponible" />
        <?php else : ?>
            <input class="agenda_checkbox" type="checkbox" name="hora_6pm_cita_id" value="disponible" checked />
        <?php endif; ?>
        <label class="checkboxs_label" for="hora_6pm_cita_id">De 6:00 pm a 7:00 pm</label>
        -->

        <input class="btn-form-submit" type="submit" value="<?= $boton ?>">
    </form>
    <?php Utilidades::deleteError() ?>
</div>