<?php 

    class ShoppingCar{
        private $conn;
        private $table_cart = 'carrito';
        private $table_items = 'items_carrito';

        public function __construct($db){
            $this->conn = $db;
        }

        public function getCartId($user_id){
            $query = "SELECT id FROM  ".$this->table_cart. " WHERE usuario_id = :idUsuario";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(":idUsuario", $user_id);
            $stmt->execute();

            if($stmt->rowCount() > 0){
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                return $row['id'];
            }

            $query = "INSERT INTO ".$this->table_cart." (usuario_id) VALUES (:idUsuario)";

            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(":idUsuario", $user_id);
            $stmt->execute();
            return $this->conn->lastInsertId();
        }

        public  function addItem($product_id, $cantidad, $user_id){

            $carrito_id = $this->getCartId($user_id);

            $query = "SELECT id FROM ".$this->table_items." WHERE carrito_id = :carritoId and producto_id = :productoId";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(":carritoId", $carrito_id);
            $stmt->bindParam(":productoId", $product_id);
            $stmt->execute();

            if($stmt->rowCount() > 0){
                $row = $stmt->fetch(PDO::FETCH_ASSOC);

                $query = "UPDATE ".$this->table_items." SET cantidad = cantidad + :cantidadNueva WHERE id = :idFila";
                $stmt = $this->conn->prepare($query);
                $stmt->bindParam(":cantidadNueva", $cantidad);
                $stmt->bindParam(":idFila", $row['id']);
                $stmt->execute();
            }else{
                
                $query = "INSERT INTO ".$this->table_items." (carrito_id, producto_id, cantidad) VALUES (:carritoId, :productoId, :cantidad)";
                $stmt = $this->conn->prepare($query);
                $stmt->bindParam(":carritoId", $carrito_id);
                $stmt->bindParam(":productoId", $product_id);
                $stmt->bindParam(":cantidad", $cantidad);
                $stmt->execute();
            }
        }


        public function getCartItems($user_id){
            
            $carrito_id = $this->getCartId($user_id);

            $query = "SELECT p.id AS producto_id, 
                            p.nombre AS producto_nombre, 
                            p.precio, 
                            p.imagen, 
                            c.nombre AS categoria_nombre, 
                            ic.cantidad,
                            ic.id AS item_carrito_id FROM ".$this->table_items." ic
                        INNER JOIN productos p ON ic.producto_id = p.id
                        INNER JOIN categorias c ON p.categoria_id = c.id
                        WHERE ic.carrito_id = :carritoId";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(":carritoId", $carrito_id);
            $stmt->execute();

            $items = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $items;
        }

        public function countQuantity($user_id){
            $carrito_id = $this->getCartId($user_id);

            $query = "SELECT SUM(precio * cantidad) FROM ".$this->table_items." INNER JOIN productos ON ".$this->table_items.".producto_id = productos.id WHERE carrito_id = :carritoId";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(":carritoId", $carrito_id);
            $stmt->execute();
            return $stmt->fetchColumn();
        }
    }

?>
