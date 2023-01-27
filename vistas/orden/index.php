
<?php if (isset($_SESSION['identity'])) : ?>
<?php require_once 'vistas/cita/create.php' ?>

    <?php if (isset($_SESSION['dias_disponibles'][0])) : ?>
        <?php if (isset($_SESSION['horario'])) : ?>
            <?php if (isset($_SESSION['identity'])) : ?>
                <h1>Dirección para el envío:</h1>
                <a href="<?= base_url ?>Carrito/index">Ver los productos</a>
                <?php if (isset($_SESSION['orden']) && $_SESSION['orden'] == 'complete') : ?>
                    <!--<div class='alert'><strong>orden completado correctamente.</strong></div>-->
                <?php elseif (isset($_SESSION['orden']) && $_SESSION['orden'] == 'failed') : ?>
                    <div class='alert alert-error'><strong>Orden fallida.</strong></div>
                <?php endif; ?>
                <?php Utilidades::deleteSession('orden'); ?>
                <?php if (!$_SESSION['crear_cita']) : ?>
                    <div class="form_container">
                        <form action="<?= base_url ?>Orden/add" id="form_orden" method="POST">
                <?php endif; ?>
                            <label for="provincia">Provincia</label>
                            <select id="provincia" name="provincia"></select>
                            <label class="msj-error" id="error_provincia"></label> 
                            <?php echo isset($_SESSION['errores']) ? Utilidades::showError($_SESSION['errores'], "provincia") : ''; ?>

                            <label for="canton">Cantón</label>
                            <select id="canton" name="canton"  >  
                                <option value="San José">San José</option>
                                <option value="Escazú">Escazú</option>
                                <option value="Desamparados">Desamparados</option>
                                <option value="Puriscal">Puriscal</option>
                                <option value="Tarrazú">Tarrazú</option>
                                <option value="Aserrí">Aserrí</option>
                                <option value="Mora">Mora</option>
                                <option value="Goicoechea">Goicoechea</option>
                                <option value="Santa Ana">Santa Ana</option>
                                <option value="Alajuelita">Alajuelita</option>
                                <option value="Coronado">Coronado</option>
                                <option value="Acosta">Acosta</option>
                                <option value="Tibás">Tibás</option>
                                <option value="Moravia">Moravia</option>
                                <option value="Montes de Oca">Montes de Oca</option>
                                <option value="Turrubares">Turrubares</option>
                                <option value="Dota">Dota</option>
                                <option value="Curridabat">Curridabat</option>
                                <option value="Perez Zeledón">Perez Zeledón</option>
                                <option value="León Cortés">León Cortés</option> 
                            </select>
                            <label class="msj-error" id="error_canton"></label> 
                            <?php echo isset($_SESSION['errores']) ? Utilidades::showError($_SESSION['errores'], "canton") : ''; ?>

                            <label for="distrito">Distrito</label>
                            <select type="text" id="distrito" name="distrito"/>
                                <option value="Carmen">Carmen</option>
                                <option value="Merced">Merced</option>
                                <option value="Hospital">Hospital</option>
                                <option value="Catedral">Catedral</option>
                                <option value="Zapote">Zapote</option>
                                <option value="San Fco. de Dos Ríos">San Fco. de Dos Ríos</option>
                                <option value="Uruca">Uruca</option>
                                <option value="Mata Redonda">Mata Redonda</option>
                                <option value="Pavas">Pavas</option>
                                <option value="Hatillo">Hatillo</option>
                                <option value="San Sebastián">San Sebastián</option>
                            </select>
                            <label class="msj-error" id="error_distrito"></label> 
                            <?php echo isset($_SESSION['errores']) ? Utilidades::showError($_SESSION['errores'], "distrito") : ''; ?>

                            <label for="localidad">Localidad</label>
                            <?php if (isset($_SESSION['loadlocalidad'])) : ?>
                                <input type="text" id="localidad" name="localidad" value=<?= $_SESSION['loadlocalidad'] ?> required />
                                <?php Utilidades::deleteSession('loadlocalidad'); ?>
                            <?php else : ?>
                                <input type="text" id="localidad" name="localidad" required />
                            <?php endif; ?>
                            <label class="msj-error" id="error_localidad"></label> 
                            <?php echo isset($_SESSION['errores']) ? Utilidades::showError($_SESSION['errores'], "localidad") : ''; ?>

                            <label for="direccion">Dirección</label>
                            <?php if (isset($_SESSION['loaddireccion'])) : ?>
                                <textarea id="direccion" name="direccion" required><?= $_SESSION['loaddireccion'] ?></textarea>
                                <?php Utilidades::deleteSession('loaddireccion'); ?>
                            <?php else : ?>
                                <textarea id="direccion" name="direccion" required></textarea>
                            <?php endif; ?>
                            <label class="msj-error" id="error_direccion"></label> 
                            <?php echo isset($_SESSION['errores']) ? Utilidades::showError($_SESSION['errores'], "direccion") : ''; ?>

                            <label class="msj-error centrado" id="error_formulario"></label> 
                            <input class="btn-form-submit" type="submit" id="btn_submit_orden" value="Confirmar orden">
                        </form>
                    </div>
                    <?php Utilidades::deleteError(); ?>
                <?php else : ?>
                    <h1>Debes ingresar a tu cuenta</h1>
                    <p>Necesitas registrarte he ingresar a tu cuenta para poder realizar tu orden.</p>
                <?php endif; ?>
                <?php Utilidades::deleteSession('horario'); ?>
            <?php endif; ?>
        <?php else : ?>
            <p>No se cuentan con días disponibles para agendar una cita.</p>
        <?php endif; ?>

        <?php else : ?>
                <h1>Debes ingresar a tu cuenta</h1>
                <p>Necesitas registrarte he ingresar a tu cuenta para poder realizar tu orden.</p>
<?php endif; ?>