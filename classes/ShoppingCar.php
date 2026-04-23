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
    }

?>
