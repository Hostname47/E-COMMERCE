<?php

class Product {
    private $conn;
    public $table = "products";
    public $number_of_product_per_page = 8;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function readFilteredProducts($name, $category, $min, $max) {
        try {
            $result_products_number = 0;

            $query = "SELECT `productID`, `SKU`, `productName`, `productDescription`, `supplierID`, 
                products.categoryID, `unitPrice`, `availableSizes`, `availableColors`, `size`, `color`, `discount`, `unitWeight`, 
                `UnitsInStock`, `UnitsOnOrder`, `productAvailable`, numberOfRates, rate, products.picture AS pic, `categoryName`, `keywords`, category.categoryID, category.picture FROM `products`
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

            $statement = $this->conn->prepare($query);
            
            $statement->execute();

            $products = $statement->fetchAll(PDO::FETCH_ASSOC);

            $result_products_number = $statement->rowCount();

            $iterator = 0;
            foreach($products as $key => $product) {
                $prod_name = strlen($product["productName"]) > 45 ? substr($product["productName"], 0, 30) . " .." : $product["productName"];

                // Add comma after every 3 digits into price
                $price = number_format($product['unitPrice'],2,",",".");

                $disc = number_format($product['unitPrice'] - (($product['discount'] * $product['unitPrice']) / 100.00),2,",",".");

                echo "<div class='product-item'>";
                echo <<<EOS
                    <input type='hidden' class='current-product-id' value="{$product['productID']}">
                EOS;
                if($product['discount'] > 0) {
                        echo <<<EOS
                            <!-- discount -->
                            <div class="discount-part">
                                <span class="discount-value">{$product["discount"]}</span>% OFF
                            </div>
                            <!-- love product -->
                            <div class="product-like-container">
                                <a href="#"><img class="product-like" src="images/product-assets/like.png" alt=""></a>
                            </div>
                            <!-- product image -->
                            <div class="product-image-container">
                                <a href="" class="product-see-more"><img class="product-image" src="https://localhost/E-COMMERCE/Admin/Products/{$product["pic"]}" alt=""></a>
                            </div>
                            <hr class="line-underneath">
                            
                            <!-- product informations -->
                            <div class="product-info-container">
                                <p class="product-category">{$product['categoryName']}</p>
                                <p class="product-name">{$prod_name}</p>
                                <p class="product-price">{$disc}$<span class="discounted-price">{$price}</span></p>
                                <div class="rate-section">
                                    <div class="rate-color-container"></div>
                                    <img src="images/product-assets/rate.png" alt="rate" class="rate-stars-container">
                                    <p class="product-number-of-rates">({$product["numberOfRates"]})</p>
                                </div>
                                <div>
                                    <a href="#" class="product-add-to-cart">Add to cart</a>
                                </div>
                            </div>
                        </div>
                    EOS;
                } else {

                    echo <<<EOS
                            <!-- love product -->
                            <div class="product-like-container">
                                <a href="#"><img class="product-like" src="images/product-assets/like.png" alt=""></a>
                            </div>
                            <!-- product image -->
                            <div class="product-image-container">
                                <a href="#" class="product-see-more"><img class="product-image" src="https://localhost/E-COMMERCE/Admin/Products/{$product["pic"]}" alt=""></a>
                            </div>
                            <hr class="line-underneath">
                            
                            <!-- product informations -->
                            <div class="product-info-container">
                                <p class="product-category">{$product['categoryName']}</p>
                                <p class="product-name">{$prod_name}</p>
                                <p class="product-price">{$disc}$</p>
                                <div class="rate-section">
                                    <div class="rate-color-container"></div>
                                    <img src="images/product-assets/rate.png" alt="rate" class="rate-stars-container">
                                    <p class="product-number-of-rates">({$product["numberOfRates"]})</p>
                                </div>
                                <div>
                                    <a href="#" class="product-add-to-cart">Add to cart</a>
                                </div>
                            </div>
                        </div>
                    EOS;
                }
            }
        } catch(PDOException $ex) {
            echo $ex->getMessage();
        }
        
        return $result_products_number;
    }

    public function read() {
        $query = "SELECT `productID`, `SKU`, `productName`, `productDescription`, `supplierID`, 
        products.categoryID, `unitPrice`, `availableSizes`, `availableColors`, `size`, `color`, `discount`, `unitWeight`, 
        `UnitsInStock`, `UnitsOnOrder`, `productAvailable`, numberOfRates, rate, products.picture AS pic, `categoryName`, `keywords`, category.categoryID, category.picture FROM `products`
        INNER JOIN category ON products.categoryID = category.categoryID";

        $stmt = $this->conn->prepare($query);

        $stmt->execute();

        $res_count = $stmt->rowCount();

        $result = $stmt->fetchAll();

        foreach($result as $product) {
            $prod_name = strlen($product["productName"]) > 45 ? substr($product["productName"], 0, 30) . " .." : $product["productName"];

            // Add comma after every 3 digits
            $disc = number_format($product['unitPrice'] - (($product['discount'] * $product['unitPrice']) / 100.00),2,",",".");
            $price = number_format($product['unitPrice'],2,",",".");

            echo "<div class='product-item'>";
            if($product['discount'] > 0) {
                    echo <<<EOS
                        <!-- discount -->
                        <div class="discount-part">
                            <span class="discount-value">{$product["discount"]}</span>% OFF
                        </div>
                        <!-- love product -->
                        <div class="product-like-container">
                            <a href="#"><img class="product-like" src="images/product-assets/like.png" alt=""></a>
                        </div>
                        <!-- product image -->
                        <div class="product-image-container">
                            <a href="#"><img class="product-image" src="https://localhost/E-COMMERCE/Admin/Products/{$product["pic"]}" alt=""></a>
                        </div>
                        <hr class="line-underneath">
                        
                        <!-- product informations -->
                        <div class="product-info-container">
                            <p class="product-category">{$product['categoryName']}</p>
                            <p class="product-name">{$prod_name}</p>
                            <p class="product-price">{$disc}$<span class="discounted-price">{$price}</span></p>
                            <div class="rate-section">
                                <div class="rate-color-container"></div>
                                <img src="images/product-assets/rate.png" alt="rate" class="rate-stars-container">
                                <p class="product-number-of-rates">({$product["numberOfRates"]})</p>
                            </div>
                            <div>
                                <a href="#" class="product-add-to-cart">Add to cart</a>
                            </div>
                        </div>
                    </div>
                EOS;
            } else {

                echo <<<EOS
                        <!-- love product -->
                        <div class="product-like-container">
                            <a href="#"><img class="product-like" src="images/product-assets/like.png" alt=""></a>
                        </div>
                        <!-- product image -->
                        <div class="product-image-container">
                            <a href="#"><img class="product-image" src="https://localhost/E-COMMERCE/Admin/Products/{$product["pic"]}" alt=""></a>
                        </div>
                        <hr class="line-underneath">
                        
                        <!-- product informations -->
                        <div class="product-info-container">
                            <p class="product-category">{$product['categoryName']}</p>
                            <p class="product-name">{$prod_name}</p>
                            <p class="product-price">{$disc}$</p>
                            <div class="rate-section">
                                <div class="rate-color-container"></div>
                                <img src="images/product-assets/rate.png" alt="rate" class="rate-stars-container">
                                <p class="product-number-of-rates">({$product["numberOfRates"]})</p>
                            </div>
                            <div>
                                <a href="#" class="product-add-to-cart">Add to cart</a>
                            </div>
                        </div>
                    </div>
                EOS;
            }
        }
        echo $res_count;
        return $res_count;
    }

    public function getProductsCount() {
        $query = "SELECT * FROM products";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt->rowCount();
    }
}

?>