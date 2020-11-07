<?php
    include "../../config/DbConnect.php";
    
    class ProductManager {
        private $link;

        function __construct() {
            $connection = new dbConnection();
            $this->link = $connection->connect();
            return $this->link;
        }
    
        function productNameExists($prod_name) {
            $query = $this->link->prepare("SELECT * FROM product WHERE productName = :productName");
            $query->bindParam(":productName", $prod_name);
            $query->execute();
            
            return ($query->rowCount() > 0) ? true : false;
        }

    }

?>