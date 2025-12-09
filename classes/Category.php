<?php 
    
    class Category{ 
        private $conn;
        private $table_name = 'categorias';

        public $id;
        public $nombre;

        public function __construct($db){
            $this->conn = $db;
        }

        public function read(){
            $query = "SELECT * FROM ".$this->table_name;
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt;
        }

        public function create(){
            $query = "INSERT INTO ".$this->table_name ." SET nombre = :nombre ";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(":nombre", $this->nombre);

            if($stmt->execute()){
                return true;
            }
            return false;
        }


    }


?>