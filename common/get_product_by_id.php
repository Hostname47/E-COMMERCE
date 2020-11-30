<?php
    function getProductById($id) {
        // This file need $product_id to be defined before include it
        require "config/DB.php";

        try {
            $link;

            $connection = new Database();
            $link = $connection->connect();

            $query = $link->prepare("SELECT productID, `SKU`, `productName`, `productDescription`, p.`supplierID`, 
                p.categoryID, `unitPrice`, `availableSizes`, `availableColors`, `size`, `color`, `discount`, 
                `unitWeight`, `UnitsInStock`, `UnitsOnOrder`, `productAvailable`, s.contactFname, s.contactLname, 
                p.picture AS pic, p.numberOfRates, p.rate, `keywords`, c.categoryID, c.categoryName 
                FROM `products` p
                INNER JOIN category c 
                ON p.categoryID = c.categoryID 
                INNER JOIN supplier s 
                ON p.supplierID = s.supplierID 
                WHERE productID = :id");

            $query->bindParam(":id", $id);
            $query->execute();
            $result = $query->fetch(PDO::FETCH_ASSOC);

            $res = json_encode($result);
            return $res;

        } catch(PDOException $ex) {
            echo $ex->getMessage();
        }
    }
?>