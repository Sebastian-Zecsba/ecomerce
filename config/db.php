<?php 

    $host = 'localhost';
    $dbname = 'tienda_db';
    $username = 'root';
    $password = '';

    try {
        
        // Instancia que conecta php con MySQL
        $dns = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";
        $pdo = new PDO($dns, $username, $password);

        // Configuracoin ded seguridad y usabilidad
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    } catch (PDOException $e) {
        die("Error crítico de conexión: " . $e->getMessage());
    }

?>