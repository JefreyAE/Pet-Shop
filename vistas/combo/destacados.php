<h1>Algunos de nuestros combos</h1>
<?php if (isset($list)): ?>
    <?php while ($combo = $list->fetch_object()): ?>
        <div class="product">
            <a href="<?php base_url ?>Combo/ver&id=<?= $combo->id ?>">
                <?php if ($combo->imagen != null): ?>
                    <img src="<?= base_url ?>uploads/imagenes/<?= $combo->imagen ?>">
                <?php else: ?>
                    <img src="<?= base_url ?>assets/img/ImgenNoDisponible.jpg">
                <?php endif; ?>
                <h2><?= $combo->nombre ?></h2>
            </a>
                <p><?= $combo->precio ?> colones</p>
            <a href="<?=base_url?>Carrito/add&id=<?=$combo->id?>" class="button">Comprar</a>
        </div>
    <?php endwhile; ?>
<?php endif; ?>

