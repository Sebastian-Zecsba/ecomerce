<?php 

    session_start();

    require_once '../../classes/database.php';
    require_once '../../classes/User.php';

    if($_POST){
        $database = new Database();
        $db = $database->getConnection();

        $user = new User($db);

        $email = $_POST['email'];
        $password = $_POST['password'];

        if($user->login($email, $password)){
            $_SESSION['user_id'] = $user->id;
            $_SESSION['user_nombre'] = $user->nombre;
            $_SESSION['user_rol'] = $user->rol;

            header("Location: ../../index.php");
        }else{
            header("Locaiton: ../../login.php?msg=error");
        }
    }else {
        header("Location: ../../login.php");
    }
?>