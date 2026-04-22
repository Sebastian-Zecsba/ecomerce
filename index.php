<?php 

    require_once 'actions/auth/middleware.php';

    include 'includes/header.php';

    require_once 'classes/Product.php';
    require_once 'classes/database.php';

    $database = new Database();
    $db = $database->getConnection();

    $productModel = new Product($db);
    $stmt = $productModel->read();   
    $products = $stmt->fetchAll();

?>

<main class="products-grid">
        <?php foreach($products as $product): ?>
            <div class="product-card">
                <img src="<?= $product['imagen'] ?>" alt="<?= $product['nombre'] ?>">
                
                <div class="product-info">
                    <h3 class="product-info-title"><?= $product['nombre'] ?></h3>
                    <p class="product-info-stock product-text">Disponibles: <?= $product['stock']  ?></p>
                    <p class="product-info-price product-text">Precio: <?= $product['precio']  ?></p>
                    <a href="productId.php?id=<?= $product['id'] ?>" class="btn-add">Ver producto</a>
                </div>
            </div>
        <?php endforeach; ?>
    </main>


<?php 

    include 'includes/footer.php'
?>