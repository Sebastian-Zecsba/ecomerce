<?php 
    require_once '../../classes/database.php';
    require_once '../../classes/Product.php';

    if($_POST){

        $database = new Database();
        $db = $database->getConnection();
        $product = new Product($db);

        $product->categoria_id = $_POST['categoria_id'];
        $product->nombre = $_POST['nombre'];
        $product->descripcion = $_POST['descripcion'];
        $product->precio = $_POST['precio'];
        $product->stock = $_POST['stock'];

        if(isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK ){

            $originalName = $_FILES['imagen']['name'];
            $temporal = $_FILES['imagen']['tmp_name'];

            $finalName = date('YmdHis').'_'.$originalName;

            $fisicRute = '../../assets/img/'.$finalName;
            $dataBaseRute = 'assets/img/'.$finalName;

            if(!is_dir('../../assets/img')){
                mkdir('../../assets/img', 0777, true);
            }

            if(move_uploaded_file($temporal, $fisicRute)){
                $product->imagen = $dataBaseRute;
            }else {
                $product->imagen = 'assets/img/default.png';
            }
        }else {
            $product->imagen = 'assets/img/default.png';
        }

        if ($product->create()) {
            // Redirigir al usuario al listado con mensaje de éxito
            header("Location: ../../index.php?msg=creado");
        } else {
            echo "Hubo un error guardando en la Base de Datos.";
        }
    

    } else {
        header("Location: ../../index.php");
    }


?>