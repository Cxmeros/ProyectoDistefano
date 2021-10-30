<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Distefano Shop</title>
    <link rel="stylesheet" href="assets/css/styles.css"/>
    <link rel="shortcut icon" href="assets/img/favicon.ico" />
</head>
<body>

    <!-- cabecera -->
<div id="container">
    <header id="header">
        <div id="logo">
            <img src="assets/img/Distefano.jpeg" alt="Distefano logo" href="index.php"/>
            <a href="index.php">
                Distefano Shop
            </a>
        </div>
    </header>   
    <!-- menu -->
    <?php $categorias = Utils::showCategorias(); ?>
    <nav id="menu">
        <ul>
            <li>
                <a href="<?= base_url?>">Inicio</a>
            </li>
            <?php while($cat = $categorias->fetch_object()): ?>
            <li>
                <a href="?controller=categoria&action=ver&id=<?=$cat->id?>"><?=$cat->nombre?></a>
            </li>
            <?php endwhile; ?>
        </ul>        
    </nav>

    <!-- barra lateral -->
    <div id="content">