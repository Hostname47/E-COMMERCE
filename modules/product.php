<?php

class Product {
    private $conn;
    public $table = "products";

    public function __construct($db) {
        $this->conn = $db;
    }

    public function read() {
        $query = "SELECT `productID`, `SKU`, `productName`, `productDescription`, `supplierID`, 
        products.categoryID, `unitPrice`, `availableSizes`, `availableColors`, `size`, `color`, `discount`, `unitWeight`, 
        `UnitsInStock`, `UnitsOnOrder`, `productAvailable`, numberOfRates, rate, products.picture AS pic, `categoryName`, `keywords`, category.categoryID, category.picture FROM `products`
        INNER JOIN category ON products.categoryID = category.categoryID";

        $stmt = $this->conn->prepare($query);

        $stmt->execute();

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
    }
}

?>