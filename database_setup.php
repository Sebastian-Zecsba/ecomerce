<?php

require_once __DIR__ . '/classes/database.php';

$database = new Database();
$db = $database->getConnection();

if (!$db) {
    exit('No se pudo conectar a la base de datos.');
}

$queries = [
    "CREATE TABLE IF NOT EXISTS usuarios (
        id INT AUTO_INCREMENT PRIMARY KEY,
        nombre VARCHAR(100) NOT NULL,
        email VARCHAR(150) NOT NULL UNIQUE,
        password VARCHAR(255) NOT NULL,
        rol VARCHAR(50) NOT NULL DEFAULT 'usuarios',
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4",

    "CREATE TABLE IF NOT EXISTS categorias (
        id INT AUTO_INCREMENT PRIMARY KEY,
        nombre VARCHAR(100) NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4",

    "CREATE TABLE IF NOT EXISTS productos (
        id INT AUTO_INCREMENT PRIMARY KEY,
        categoria_id INT NOT NULL,
        nombre VARCHAR(150) NOT NULL,
        descripcion TEXT,
        precio DECIMAL(10,2) NOT NULL,
        stock INT NOT NULL DEFAULT 0,
        imagen VARCHAR(255),
        created_at DATETIME,
        CONSTRAINT fk_productos_categoria
            FOREIGN KEY (categoria_id) REFERENCES categorias(id)
            ON DELETE RESTRICT
            ON UPDATE CASCADE
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4",

    "CREATE TABLE IF NOT EXISTS carrito (
        id INT AUTO_INCREMENT PRIMARY KEY,
        usuario_id INT NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        CONSTRAINT fk_carrito_usuario
            FOREIGN KEY (usuario_id) REFERENCES usuarios(id)
            ON DELETE CASCADE
            ON UPDATE CASCADE
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4",

    "CREATE TABLE IF NOT EXISTS items_carrito (
        id INT AUTO_INCREMENT PRIMARY KEY,
        carrito_id INT NOT NULL,
        producto_id INT NOT NULL,
        cantidad INT NOT NULL DEFAULT 1,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        CONSTRAINT fk_items_carrito_carrito
            FOREIGN KEY (carrito_id) REFERENCES carrito(id)
            ON DELETE CASCADE
            ON UPDATE CASCADE,
        CONSTRAINT fk_items_carrito_producto
            FOREIGN KEY (producto_id) REFERENCES productos(id)
            ON DELETE CASCADE
            ON UPDATE CASCADE,
        UNIQUE KEY unique_cart_product (carrito_id, producto_id)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4",
];

try {
    foreach ($queries as $query) {
        $db->exec($query);
    }

    echo 'Tablas creadas o verificadas correctamente.';
} catch (PDOException $exception) {
    echo 'Error creando tablas: ' . htmlspecialchars($exception->getMessage(), ENT_QUOTES, 'UTF-8');
}

