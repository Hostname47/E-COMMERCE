<?php
    include "../../../config/dbConnect.php";

    $link = "";
    $connection = new dbConnection();
    $link = $connection->connect();

    $name = $_GET["name"];
    $category = $_GET["category"];
    $min = $_GET["min"];
    $max = $_GET["max"];
    $min_bound = $_GET["min_bound"];
    $number_of_products_per_page = $_GET["prod_number"];

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

        $query .= " ORDER BY products.categoryID LIMIT $min_bound, $number_of_products_per_page";

        $statement = $link->prepare($query);
        
        $statement->execute();

        $products = $statement->fetchAll(PDO::FETCH_ASSOC);

        $result_products_number = $statement->rowCount();
        echo "<input type='hidden' value='$result_products_number' id='nums'>";

        foreach($products as $key => $product) {
            if($product['UnitsInStock'] - $product['UnitsOnOrder'] > 0) {
                $av = "Yes";
                $class = "available";
            }else {
                $av = "No";
                $class = "not-available";
            }
    
            $pic = "{$product['pic']}";
    
            $discountedPrice = $product['unitPrice'] - (20 * $product['unitPrice'] / 100);
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

?>