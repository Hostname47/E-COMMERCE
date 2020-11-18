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
            
                /*echo $prod_name. '-' .$prod_sku. "--" .$prod_desc. "--" .$prod_supplier. "--" .
                $prod_category. "--" .$prod_available_sizes. "--" . $prod_available_colors. "--" . $prod_size. "--" . $prod_color. "--" .
                $prod_unit_price. "--" .$prod_discount. "--" .$prod_unit_weight. "--" .$prod_units_in_stock. "--" .$prod_units_on_order. "--" .
                $prod_available. "--" .$prod_keywords. "--" .$prod_picture;*/

            try {
                $query = $this->link->prepare("INSERT INTO `products` 
                (`SKU`, `productName`, `productDescription`, `supplierID`, 
                `categoryID`, `unitPrice`, `availableSizes`, `availableColors`, `size`, `color`, `discount`, 
                `unitWeight`, `UnitsInStock`, `UnitsOnOrder`, `productAvailable`, `picture`, `keywords`) 
                VALUES 
                ('$prod_sku' , '$prod_name' , '$prod_desc', $prod_supplier, 
                $prod_category, $prod_unit_price, '$prod_available_sizes', '$prod_available_colors', '$prod_size', '$prod_color', $prod_discount, 
                $prod_unit_weight, $prod_units_in_stock, $prod_units_on_order, $prod_available, '$prod_picture', '$prod_keywords')");

            /* DECIMAL PDO BINDING PROBLEM */
            /*$query->bindParam(":productName", $prod_name, PDO::PARAM_STR);
            $query->bindParam(":SKU", $prod_sku, PDO::PARAM_STR);
            $query->bindParam(":productDescription", $prod_desc, PDO::PARAM_STR);
            ...
            */

            /*$query->execute(array(":productName"=>$prod_name, ":SKU"=>$prod_sku,":productDescription"=>$prod_desc,
            ":supplierID"=>$prod_supplier,":categoryID"=>$prod_category,":availableSizes"=>$prod_available_sizes,":availableColors"=>$prod_available_colors,
            ":size"=>$prod_size,":color"=>$prod_color,":unitPrice"=>$prod_unit_price,":discount"=>$prod_discount,
            ":unitWeight"=>$prod_unit_weight,":UnitsInStock"=>$prod_units_in_stock,":UnitsOnOrder"=>$prod_units_on_order,":productAvailable"=>$prod_available,
            ":keywords"=>$prod_keywords,":picture"=>$prod_picture));*/

            $query->execute();


            } catch(PDOException $es) {
                echo $es->getMessage();
            }

            return $query->rowCount();
        }

        function getProductsByCategory($category=0) {
            if($category == 0) {
                return $this->selectAllProducts();
            } else {
                try {                    
                    $query = $this->link->prepare("SELECT `productID`, `SKU`, `productName`, `productDescription`, `supplierID`, 
                    products.categoryID, `unitPrice`, `availableSizes`, `availableColors`, `size`, `color`, `discount`, `unitWeight`, 
                    `UnitsInStock`, `UnitsOnOrder`, `productAvailable`, products.picture AS pic, `categoryName`, `keywords`, category.categoryID, category.picture FROM `products`
                    INNER JOIN category ON products.categoryID = category.categoryID WHERE category.categoryID = {$category}");

                    $query->execute();

                    $result = $query->fetchAll(PDO::FETCH_ASSOC);

                    return $result;
                }
                catch(PDOException $ex) {
                    echo $ex->getMessage();
                }
            }
        }

        function selectAllProducts() {
            try {
                $query = $this->link->prepare("SELECT `productID`, `SKU`, `productName`, `productDescription`, `supplierID`, 
                products.categoryID, `unitPrice`, `availableSizes`, `availableColors`, `size`, `color`, `discount`, `unitWeight`, 
                `UnitsInStock`, `UnitsOnOrder`, `productAvailable`, products.picture AS pic, `categoryName`, `keywords`, category.categoryID, category.picture FROM `products`
                INNER JOIN category ON products.categoryID = category.categoryID");

                $query->execute();

                $result = $query->fetchAll(PDO::FETCH_ASSOC);

                return $result;
            } catch(PDOException $ex) {
                echo $ex->getMessage();
            }
        }

        function getProductsByProdName($category=0, $prod_name) {
            try {
                if($category == 0) {
                    $query = $this->link->prepare("SELECT `productID`, `SKU`, `productName`, `productDescription`, `supplierID`, 
                    products.categoryID, `unitPrice`, `availableSizes`, `availableColors`, `size`, `color`, `discount`, `unitWeight`, 
                    `UnitsInStock`, `UnitsOnOrder`, `productAvailable`, products.picture AS pic, `categoryName`, `keywords`, category.categoryID, category.picture FROM `products`
                INNER JOIN category ON products.categoryID = category.categoryID WHERE productName LIKE '%{$prod_name}%'");
                } else {
                    $query = $this->link->prepare("SELECT `productID`, `SKU`, `productName`, `productDescription`, `supplierID`, 
                    products.categoryID, `unitPrice`, `availableSizes`, `availableColors`, `size`, `color`, `discount`, `unitWeight`, 
                    `UnitsInStock`, `UnitsOnOrder`, `productAvailable`, products.picture AS pic, `categoryName`, `keywords`, category.categoryID, category.picture FROM `products`
                    INNER JOIN category ON products.categoryID = category.categoryID WHERE category.categoryID = {$category} AND productName LIKE '%{$prod_name}%'");
                }

                $query->execute();

                $result = $query->fetchAll(PDO::FETCH_ASSOC);

                return $result;
            }
            catch(PDOException $ex) {
                echo $ex->getMessage();
            }
        }

        function getProductNameById($id) {
            // Get product name by id to pass it to rename to change the product directory that hold the image
            
        }

        function getProductById($id) {
            $query = $this->link->prepare("SELECT `SKU`, `productName`, `productDescription`, `supplierID`, 
                products.categoryID, `unitPrice`, `availableSizes`, `availableColors`, `size`, `color`, `discount`, `unitWeight`, 
                `UnitsInStock`, `UnitsOnOrder`, `productAvailable`, products.picture AS pic, `keywords`, category.categoryID FROM `products`
                INNER JOIN category ON products.categoryID = category.categoryID WHERE productID = :id");

            $query->bindParam(":id", $id);
            $query->execute();
            $result = $query->fetch();

            return $result;
        }

        function getFilteredProducts($name, $category, $min, $max) {
            try {
                $result_products_number = 0;

                $query = "SELECT `productID`, `SKU`, `productName`, `productDescription`, `supplierID`, 
                products.categoryID, `unitPrice`, `availableSizes`, `availableColors`, `size`, `color`, `discount`, `unitWeight`, 
                `UnitsInStock`, `UnitsOnOrder`, `productAvailable`, products.picture AS pic, `categoryName`, `keywords`, category.categoryID, category.picture FROM `products`
                INNER JOIN category ON products.categoryID = category.categoryID ";

                if(empty($name) && empty($min) && empty($max)) {
                    if($category == 0) {
                        
                    } else {
                        $query .= "WHERE products.categoryID = {$category}";
                    }
                } else if(empty($name) && !empty($min) && empty($max)) {
                    if($category == 0) {
                        $query .= "WHERE unitPrice > {$min}";
                    } else {
                        $query .= "WHERE unitPrice > {$min} AND products.categoryID = {$category}";
                    }
                } else if(empty($name) && empty($min) && !empty($max)) {
                    if($category == 0) {
                        $query .= "WHERE unitPrice <= {$max}";
                    } else {
                        $query .= "WHERE unitPrice <= {$max} AND products.categoryID = {$category}";
                    }
                } else if(empty($name) && !empty($min) && !empty($max)) {
                    if($category == 0) {
                        $query .= "WHERE unitPrice <= {$max} AND unitPrice > {$min}";
                    } else {
                        $query .= "WHERE unitPrice <= {$max} AND unitPrice > {$min} AND products.categoryID = {$category}";
                    }
                } else if(!empty($name) AND empty($min) AND empty($max)) {
                    if($category == 0) {
                        $query .= "WHERE productName LIKE '%{$name}%' OR keywords LIKE '%{$name}%'";
                    } else {
                        $query .= "WHERE (productName LIKE '%{$name}%' OR keywords LIKE '%{$name}%') AND products.categoryID = {$category}";
                    }
                } else if(!empty($name) AND !empty($min) AND empty($max)) {
                    if($category == 0) {
                        $query .= "WHERE unitPrice > {$min} AND (productName LIKE '%{$name}%' OR keywords LIKE '%{$name}%')";
                    } else {
                        $query .= "WHERE unitPrice > {$min} AND (productName LIKE '%{$name}%' OR keywords LIKE '%{$name}%') AND products.categoryID = {$category}";
                    }
                } else if(!empty($name) AND empty($min) AND !empty($max)) {
                    if($category == 0) {
                        $query .= "WHERE unitPrice <= {$max} AND  (productName LIKE '%{$name}%' OR keywords LIKE '%{$name}%')";
                    } else {
                        $query .= "WHERE unitPrice <= {$max} AND (productName LIKE '%{$name}%' OR keywords LIKE '%{$name}%') AND products.categoryID = {$category}";
                    }
                } else if(!empty($name) AND !empty($min) AND !empty($max)) {
                    if($category == 0) {
                        $query .= "WHERE unitPrice <= {$max} AND unitPrice > {$min} AND (productName LIKE '%{$name}%' OR keywords LIKE '%{$name}%')";
                    } else {
                        $query .= "WHERE unitPrice <= {$max} AND unitPrice > {$min} AND (productName LIKE '%{$name}%' OR keywords LIKE '%{$name}%') AND products.categoryID = {$category}";
                    }
                }

                $query .= " ORDER BY products.categoryID";

                $statement = $this->link->prepare($query);
                
                $statement->execute();

                $products = $statement->fetchAll(PDO::FETCH_ASSOC);

                $result_products_number = $statement->rowCount();
                echo "<input type='hidden' value='$result_products_number' id='nums'>";

                $iterator = 0;
                foreach($products as $key => $product) {
                    if($iterator == 8) {
                        $iterator = 0;
                        break;
                    }

                    $iterator++;
                    if($product['UnitsInStock'] - $product['UnitsOnOrder'] > 0) {
                        $av = "Yes";
                        $class = "available";
                    }else {
                        $av = "No";
                        $class = "not-available";
                    }
            
                    $pic = "{$product['pic']}";
                    
                    $discountedPrice = $product['unitPrice'] - (($product['discount'] * $product['unitPrice']) / 100.00);
                    
                    echo <<<EOS
                        <div class="product-item">
                            <img src="../../Products/{$pic}" alt="product image not found" class="product-img">
                            <p class="product-name product-label">{$product['productName']}</p>
                            <p class="product-label">Category: <span class="product-data-label">{$product['categoryName']}</span></p>
                            <p class="product-label">Available: <span class="product-data-label {$class}">{$av}</span></p>
                            <p style="margin-bottom: 8px" class="product-label">Price: <span class="original-price">{$product['unitPrice']}$</span><span style="font-size: 18px">{$discountedPrice}$</span></p>
                            <div style="margin-left: auto; margin-top: auto;" class="flex-column">
                                <a href="#" id="man-product" onclick="printProductInfos({$product['productID']}); return false;">Manage product</a>
                            </div>
                        </div>
                    EOS;
                }
            } catch(PDOException $ex) {
                echo $ex->getMessage();
            }

            return $result_products_number;
        }

        function editProduct($id, $prod_name, $prod_sku, $prod_desc, $prod_supplier, 
        $prod_category, $prod_available_sizes, $prod_available_colors, $prod_size, $prod_color,
        $prod_unit_price, $prod_discount, $prod_unit_weight, $prod_units_in_stock, $prod_units_on_order,
        $prod_available, $prod_keywords, $prod_picture ) {

            try {
            $query = $this->link->prepare("
                UPDATE `products` 
                SET 
                `SKU`='{$prod_sku}',
                `productName`='{$prod_name}',
                `productDescription`='$prod_desc',
                `supplierID`=$prod_supplier,
                `categoryID`=$prod_category,
                `unitPrice`=$prod_unit_price,
                `availableSizes`='$prod_available_sizes',
                `availableColors`='$prod_available_colors',
                `size`='$prod_size',
                `color`='$prod_color',
                `discount`=$prod_discount,
                `unitWeight`=$prod_unit_weight,
                `UnitsInStock`=$prod_units_in_stock,
                `UnitsOnOrder`=$prod_units_on_order,
                `productAvailable`=$prod_available,
                `picture`='{$prod_picture}',
                `keywords`='{$prod_keywords}' WHERE productID = :id");

            $query->bindParam(":id", $id);

            $query->execute();
            return $query->rowCount();

            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }

        function deleteProduct($id) {
            $query = $this->link->prepare("DELETE FROM products WHERE productID = :id");
            $query->bindParam(":id", $id);

            $query->execute();

            return $query->rowCount();
        }

        function getRowCount() {
            $stmt = $this->link->prepare('SELECT * FROM products');
            
            $stmt->execute();
            return $stmt->rowCount();
        }
    }

?>