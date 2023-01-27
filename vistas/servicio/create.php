<?php if (isset($_SESSION['idServicio'])): ?>
    <h1>Editar Servicio.</h1>
    <?php $url = base_url . "Servicio/save&id=".$_SESSION['idServicio']; ?>
    <?php $boton = "Modificar"; ?>
<?php else: ?>
    <h1>Crear nuevo Servicio.</h1>
    <?php $url = base_url . "Servicio/save"; ?>
    <?php $boton = "Crear"; ?>
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
    <form action="<?= $url ?>" id="form_servicio" method="POST" enctype="multipart/form-data">

        <label for="nombre">Nombre del servicio</label>
        <?php if (isset($_SESSION['idServicio'])): ?>
            <input type="text" id="nombre" name="nombre" value=<?= $servicio->nombre ?> required/> 
        <?php elseif (isset($_SESSION['loadname'])): ?>
            <input type="text" id="nombre" name="nombre" value=<?= $_SESSION['loadname'] ?> required/> 
            <?php Utilidades::deleteSession('loadname'); ?>
        <?php else: ?>
            <input type="text" id="nombre" name="nombre" required>
        <?php endif; ?>   
        <label class="msj-error" id="error_nombre"></label>  
        <?php echo isset($_SESSION['erroresServicio']) ? Utilidades::showError($_SESSION['erroresServicio'], "nombre") : ''; ?>

        <?php $categorias = Utilidades::showCategorias(); ?>
        <label for="nombre">Seleccione la categoría</label>
        <select for="text" name="categoria" >
            <?php while ($categoria = $categorias->fetch_object()): ?>  
                <?php if (isset($_SESSION['idServicio'])): ?>
                    <option value="<?= $categoria->id ?>" <?= $categoria->id == $servicio->categoria_id ? 'selected' : '' ?>><?= $categoria->nombre ?></option>
                <?php else: ?>  
                    <option value="<?= $categoria->id ?>"><?= $categoria->nombre ?></option>
                <?php endif; ?>
            <?php endwhile; ?>
        </select>

        <label for="descripcion">Descripción</label>
        <?php if (isset($_SESSION['idServicio'])): ?>
            <textarea id="descripcion" name="descripcion" required><?= $servicio->descripcion ?> </textarea>
        <?php elseif (isset($_SESSION['loaddescripcion'])): ?>
            <textarea id="descripcion" name="descripcion" required><?= $_SESSION['loaddescripcion'] ?></textarea> 
            <?php Utilidades::deleteSession('loadname'); ?>
        <?php else: ?>
            <textarea id="descripcion" name="descripcion" required></textarea>
        <?php endif; ?>   
        <label class="msj-error" id="error_descripcion"></label>
        <?php echo isset($_SESSION['erroresServicio']) ? Utilidades::showError($_SESSION['erroresServicio'], "descripcion") : ''; ?>

        <label for="precio">Precio</label>
        <?php if (isset($_SESSION['idServicio'])): ?>
            <input type="number" id="precio" name="precio" value=<?= $servicio->precio ?> required/> 
        <?php elseif (isset($_SESSION['loadprecio'])): ?>
            <input type="number" id="precio" name="precio" value=<?= $_SESSION['loadprecio'] ?> required/> 
            <?php Utilidades::deleteSession('loadprecio'); ?>
        <?php else: ?>
            <input type="number" id="precio" name="precio" required>
        <?php endif; ?>   
        <label class="msj-error" id="error_precio"></label> 
        <?php echo isset($_SESSION['erroresServicio']) ? Utilidades::showError($_SESSION['erroresServicio'], "precio") : ''; ?>

        <label for="duracion">Duración</label>
        <select id="duracion" name="duracion" required>
            <?php if (isset($_SESSION['idServicio'])): ?>
                <option value="<?= $servicio->duracion ?>"><?= $servicio->duracion ?> minutos</option>
            <?php elseif (isset($_SESSION['loadduracion'])): ?>
                <option value="<?= $_SESSION['loadduracion'] ?>"><?= $_SESSION['loadduracion'] ?> minutos</option>
                <?php Utilidades::deleteSession('loadduracion'); ?>
            <?php endif; ?>
            <option value="1">1 hora</option>
            <option value="2">2 horas</option>
            <option value="3">3 horas</option>
        </select> 
        <?php echo isset($_SESSION['erroresServicio']) ? Utilidades::showError($_SESSION['erroresServicio'], "duracion") : ''; ?>

        <label for="oferta">Oferta</label>
        <select for="text" name="oferta" >
            <?php if (isset($_SESSION['idServicio'])): ?>
                <?php if ($servicio->oferta == "1"): ?>
                    <option value="1" selected>Si</option>
                    <option value="0">No</option>
                <?php else: ?>
                    <option value="1">Si</option>
                    <option value="0" selected>No</option>
                <?php endif; ?>  
            <?php else: ?>  
                <option value="1">Si</option>
                <option value="0" selected>No</option>
            <?php endif; ?>
        </select>    
        <?php echo isset($_SESSION['erroresServicio']) ? Utilidades::showError($_SESSION['erroresServicio'], "oferta") : ''; ?>
        <?php if (isset($_SESSION['loadoferta'])): ?>
            <?php Utilidades::deleteSession('loadoferta'); ?>
        <?php endif; ?>  

        <label for="imagen">Imagen</label>
        <?php if (isset($_SESSION['idServicio']) && !empty($servicio->imagen)): ?>
            <img src="<?= base_url ?>uploads/imagenes/<?= $servicio->imagen; ?>">
        <?php endif; ?>
        <input type="file" name="imagen" >

        <?php if (isset($_SESSION['idServicio'])): ?>
            <input type="hidden" value="<?= $servicio->id ?>" name="id">
        <?php endif; ?>

        <label class="msj-error centrado" id="error_formulario"></label> 
        <input class="btn-form-submit" id="btn_submit_servicio" type="submit" value="<?= $boton ?>">
    </form>
    <?php Utilidades::deleteError() ?>
</div>