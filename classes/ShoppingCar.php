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
    }

?>