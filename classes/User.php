<?php 

    class User{ 

        private $conn;
        private $table_name = "usuarios";

        public $id;
        public $nombre;
        public $email;
        public $password;
        public $rol;

        public function __construct($db){
            $this->conn = $db;
        }

        public function login($email, $password){
            $query = "SELECT id, nombre, password, rol FROM ".$this->table_name. "WHERE email = :email LIMIT 1";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam("email:", $email);
            $stmt->execute();

            if($stmt->rowCount() > 0){
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                if(password_verify($password, $row['password'])){
                    $this->id = $row['id'];
                    $this->nombre = $row['nombre'];
                    $this->rol = $row['rol'];
                    return true;
                }
            }

            return false;

        }

        public function create(){
            $query = "INSET INTO ".$this->table_name. " 
                        SET 
                           nombre = :nombre,
                           email = :email,
                           password = :password,
                           rol = 'usuarios' ";
            $stmt = $this->conn->prepare($query);


            // password_hash crea un hash seguro y unico usando Bcrypt por defecto
            $password_hash = password_hash($this->password, PASSWORD_DEFAULT);

            $stmt->bindParam(":nombre", $this->nombre);
            $stmt->bindParam(":email", $this->email);
            $stmt->bindParam(":password", $password_hash); // Guardamos el Hash


            try {
                if($stmt->execute()){
                    return true;
                }
            } catch (PDOException $e) {
                if($e->getCode() == 23000){
                    echo 'Error: El email ya esta registrado';
                }else {
                    echo 'Error: '. $e->getMessage();
                }
            }
        }

    }

?>