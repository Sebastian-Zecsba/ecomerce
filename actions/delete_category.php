<?php 

    require_once "../classes/database.php";
    require_once "../classes/Category.php";

    if(isset($_GET['id'])){
        $database = new Database();
        $db = $database->getConnection();
        $category = new Category($db);

        $id_a_borrar = $_GET['id'];

        if($category->delete($id_a_borrar)){
            header('Location: ../index.php?mensaje=borrado');
        }else{ 
            echo 'No se pudo borrar';
        }

    }

?>