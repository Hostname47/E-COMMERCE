<?php
    Class Database {

        protected $conn;
        public $db_name = "ECOM";
        public $db_username = "mouad";
        public $db_password = "truestory123";
        public $db_host = "localhost";
        
        function connect() {
            try {
                $this->conn = new PDO("mysql:host=$this->db_host; dbname=$this->db_name", $this->db_username, $this->db_password);
                return $this->conn;
            } catch(PDOException $ex) {
                return "Connection error: " . $ex->getMessage();
            }
        }
    
    }

?>