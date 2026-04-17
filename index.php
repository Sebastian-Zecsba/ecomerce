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
                <img src="<?= htmlspecialchars($product['imagen']) ?>" alt="<?= htmlspecialchars($product['nombre']) ?>">
                
                <div class="product-info">
                    <h3><?= htmlspecialchars($product['nombre']) ?></h3>
                    <button class="btn-add">Ver producto</button>
                </div>
            </div>
        <?php endforeach; ?>
    </main>


<?php 

    include 'includes/footer.php'
?>