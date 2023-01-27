
    <h1>Nuestra oferta de Combos</h1>
    <?php if ($listCombos->num_rows != 0) : ?>
        <?php while ($combo = $listCombos->fetch_object()) : ?>
            <div class="product">
                <a href="<?php base_url ?>../Combo/ver&id=<?= $combo->id ?>">
                    <?php if ($combo->imagen != null) : ?>
                        <img src="<?= base_url ?>uploads/imagenes/<?= $combo->imagen ?>">
                    <?php else : ?>
                        <img src="<?= base_url ?>assets/img/ImgenNoDisponible.jpg">
                    <?php endif; ?>
                    <h2><?= $combo->nombre ?></h2>
                    <h2>Tipo: Combo</h2>
                </a>
                <p><?= $combo->precio ?> colones</p>
                <a href="<?= base_url ?>Carrito/add_combo&id_combo=<?= $combo->id ?>" class="button">Comprar</a>
            </div>
        <?php endwhile; ?>
    <?php else : ?>
        <p>No hay combos para mostrar.</p>
    <?php endif; ?>