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
            $query = $this->link->prepare("SELECT * FROM products WHERE productName = :productName");
            $query->bindParam(":productName", $prod_name);
            $query->execute();
            
            return ($query->rowCount() > 0) ? true : false;
        }

        function addProduct($prod_name, $prod_sku, $prod_desc, $prod_supplier, 
            $prod_category, $prod_available_sizes, $prod_available_colors, $prod_size, $prod_color,
            $prod_unit_price, $prod_discount, $prod_unit_weight, $prod_units_in_stock, $prod_units_on_order,
            $prod_available, $prod_keywords, $prod_picture ) {

                echo $prod_name."----".$prod_sku."----".$prod_desc."----".$prod_supplier."----".
                $prod_category."----".$prod_available_sizes."----".$prod_available_colors."----".$prod_size."----".$prod_color."----".
                $prod_unit_price."----".$prod_discount."----".$prod_unit_weight."----".$prod_units_in_stock."----".$prod_units_on_order."----".
                $prod_available."----".$prod_keywords."----".$prod_picture;

            try {
            $query = $this->link->prepare("INSERT INTO `products` 
            (`SKU`, `productName`, `productDescription`, `supplierID`, 
            `categoryID`, `unitPrice`, `availableSizes`, `availableColors`, `size`, `color`, `discount`, 
            `unitWeight`, `UnitsInStock`, `UnitsOnOrder`, `productAvailable`, `picture`, `keywords`) 
            VALUES 
            (':SKU', ':productName', ':productDescription', :supplierID, 
            :categoryID, :unitPrice, ':availableSizes', ':availableColors', ':size', ':color', :discount, 
            :unitWeight, :UnitsInStock, :UnitsOnOrder, :productAvailable, ':picture', ':keywords')");

            $query->bindParam(":productName", $prod_name);
            $query->bindParam(":SKU", $prod_sku);
            $query->bindParam(":productDescription", $prod_desc);
            $query->bindParam(":supplierID", $prod_supplier);
            $query->bindParam(":categoryID", $prod_category);
            $query->bindParam(":availableSizes", $prod_available_sizes);
            $query->bindParam(":availableColors", $prod_available_colors);
            $query->bindParam(":size", $prod_size);
            $query->bindParam(":color", $prod_color);
            $query->bindParam(":unitPrice", $prod_unit_price, PDO::PARAM_STR);
            $query->bindParam(":discount", $prod_discount, PDO::PARAM_STR);
            $query->bindParam(":unitWeight", $prod_unit_weight, PDO::PARAM_STR);
            $query->bindParam(":UnitsInStock", $prod_units_in_stock);
            $query->bindParam(":UnitsOnOrder", $prod_units_on_order);
            $query->bindParam(":productAvailable", $prod_available);
            $query->bindParam(":keywords", $prod_keywords);
            $query->bindParam(":picture", $prod_picture);

            /*$query->execute(array(":productName"=>$prod_name, ":SKU"=>$prod_sku,":productDescription"=>$prod_desc,
            ":supplierID"=>$prod_supplier,":categoryID"=>$prod_category,":availableSizes"=>$prod_available_sizes,":availableColors"=>$prod_available_colors,
            ":size"=>$prod_size,":color"=>$prod_color,":unitPrice"=>$prod_unit_price,":discount"=>$prod_discount,
            ":unitWeight"=>$prod_unit_weight,":UnitsInStock"=>$prod_units_in_stock,":UnitsOnOrder"=>$prod_units_on_order,":productAvailable"=>$prod_available,
            ":keywords"=>$prod_keywords,":picture"=>$prod_picture));*/

            $query->execute();

            } catch(PDOException $es) {
                return $es->getMessage();
            }

            return $query->rowCount();
        }

    }

?>