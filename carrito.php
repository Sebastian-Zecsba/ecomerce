<?php

    require_once 'actions/auth/middleware.php';
    requireLogin();
    
    include 'includes/header.php';
    require_once 'classes/ShoppingCar.php';
    require_once 'classes/database.php';


    $database = new Database();
    $db = $database->getConnection();

    $shoppingCartModel = new ShoppingCar($db);
    $itemsCart = $shoppingCartModel->getCartItems($_SESSION['user_id']);

    $totalCart = $shoppingCartModel->countQuantity($_SESSION['user_id']);
?>

<main class="contenedor cart-page">
    <h1 class="cart-title">Tu Carrito de Compras</h1>

    <?php if(empty($itemsCart)): ?>
        <div class="empty-cart">
            <p>Tu carrito está vacío.</p>
            <a href="index.php" class="btn-add-cart" style="display:inline-block; width:auto; padding: 10px 20px; text-decoration:none;">Volver a la tienda</a>
        </div>
    <?php else: ?>
        <div class="cart-layout">
            <div class="cart-items-container">
                <?php foreach($itemsCart as $itemCart): 
                    $subtotalItem = $itemCart['precio'] * $itemCart['cantidad'];
                ?> 
                    <div class="cart-item">
                        <div class="cart-item-image">
                            <img src="<?= $itemCart['imagen'] ?>" alt="<?= $itemCart['producto_nombre'] ?>" />
                        </div>
                        <div class="cart-item-details">
                            <h3 class="cart-item-title"><?= $itemCart['producto_nombre'] ?></h3>
                            <p class="cart-item-category"><?= $itemCart['categoria_nombre'] ?></p>
                            <div class="cart-item-price-qty">
                                <span class="cart-item-price">$<?= number_format($itemCart['precio'], 2) ?></span>
                                <span class="cart-item-qty">Cant: <?= $itemCart['cantidad'] ?></span>

                                <form action="actions/cart/delete.php" method="POST">
                                    <input type="hidden" name="producto_id" value="<?= $itemCart['producto_id'] ?>">
                                    
                                    <button type="submit" class="btn-delete-cart">
                                        <span class="material-symbols-outlined button-delete">
                                            delete
                                        </span>
                                    </button>   
                                </form>

                            </div>
                        </div>
                        <div class="cart-item-subtotal">
                            <span class="subtotal-label">Subtotal</span>
                            <span class="subtotal-value">$<?= number_format($subtotalItem, 2) ?></span>
                            <i class="fa-solid fa-trash"></i>
                        </div>
                    </div>
                <?php endforeach;?>
            </div>
            
            <div class="cart-summary">
                <h3>Resumen de la orden</h3>
                <div class="summary-row">
                    <span>Subtotal</span>
                    <span>$<?= number_format($totalCart, 2) ?></span>
                </div>
                <div class="summary-row">
                    <span>Envío</span>
                    <span>Gratis</span>
                </div>
                <hr class="summary-divider">
                <div class="summary-row total-row">
                    <span>Total a pagar</span>
                    <span>$<?= number_format($totalCart, 2) ?></span>
                </div>
                <button class="btn-add-cart btn-checkout">Proceder al pago</button>
            </div>
        </div>
    <?php endif; ?>
</main>

<?php include 'includes/footer.php'; ?>
