<?php if ($edit == true): ?>
    <h1>Editar Servicio.</h1>
    <?= $url = base_url . "Servicio/update"; ?>
<?php else: ?>
    <h1>Crear nuevo Servicio.</h1>
    <?= $url = base_url . "Servicio/save"; ?>
<?php endif; ?>

<?php if (isset($_SESSION['regServicio']) && $_SESSION['regServicio'] == 'complete'): ?>
    <div class='alert'><strong>Registro completado correctamente.</strong></div>
<?php elseif (isset($_SESSION['regServicio']) && $_SESSION['regServicio'] == 'failed'): ?>
    <div class='alert alert-error'><strong>Registro fallido.</strong></div>
<?php endif; ?>
<?php Utilidades::deleteSession('regServicio'); ?>  

<?php if (isset($_SESSION['idServicio'])): ?>
    <?php $servicio = Utilidades::showServicio($_SESSION['idServicio'])->fetch_object(); ?>
<?php endif; ?>     

<div class="form_container">
    <form action="<?= $url ?>" method="POST" enctype="multipart/form-data">

        <label for="nombre">Nombre del Servicio</label>
        <?php if (isset($_SESSION['idServicio'])): ?>
            <input type="text" name="nombre" value=<?= $servicio->nombre ?> required/> 
        <?php elseif (isset($_SESSION['loadname'])): ?>
            <input type="text" name="nombre" value=<?= $_SESSION['loadname'] ?> required/> 
            <?php Utilidades::deleteSession('loadname'); ?>
        <?php else: ?>
            <input type="text" name="nombre" required>
        <?php endif; ?>   
        <?php echo isset($_SESSION['erroresServicio']) ? Utilidades::showError($_SESSION['erroresServicio'], "nombre") : ''; ?>

        <?php $categorias = Utilidades::showCategorias(); ?>
        <label for="nombre">Seleccione la categoría</label>
        <select for="text" name="categoria" >
            <?php while ($categoria = $categorias->fetch_object()): ?>       
                <option value="<?= $categoria->id ?>"><?= $categoria->nombre ?></option>
            <?php endwhile; ?>
        </select>

        <label for="descripcion">Descripción</label>
        <?php if (isset($_SESSION['idServicio'])): ?>
            <textarea name="descripcion" required><?= $servicio->descripcion ?> </textarea>
        <?php elseif (isset($_SESSION['loaddescripcion'])): ?>
            <textarea name="descripcion" required><?= $_SESSION['loaddescripcion'] ?></textarea> 
            <?php Utilidades::deleteSession('loadname'); ?>
        <?php else: ?>
            <textarea name="descripcion" required></textarea>
        <?php endif; ?>   
        <?php echo isset($_SESSION['erroresServicio']) ? Utilidades::showError($_SESSION['erroresServicio'], "descripcion") : ''; ?>

        <label for="precio">Precio</label>
        <?php if (isset($_SESSION['idServicio'])): ?>
            <input type="number" name="precio" value=<?= $servicio->precio ?> required/> 
        <?php elseif (isset($_SESSION['loadprecio'])): ?>
            <input type="number" name="precio" value=<?= $_SESSION['loadprecio'] ?> required/> 
            <?php Utilidades::deleteSession('loadprecio'); ?>
        <?php else: ?>
            <input type="number" name="precio" required>
        <?php endif; ?>   
        <?php echo isset($_SESSION['erroresServicio']) ? Utilidades::showError($_SESSION['erroresServicio'], "precio") : ''; ?>

        <label for="duracion">Duración</label>
        <select id="duracion" name="duracion" required>
            <?php if (isset($_SESSION['idServicio'])): ?>
                <options value="<?= $servicio->duracion ?>" selected><?= $servicio->duracion ?> minutos</option>
            <?php elseif (isset($_SESSION['loadduracion'])): ?>
                <options value="<?= $_SESSION['loadduracion'] ?>" selected><?= $_SESSION['loadduracion'] ?> minutos</option>
                <?php Utilidades::deleteSession('loadduracion'); ?>
            <?php endif; ?>
            <options value="15">15 minutos</option>
            <options value="30">30 minutos</option>
            <options value="45">45 minutos</option>
            <options value="60">1 hora</option>
            <options value="75">1 hora 15 minutos</option>
            <options value="90">1 hora 30 minutos</option>
            <options value="105">1 hora 45 minutos</option>
            <options value="120">2 horas</option>
        </select>

        <label for="oferta">Oferta</label>
        <?php if (isset($_SESSION['idServicio'])): ?>
            <input type="text" name="oferta" value=<?= $servicio->oferta ?> required/> 
        <?php elseif (isset($_SESSION['loadoferta'])): ?>
            <input type="text" name="oferta" value=<?= $_SESSION['loadoferta'] ?> required/> 
            <?php Utilidades::deleteSession('loadoferta'); ?>
        <?php else: ?>
            <input type="text" name="oferta" required>
        <?php endif; ?>   
        <?php echo isset($_SESSION['erroresServicio']) ? Utilidades::showError($_SESSION['erroresServicio'], "oferta") : ''; ?>

        <label for="imagen">Imagen</label>
        <input type="file" name="imagen" required>

        <input class="btn-form-submit" type="submit" name="submit" value="Editar">
    </form>
    <?php Utilidades::deleteError() ?>
</div>