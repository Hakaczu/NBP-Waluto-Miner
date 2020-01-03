<?php

    class Database{
        // specify your own database credentials
        private $host = "localhost";
        private $db_name = "WalutoBase";
        private $username = "root";
        private $password = "";
        public $conn;
        
        public function __construct()
        {
            $config = include("./config/localhost.php");
            $this->host = $config['host'];
            $this->db_name = $config['name'];
            $this->username = $config['user'];
            $this->password = $config['pass'];
        }

        // get the database connection
        public function getConnection(){
    
            $this->conn = null;
    
            try{
                $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
                $this->conn->exec("set names utf8");
            }catch(PDOException $exception){
                echo "Connection error: " . $exception->getMessage();
            }
            return $this->conn;
        }

    }   


?>