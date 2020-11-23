<?php

    class Category {
        private $conn;
        public $table = "category";

        public $cateoryID;
        public $cateoryName;
        public $description;
        public $picture;
        public $active;

        public function __construct($db) {
            $this->conn = $db;
        }

        public function read() {
            $query = "SELECT * FROM " . $this->table;

            $stmt = $this->conn->prepare($query);

            $stmt->execute();

            return $stmt;
        }

        public function read_single($id) {
            $query = "SELECT * FROM " . $this->table . " WHERE categoryID = :id";

            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(":id", $id);

            $stmt->execute();

            return $stmt;
        }
    }

?>