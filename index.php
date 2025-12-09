<?php 

    require_once 'classes/database.php';
    require_once 'classes/Category.php';

    $database = new Database();
    $db = $database->getConnection();

    $category = new Category($db);

    $stmt = $category->read();
    $list_category = $stmt->fetchAll();

    include 'includes/header.php'
?>


    <main>
        <?php foreach($list_category as $category): ?>
    
            <h3> <?php echo($category['nombre']); ?> </h3>
            
        <?php endforeach; ?>
    </main>



<?php 

    include 'includes/footer.php'
?>