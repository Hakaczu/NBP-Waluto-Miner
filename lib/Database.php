<?php

    class Database{
        // specify your own database credentials
        private $dbtype = 'prod';
        private $host = "localhost";
        private $db_name = "database";
        private $username = "root";
        private $password = "";
        public $conn;
        
        public function __construct()
        {
            if($this->dbtype == 'prod'){
                $config = include("../config/walutobase.php");
                $this->host = $config['host'];
                $this->db_name = $config['name'];
                $this->username = $config['user'];
                $this->password = $config['pass'];
            }else{
                $config = include("../config/localhost.php");
                $this->host = $config['host'];
                $this->db_name = $config['name'];
                $this->username = $config['user'];
                $this->password = $config['pass'];
            }
            
        }

        // get the database connection
        public function getConnection(){
    
            $this->conn = null;
    
            try{
                $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
                $this->conn->exec("set names utf8");
            }catch(PDOException $exception){
                http_response_code(500);
                echo $exception;
            }
            return $this->conn;
        }

    }   


?>