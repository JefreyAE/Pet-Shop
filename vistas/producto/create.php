<?php if (isset($_SESSION['idProduct'])): ?>
    <h1>Editar Producto.</h1>
    <?php $url = base_url . "Producto/save&id=".$_SESSION['idProduct']; ?>
    <?php $boton = "Modificar"; ?>
<?php else: ?>
    <h1>Crear nuevo Producto.</h1>
    <?php $url = base_url . "Producto/save"; ?>
    <?php $boton = "Crear"; ?>
<?php endif; ?>

<?php if (isset($_SESSION['regProduct']) && $_SESSION['regProduct'] == 'complete'): ?>
    <div class='alert'><strong>Registro completado correctamente.</strong></div>
<?php elseif (isset($_SESSION['regProduct']) && $_SESSION['regProduct'] == 'failed'): ?>
    <div class='alert alert-error'><strong>Registro fallido.</strong></div>
<?php endif; ?>
<?php Utilidades::deleteSession('regProduct'); ?>  

<?php if (isset($_SESSION['idProduct'])): ?>
    <?php $producto = Utilidades::showProducto($_SESSION['idProduct'])->fetch_object(); ?>
<?php endif; ?>     

<div class="form_container">
    <form action="<?= $url ?>" id="form_producto" method="POST" enctype="multipart/form-data">

        <label for="nombre">Nombre del producto</label>
        <?php if (isset($_SESSION['idProduct'])): ?>
            <input type="text" id="nombre" name="nombre" value=<?= $producto->nombre ?> required/> 
        <?php elseif (isset($_SESSION['loadname'])): ?>
            <input type="text" id="nombre" name="nombre" value=<?= $_SESSION['loadname'] ?> required/> 
            <?php Utilidades::deleteSession('loadname'); ?>
        <?php else: ?>
            <input type="text" id="nombre" name="nombre" required>
        <?php endif; ?>  
        <label class="msj-error" id="error_nombre"></label>  
        <?php echo isset($_SESSION['erroresProducto']) ? Utilidades::showError($_SESSION['erroresProducto'], "nombre") : ''; ?>

        <?php $categorias = Utilidades::showCategorias(); ?>
        <label for="nombre">Seleccione la categoria</label>
        <select for="text" name="categoria" >
            <?php while ($categoria = $categorias->fetch_object()): ?>  
                <?php if (isset($_SESSION['idProduct'])): ?>
                    <option value="<?= $categoria->id ?>" <?= $categoria->id == $producto->categoria_id ? 'selected' : '' ?>><?= $categoria->nombre ?></option>
                <?php else: ?>  
                    <option value="<?= $categoria->id ?>"><?= $categoria->nombre ?></option>
                <?php endif; ?>
            <?php endwhile; ?>
        </select>

        <label for="descripcion">Descripción</label>
        <?php if (isset($_SESSION['idProduct'])): ?>
            <textarea id="descripcion" name="descripcion" required><?= $producto->descripcion ?> </textarea>
        <?php elseif (isset($_SESSION['loaddescripcion'])): ?>
            <textarea id="descripcion" name="descripcion" required><?= $_SESSION['loaddescripcion'] ?></textarea> 
            <?php Utilidades::deleteSession('loadname'); ?>
        <?php else: ?>
            <textarea id="descripcion" name="descripcion" required></textarea>
        <?php endif; ?>   
        <label class="msj-error" id="error_descripcion"></label> 
        <?php echo isset($_SESSION['erroresProducto']) ? Utilidades::showError($_SESSION['erroresProducto'], "descripcion") : ''; ?>

        <label for="precio">Precio</label>
        <?php if (isset($_SESSION['idProduct'])): ?>
            <input type="number" id="precio" name="precio" value=<?= $producto->precio ?> required/> 
        <?php elseif (isset($_SESSION['loadprecio'])): ?>
            <input type="number" id="precio" name="precio" value=<?= $_SESSION['loadprecio'] ?> required/> 
            <?php Utilidades::deleteSession('loadprecio'); ?>
        <?php else: ?>
            <input type="number" id="precio" name="precio" required>
        <?php endif; ?>   
        <label class="msj-error" id="error_precio"></label> 
        <?php echo isset($_SESSION['erroresProducto']) ? Utilidades::showError($_SESSION['erroresProducto'], "precio") : ''; ?>

        <label for="stock">Stock</label>
        <?php if (isset($_SESSION['idProduct'])): ?>
            <input type="number" id="stock" name="stock" value=<?= $producto->stock ?> required/> 
        <?php elseif (isset($_SESSION['loadstock'])): ?>
            <input type="number" id="stock" name="stock" value=<?= $_SESSION['loadstock'] ?> required/> 
            <?php Utilidades::deleteSession('loadstock'); ?>
        <?php else: ?>
            <input type="number" id="stock" name="stock" required>
        <?php endif; ?>   
        <label class="msj-error" id="error_stock"></label> 
        <?php echo isset($_SESSION['erroresProducto']) ? Utilidades::showError($_SESSION['erroresProducto'], "stock") : ''; ?>

        <label for="oferta">Oferta</label>
        <select for="text" name="oferta" >
            <?php if (isset($_SESSION['idProduct'])): ?>
                <?php if ($producto->oferta == "1"): ?>
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
        <?php echo isset($_SESSION['erroresProducto']) ? Utilidades::showError($_SESSION['erroresProducto'], "oferta") : ''; ?>
        <?php if (isset($_SESSION['loadoferta'])): ?>
            <?php Utilidades::deleteSession('loadoferta'); ?>
        <?php endif; ?>   
        
        <label for="imagen">Imagen</label>
        <?php if (isset($_SESSION['idProduct']) && !empty($producto->imagen)): ?>
            <img src="<?= base_url ?>uploads/imagenes/<?= $producto->imagen; ?>">
        <?php endif; ?>
        <input type="file" name="imagen" >

        <?php if (isset($_SESSION['idProduct'])): ?>
            <input type="hidden" value="<?= $producto->id ?>" name="id">
        <?php endif; ?>

        <label class="msj-error centrado" id="error_formulario"></label> 
        <input class="btn-form-submit" id="btn_submit_producto" type="submit" value="<?= $boton ?>">
    </form>
    <?php Utilidades::deleteError() ?>
</div>