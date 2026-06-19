<?php

    require_once '../auth/middleware.php';
    requireLogin();

    require_once '../../classes/database.php';
    require_once '../../classes/ShoppingCar.php';

    $database = new Database();
    $db = $database->getConnection();
    $deleteProduct = new ShoppingCar($db);


    $deleteProduct->deleteProductCart($_SESSION['user_id'], $_POST['producto_id']);

    header("Location: ../../carrito.php");




?>