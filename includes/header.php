<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $titulo ?? 'Mi E-commerce' ?></title>
    <link rel="stylesheet" href="assets/styles.css">
</head>
<body>

    <header class="site-header">
        <div class="navbar">
            <a href="index.php" class="logo">ZAPATILLAS.IO</a>

            <nav>
                <ul class="nav-links">
                    <li><a href="index.php">Inicio</a></li>
                    <li><a href="#">Hombres</a></li>
                    <li><a href="#">Mujeres</a></li>
                    <li><a href="#">Rebajas</a></li>
                    <li><a href="product.php">Agregar producto</a></li>
                </ul>
            </nav>

            <div class="nav-actions">
                <a href="carrito.php">🛒 Carrito (0)</a>
                <a href="login.php" class="btn-login">Ingresar</a>
            </div>
        </div>
    </header>