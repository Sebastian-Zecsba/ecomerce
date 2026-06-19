<?php 
    require_once 'classes/ShoppingCar.php';
    require_once 'classes/database.php'; 

    $database = new Database();
    $db = $database->getConnection();

    $shoppingCartModel = new ShoppingCar($db);

    if(isset($_SESSION['user_id'])){
        $cartMount = $shoppingCartModel->countAmount($_SESSION['user_id']);
    }else{
        $cartMount = 0;
    }

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $titulo ?? 'Mi E-commerce' ?></title>
    <link rel="stylesheet" href="assets/styles.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" />
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

                    <?php if(isset($_SESSION['user_rol']) && $_SESSION['user_rol'] === 'admin') : ?>
                        <li><a href="product.php">Agregar producto</a></li>
                        <li><a href="category.php">Agregar Categoria</a></li>
                    <?php endif; ?>
                        
                </ul>
            </nav>

            <div class="nav-actions">
                <a href="carrito.php">Carrito (<?=  $cartMount ?>)</a>
                <?php if(isset($_SESSION['user_id'])): ?>
                    <a href="actions/auth/logout.php" class="btn-login">Cerrar Sesión</a>
                <?php else: ?>
                    <a href="login.php" class="btn-login">Ingresar</a>
                <?php endif; ?>
            </div>
        </div>
    </header>
