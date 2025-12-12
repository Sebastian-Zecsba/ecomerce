<?php 
    include 'includes/header.php';

    require_once 'classes/database.php';
    require_once 'classes/Category.php';

    $database = new Database();
    $db = $database->getConnection();

    $category = new Category($db);

    if($_POST){
        $category->nombre = $_POST['category'];

        if($category->create()){
            header('Location: index.php?mensaje=creado');
        } else {
            echo '<div style="color: red">Error al crear categoría</div>';
        }
    }

?>

    <section>
        <form action="" method="POST">
            <div>
                <label for="category">Nombre de la categoria: </label>
                <input type="text" name="category" id="category" placeholder="Ej: Deportivos">
            </div>
            <button type="submit">Guardar</button>
        </form>
    </section>



<?php 
    include 'includes/footer.php';
?>