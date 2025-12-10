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
        <?php foreach($list_category as $cat): ?>
    
            <div style="display: flex; gap: 5px;"> 
                <p> <?php echo($cat['nombre']); ?> </p>
                <a href="actions/delete_category.php?id=<?php echo $cat['id'] ?>">Delete</a>
            </div>
            
        <?php endforeach; ?>
    </main>



<?php 

    include 'includes/footer.php'
?>