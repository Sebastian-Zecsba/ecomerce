<?php 
    include 'includes/header.php';

    require_once 'classes/Product.php';
    require_once 'classes/database.php';

    $database = new Database();
    $db = $database->getConnection();

    $productModel = new Product($db);
    $stmt = $productModel->read();   
    $products = $stmt->fetchAll();

?>

    <main>
        <?php foreach($products as $product): ?>
                <p> <?php echo $product['nombre'] ?> </p>
                <img src="<?php echo $product['imagen'] ?>" alt="">
        <?php endforeach?>
    </main>


<?php 

    include 'includes/footer.php'
?>