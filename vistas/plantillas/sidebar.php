<!-- Barra Lateral -->
<aside id="side_bar">
    <div id="carrito" class="block_aside">
        <h3>Carrito de compras</h3>
        <ul>
            <?php $stats = Utilidades::statsCarrito();?>
            <li><a href="<?= base_url ?>Carrito/index">Total de productos (<?= $stats['count'];?>)</a></li>
            <li><a href="<?= base_url ?>Carrito/index">Total: <?= $stats['total']?> colones</a></li>
            <li><a href="<?= base_url ?>Carrito/index">Ver el carrito</a></li>
        </ul>
    </div>
    <div id="login" class="block_aside">
        <?php if (!isset($_SESSION['identity'])): ?>        
            <h3 id="title-login">Ingresa aquí</h3>      
            <form action="<?= base_url ?>Usuario/login" method="POST">
                <label for="email">Email:</label>
                <input type="email" name="email" placeholder="Ejemplo: ejemplo@gmail.com">
                <label for="password">Contraseña:</label>
                <input type="password" name="password">
                <input type="submit" value="Ingresar" id="btn-login">
                <?php echo isset($_SESSION['error_login']) ? "<div class='separador'></div><div class='alert alert-error'>" . $_SESSION['error_login'] . "</div>" : ''; ?>
            </form>
            <?php if (isset($_SESSION['error_login'])): ?>
                <?php Utilidades::deleteSession('error_login'); ?>
            <?php endif;?>
        <?php else: ?> 
            <?php if(isset($_SESSION['admin'])): ?>
                <h3>Panel de administración</h3>
            <?php else: ?>
                <h3>Bienvenid@ <?= $_SESSION['identity']->nombre; ?></h3>
            <?php endif; ?>
                   
        <?php endif; ?>
        <ul>           
            <?php if(isset($_SESSION['admin'])): ?>
                <li><a href="<?= base_url ?>Categoria/index">Administrar categorías</a></li>
                <li><a href="<?= base_url ?>Usuario/gestion">Administrar usuarios</a></li>
                <li><a href="<?= base_url ?>Producto/gestion">Administrar productos</a></li>
                <li><a href="<?= base_url ?>Servicio/gestion">Administrar servicios</a></li>
                <li><a href="<?= base_url ?>Agenda/gestion">Administrar agenda</a></li>
                <li><a href="<?= base_url ?>Cita/gestion">Administrar citas registradas</a></li>
                <li><a href="<?= base_url ?>Combo/gestion">Administrar combos</a></li>
                <li><a href="<?= base_url ?>Orden/gestion">Administrar órdenes</a></li>
            <?php endif; ?>
            <?php if(isset($_SESSION['identity'])):?>
                <li><a href="<?= base_url ?>Orden/mis_ordenes">Mis órdenes</a></li>
                <li><a href="<?= base_url ?>Cita/mis_citas">Mis citas</a></li>
                <li><a href="<?= base_url ?>Usuario/reset_password">Cambiar contraseña</a></li>
                <li><a href="<?= base_url ?>Usuario/logout">Cerrar Sesión</a></li>
            <?php else: ?>
                <li><a href="<?=base_url?>Usuario/registro">Registrate aquí</a></li>
            <?php endif; ?>
        </ul>        
    </div>
</aside>
<!-- Contenido central -->
<div id="central">