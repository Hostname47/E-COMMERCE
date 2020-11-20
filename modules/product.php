<?php

class Product {
    private $conn;
    public $table = "products";

    public function __construct($db) {
        $this->conn = $db;
    }

    public function read() {
        $query = "SELECT * FROM " . $this->table;

        $stmt = $this->conn->prepare($query);

        $stmt->execute();

        $result = $stmt->fetchAll();

        foreach($result as $product) {
            echo <<<EOS
                <div class="product-item">
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
                        <a href="#"><img class="product-image" src="images/featured-product-assets/bvlgary.png" alt=""></a>
                    </div>
                    <hr class="line-underneath">
                    
                    <!-- product informations -->
                    <div class="product-info-container">
                        <p class="product-category">Category: watches</p>
                        <p class="product-name">Octo Finissimo Skeleton In Rose Gold With Strap</p>
                        <p class="product-price">24,560$<span class="discounted-price">30,700$</span></p>
                        <div class="rate-section">
                            <div class="rate-color-container">
                                
                            </div>
                            <img src="images/product-assets/rate.png" alt="rate" class="rate-stars-container">
                            <p class="product-number-of-rates">(32)</p>
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

?>