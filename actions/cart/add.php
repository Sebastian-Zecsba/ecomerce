<?php

    require '../auth/middleware.php';
    requireLogin();

    require_once '../../classes/database.php';
    require_once '../../classes/ShoppingCar.php';

    $database = new Database();
    $db = $database->getConnection();
    $cart = new ShoppingCar($db);

    $cart->addItem($_POST['producto_id'], 1, $_SESSION['user_id']);

    header("Location: ../../index.php");
?>