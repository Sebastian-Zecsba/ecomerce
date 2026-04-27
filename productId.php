<?php 
    
    include 'includes/header.php';

    require_once 'classes/Product.php';
    require_once 'classes/database.php';

    $database = new Database();
    $db = $database->getConnection();

    $productModel = new Product($db);
    $stmt = $productModel->readById($_GET['id']);
    $product = $stmt

?>

<main class="contenedor product-detail-section">
    <div class="product-detail-layout">
        
        <div class="product-detail-image">
            <img src="<?= $product['imagen'] ?>" alt="<?= $product['nombre'] ?>">
        </div>

        <div class="product-detail-info">
            <h1 class="product-title"><?= $product['nombre'] ?></h1>
            
            <p class="product-price">
                $<?= number_format($product['precio'], 0, ',', '.') ?> COP
            </p>
            
            <div class="product-description">
                <h3>Acerca de este producto</h3>
                <p><?= $product['descripcion'] ?></p>
            </div>

            <div class="product-meta">
                <p><strong>Disponibilidad:</strong> 
                    <span class="<?= $product['stock'] > 0 ? 'in-stock' : 'out-of-stock' ?>">
                        <?= $product['stock'] > 0 ? $product['stock'] . ' unidades disponibles' : 'Agotado' ?>
                    </span>
                </p>
            </div>

            <form action="actions/cart/add.php" method="POST" class="add-to-cart-form">
                <input type="hidden" name="producto_id" value="<?= $product['id'] ?>">
                
                <div class="quantity-wrapper">
                    <label for="cantidad">Cantidad:</label>
                    <div class="quantity-controls">
                        <button type="button" class="btn-qty btn-minus">-</button>
                        <input type="number" id="cantidad" name="cantidad" value="1" min="1" max="<?= $product['stock'] ?>" readonly>
                        <button type="button" class="btn-qty btn-plus">+</button>
                    </div>
                </div>

                <button type="submit" class="btn-add-cart" <?= $product['stock'] <= 0 ? 'disabled' : '' ?>>
                    🛒 Añadir al carrito
                </button>
            </form>
        </div>

    </div>
</main>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const btnMinus = document.querySelector('.btn-minus');
        const btnPlus = document.querySelector('.btn-plus');
        const inputQty = document.querySelector('#cantidad');
        
        const maxStock = parseInt(inputQty.getAttribute('max'));


        btnMinus.addEventListener('click', function() {
            let currentValue = parseInt(inputQty.value);
            if (currentValue > 1) { 
                inputQty.value = currentValue - 1;
            }
        });


        btnPlus.addEventListener('click', function() {
            let currentValue = parseInt(inputQty.value);
            if (currentValue < maxStock) { 
                inputQty.value = currentValue + 1;
            } else {
                alert("Has alcanzado el límite de stock para este producto.");
            }
        });
    });
</script>