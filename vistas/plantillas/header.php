<!DOCTYPE HTML>
<html lang="es">

<head>
    <meta charset="utf-8" />
    <title>Golden Grooming/Pet Shop</title>
    <link rel="stylesheet" type="text/css" href="<?= base_url ?>assets/css/styles.css">
    <link rel="icon" type="favicon/x-icon" href="<?= base_url ?>assets/img/Logo-2.jpg"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script type="text/javascript" src="<?= base_url ?>assets/js/validaciones1.js"></script>
    <script type="text/javascript" src="<?= base_url ?>assets/js/provincias.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Sacramento&display=swap" rel="stylesheet">
</head>

<body>
    <div id="container">
        <!-- Cabecera -->
        <header id="header">
            <div id="logo">
                <img id="img-logo" src="<?= base_url ?>assets/img/Logo-2.jpg" alt="pet-shop Logo" />
                <img src="<?= base_url ?>assets/img/perritos.png" alt="pet-shop Logo" />
                <a href="<?= base_url ?>">
                    Golden Grooming & Pet Shop
                </a>
            </div>
        </header>
        <!-- Menu -->
        <?php $categorias = Utilidades::showCategorias() ?>
        <div class="nav_container" id="navBarResponsive">
            <a class="active" href="<?= base_url ?>">Inicio</a>
            <a href="<?= base_url ?>Combo/ver_combos">Nuestros Combos</a>
            <?php while ($categoria = $categorias->fetch_object()) : ?>
                <a href="<?= base_url ?>Categoria/ver&id=<?= $categoria->id ?>"><?= $categoria->nombre ?></a>
            <?php endwhile; ?>
            <a href="#" class="icon" onclick="muestraBarra()">
                <img src="<?= base_url ?>assets/img/barra.jpg" />
            </a>
        </div>
        <div id="content">

          