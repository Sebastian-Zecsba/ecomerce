<?php 

    require_once 'config/db.php';

    $categorias = [];

    $select = $pdo->query("SELECT * FROM categorias");


    $categorias = $select->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <?php foreach($categorias as $categoria): ?>

        <h3> <?php echo($categoria['nombre']); ?> </h3>
        
    <?php endforeach; ?>

</body>
</html>