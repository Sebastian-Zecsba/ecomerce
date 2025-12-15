<?php 

    class Product{
        private $conn;
        private $table_name = 'productos';

        public $id;
        public $categoria_id;
        public $nombre;
        public $descripcion;
        public $precio;
        public $stock;
        public $imagen;
        public $created_at;

        public function __construct($db){
            $this->conn = $db;
        }


        public function create(){
            $query = "INSERT INTO ". $this->table_name." 
                        SET 
                           categoria_id = :categoria_id,
                           nombre = :nombre,
                           descripcion = :descripcion,
                           precio = :precio,
                           stock = :stock,
                           imagen = :imagen,
                           created_at = :created;";

            $stmt = $this->conn->prepare($query);
            $this->created_at = date('Y-m-d H:i:s');    

            $stmt->bindParam(":categoria_id", $this->categoria_id);
            $stmt->bindParam(":nombre", $this->nombre);
            $stmt->bindParam(":descripcion", $this->descripcion);
            $stmt->bindParam(":precio", $this->precio);
            $stmt->bindParam(":stock", $this->stock);
            $stmt->bindParam(":imagen",       $this->imagen);
            $stmt->bindParam(":created", $this->created_at);

            if($stmt->execute()){
                return true;
            }
            return false;

        }

    }
 
?>