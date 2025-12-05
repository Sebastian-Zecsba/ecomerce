<?php 

    require_once 'config/db.php';

    $categorias = [];

    $select = $pdo->query("SELECT * FROM categorias");


    $categorias = $select->fetchAll();

    include 'includes/header.php'
?>


    <main>
        <?php foreach($categorias as $categoria): ?>
    
            <h3> <?php echo($categoria['nombre']); ?> </h3>
            
        <?php endforeach; ?>
    </main>



<?php 

    include 'includes/footer.php'
?>