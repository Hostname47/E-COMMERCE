<?php
    include "../design-entities/form-input.php";
    include "ProductManager.php";
    include "../validation/data-validation.php";

    $submitted_product_name
    = $submitted_sku 
    = $submitted_desc
    = $submitted_supplier
    = $submitted_category
    = $submitted_available_sizes
    = $submitted_available_colors
    = $submitted_size
    = $submitted_color
    = $submitted_picture
    = $submitted_keywords
    = $product_created
    = $err = "";

    $submitted_unit_price = $submitted_discount = $submitted_unit_weight = "0.00";
    $submitted_units_in_stock = $submitted_units_on_order = $submitted_product_available = "0";

    $error = ["skuErr"=>"", "product_nameErr"=>"", 
    "product_descErr"=>"", "product_supplierErr"=>"",
    "product_categoryErr"=>"", "product_unit_priceErr"=>"",
    "product_av_sizesErr"=>"", "product_av_colorsErr"=>"", 
    "product_sizeErr"=>"", "product_colorErr"=>"",
    "product_discountErr"=>"", "product_unit_weightErr"=>"",
    "product_units_in_stockErr"=>"", "product_units_on_orderErr" =>"",
    "product_availabilityErr"=>"", "product_pictureErr"=>"",
    "product_keywordsErr"=>""];

    if(isset($_POST["add-product"])) {
        include "API/validateData.php";
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Cache-control" content="no-cache">
    <title>Manage product</title>
    <link rel="stylesheet" href="../../css/header.css">
    <link rel="stylesheet" href="../../css/admin-pannel.css">
    <link rel="stylesheet" href="../../css/main-layout.css">
    <link rel="stylesheet" href="../../css/form-entities.css">
    <link rel="stylesheet" href="../../css/products.css">

    <link rel="icon" href="../../assets/icons/favicon.ico">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="../../js/admin-pannel-dynamics.js" defer></script>
    <script src="../../js/product.js" defer></script>
</head>
<body>
    <?php include "../../entities/header.php" ?>
    <main>
        <div class="admin-global-layout">
            <?php include "../../entities/left-pannel.php" ?>

            <div class="admin-main-layout">
                <div>
                    <div class="flex-row">
                        <h2 class="main-layout-title">Products Management</h2>
                        <div class="currency-container">
                            <div style="display: flex">
                                <label style="font-weight: bold; margin-left: 3px; font-size: 14px" for="currency">Currency</label>
                                <div class="invalid-credential"><?php //echo $error["currency"]; ?></div>
                            </div>
                            <select name="currency" id="currency">
                                <option value="dollar">$usd</option>
                                <option value="dollar">€euro</option>
                                <option value="dollar">£pound</option>
                                <option value="dollar">MAD</option>
                            </select>
                        </div>
                    </div>
                </div>
                <!-- search and filters container -->
                <div>
                    <p class="para">Search for a product</p>
                    <form action="#" method="POST" class="flex-row">
                        <input type="text" name="search-field" placeholder="Search .." class="search-field">
                        <input type="submit" value="search" name="search-button" class="search-button">
                    </form>
                    
                    <div class="flex-row" style="margin: 14px 0">
                        <div class="flex-row">
                            <p class="para basic-label">Category</p>
                            <?php
                                include "../design-entities/common-functions.php";
                                $comm = new CommonFunctionProvider();
                                $comm->getCategoriesAsDropDownList("basic-dropdownlist");
                            ?>
                        </div>
                    </div>

                    <!-- PRODUCT SECTION -->
                    <div class="products-container">
                        <?php
                        try
                        {
                            $prod_manager = new ProductManager();
                            $products = $prod_manager->getProductsByCategory(0);

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
                                        <p style="margin-bottom: 8px" class="product-label">Price: <span class="original-price">{$product['unitPrice']}</span><span style="font-size: 18px">{$discountedPrice}</span></p>
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
                        <div class="product-item">
                            <img src="../../assets/images/categories/4-513.png" alt="" class="product-img">
                            <p class="product-name product-label">New Apple iPhone 12 (64GB, Black) [Locked] + Carrier Subscription</p>
                            <p class="product-label">Category: <span class="product-data-label">TV & Movies</span></p>
                            <p class="product-label">Available: <span class="product-data-label">Yes</span></p>
                            <p style="margin-bottom: 8px" class="product-label">Price: <span class="original-price">1200$</span><span style="font-size: 18px">900$</span></p>
                            <div style="margin-left: auto; margin-top: auto;" class="flex-column">
                                <a href="#" id="man-product">Manage product</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script>
        $("#manage-product").addClass("selected-option");
        $("#product-related-items").css("display", "flex");
        $("#manage-product").on("click", function() {
            return false;
        })
    </script>
</body>
</html>