<?php

    try
    {
        $prod_manager = new ProductManager();
        $products = $prod_manager->getProductsByProdName($submitted_filter_category, $submitted_search_field);

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
                        <a href="#" id="man-product">Manage product</a>
                    </div>
                </div>
            EOS;
        }
    } catch(Exception $ex) {
        echo $ex->getMessage();
    }

?>