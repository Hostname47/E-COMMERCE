<?php

    include "../../config/DbConnect.php";
    class CategoryManager {
        private $link;
        public $categoryPicturesLocation = "https://localhost/E-COMMERCE/Admin/assets/Images/Categories/";
        
        function __construct() {
            $connection = new dbConnection();
            $this->link = $connection->connect();
            return $this->link;
        }
        
        function insertCategory($cat_name, $desc, $picture, $active) {
            if($this->checkCategoryExists($cat_name)) {
                return 0;
            } else {
                $query = $this->link->prepare("INSERT INTO Category (categoryName, description, picture, active) VALUES (:cat_name, :desc, :picture, :active)");
                $query->bindParam(":cat_name", $cat_name);
                $query->bindParam(":desc", $desc);
                $query->bindParam(":picture", $picture);
                $query->bindParam(":active", $active);

                $query->execute();
                $counts = $query->rowCount();
                
                return $counts;
            }
        }

        function checkCategoryExists($cat_name) {
            $cat_name = $this->cleanData($cat_name);
            
            $query = $this->link->prepare("Select * FROM Category where categoryName = :cat_name");
            $query->bindParam(":cat_name", $cat_name);
            $query->execute();
            $counts = $query->rowCount();

            if($counts > 0) {
                return true;
            } else
                return false;
        }

        function cleanData($data) {
            $data = htmlspecialchars($data);
            $data = trim($data);
    
            return $data;
        }
    }

?>