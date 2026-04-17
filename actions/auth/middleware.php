<?php 

    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    function requireLogin(){
        if(!isset($_SESSION['user_id'])){
            header("Location: ../../login.php");
            exit;
        }
    }

    function requireAdmin(){

        requireLogin();

        if(!isset($_SESSION['user_rol']) || $_SESSION['user_rol'] !== 'admin'){
            header("Location: /ecomerce/login.php");
            exit;
        }

    }
?>