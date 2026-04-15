<?php 

    require_once '../../classes/database.php';
    require_once '../../classes/User.php';

    if($_POST){
        $database = new Database();
        $db = $database->getConnection();

        $user = new User($db);

        $user->nombre = $_POST['nombre'];
        $user->email = $_POST['email'];
        $user->password = $_POST['password'];

        if($user->create()){
            header('Location: ../../login.php?msg=registrado');
        }else{
            header("Locaiton: ../../loging.php?msg=error");
        }
        
    } else {
        header("Location: ../../registro.php");
    }
?>