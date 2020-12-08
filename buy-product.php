<?php

    $product_id = $_GET["id"];

    include "common/get_product_by_id.php";

    $res = json_decode(getProductById($product_id));

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Cache-control" content="no-cache">
    <title>Buy - product name - ECOMEASY.com</title>
    
    <link rel="icon" href="images/favicon.ico">
    
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/global-styles.css">
    <link rel="stylesheet" href="css/product-style.css">
    <link rel="stylesheet" href="css/shop.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="css/buy-product.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js" defer></script>
    <script src="javascript/cookie.js" defer></script>
    <script src="javascript/header.js" defer></script>
    <script src="javascript/shop.js" defer></script>
    <script src="javascript/product.js" defer></script>
    <script src="javascript/buy-product.js" defer></script>

    
</head>
<body>
    <?php include "entities/header.php"; ?>

    <main>
        <div class="simple-strip-container">
            <a href="index.php" class="simple-menu-button" id="all-button">All</a>
            <a href="index.php" class="simple-menu-button">Home</a>
            <a href="shop.php" class="simple-menu-button">Shop</a>
            <a href="vw_cart.php" class="simple-menu-button">Cart</a>
            <a href="index.php" class="simple-menu-button">About</a>
        </div>
        <div>
            <!-- Back to result -->
            <div class="flex-center" style="margin: 2px 12px">
                <span>◂ </span>
                <a href="" id="back-to-shop-result" class="back-to-results">Back to results</a>
            </div>

            <!-- Product infos -->
            <div class="all-info-container">
                <div class="product-assets-container">
                    <div class="product-asset-container">
                        <img src="http://localhost/E-COMMERCE/Admin/Products/<?php echo $res->pic ?>" alt="" class="product-image-info">
                    </div>
                    <div class="product-asset-container">
                        <img src="http://localhost/E-COMMERCE/Admin/Products/<?php echo $res->pic ?>" alt="" class="product-image-info">
                    </div>
                    <div class="product-asset-container">
                        <video class="product-video-asset">
                            <source src="images/THE SEED Inspirational Short Film.mp4" type="video/mp4" class="product-video-asset">
                            <source src="" type="video/ogg" class="product-video-asset">
                            Your browser does not support the video tag.
                        </video>
                    </div>
                </div>
                <img src="http://localhost/E-COMMERCE/Admin/Products/<?php echo $res->pic ?>" id="image-demo" style="display: none" alt="">
                <canvas id="img-demo">

                </canvas>
                <img src="images/zoom-background.png" alt="Cursor" class="cursor"/>
                
                <div id="asset-demo" style="">
                    <video id="video-entity" controls>
                        <source src="images/THE SEED Inspirational Short Film.mp4" type="video/mp4" class="product-video-asset">
                        <source src="" type="video/ogg" class="product-video-asset">
                        Your browser does not support the video tag.
                    </video>
                </div>

                <div class="text-infos">
                    <p class="text-info-name"><?php echo $res->productName ?></p>
                    <div class="flex-center">
                        <p class="normal-text" style="margin-right: 10px; font-size: 15px">by <a href="" class="text-info-author"><?php echo $res->contactFname . " " . $res->contactLname ?></a></p>
                        <p class="normal-text"><span class="text-label">Category:</span> <?php echo $res->categoryName ?></p>
                    </div>
                    <div class="rate-section">
                        <div class="rate-color-container">
                            
                        </div>
                        <img src="images/product-assets/rate.png" alt="rate" class="rate-stars-container">
                        <p class="product-number-of-rates">(<?php echo $res->numberOfRates ?>)</p>
                    </div>

                    <div>
                        <p class="normal-text" style="margin-top: 6px"><span class="text-label" style="font-weight: bold;">Price:</span> <span class="text-info-price" id="u-price">$<?php echo $res->unitPrice ?></span> <span class="text-label">+$15.55 shipping</span></p>
                    </div>
                    <div>
                        <p class="normal-text"><span class="text-label" style="font-weight: bold">Color:</span> <?php if(isset($res->color) && $res->color != ""){ echo $res->color;} else {echo "unknown";} ?></p>
                    </div>
                    <div>
                        <p class="normal-text" style="margin-top: 8px; line-height: 1.4">
                            <?php echo $res->productDescription ?>
                        </p>
                    </div>
                </div>
                <div class="cart-section">
                    <div>
                        <p class="text-info-price" id="total-product-qte-price" style="margin: 4px; color: rgb(31, 31, 31)"></p>
                    </div>
                    <div>
                        <p class="normal-text" style="font-weight: bold; font-size: 17px"><span class="text-label">Arrives:</span>  Nov 26 - Dec 14 </p>
                    </div>
                    <div>
                        <p class="in-stock">In Stock.</p>
                    </div>
                    <div>
                        <label for="quantity" style="font-size: 15px">Quantity: </label>
                        <select name="quantity" id="quantity" style="background-color: rgb(240, 240, 240)">
                            <?php 
                                for($i=1;$i<=30;$i++) {
                                    echo "<option value='{$i}'>{$i}</option>";
                                }
                            ?>
                        </select>
                        <a href="" class="edit-button">edit</a>
                        <div style="position: relative">
                            <div id="edit-error">
                                <a href="" id="hide-hint">✕</a>
                                <p style="margin: 3px;">Please change the quantity before click edit button</p>
                            </div>
                        </div>
                    </div>
                    <div style="margin-top: 14px">
                        <div>
                            <a href="#" class="cart-button" id="add-to-crt">Add to Cart</a>
                        </div>
                        <div>
                            <!-- PAYPAL BUY NOW BUTTON -->
                                
                            <form action="https://www.paypal.com/cgi-bin/webscr" method="post" style="display: flex; align-items: center; justify-content: center; margin-top: 12px">
                                    <input type="hidden" name="cmd" value="_xclick">
                                    <input type="hidden" name="business" value="UTMXWJDX6SPRS">
                                    <input type="hidden" name="lc" value="MA">
                                    <input type="hidden" name="item_name" value="Product name">
                                    <input type="hidden" name="item_number" value="productID">
                                    <input type="hidden" name="amount" value="18.00" id="prc">
                                    <input type="hidden" name="currency_code" value="USD">
                                    <input type="hidden" name="button_subtype" value="services">
                                    <input type="hidden" name="no_note" value="1">
                                    <input type="hidden" name="no_shipping" value="1">
                                    <input type="hidden" name="rm" value="1">
                                    <input type="hidden" name="return" value="https://localhost/E-COMMERCE/common/thank_you.php">
                                    <input type="hidden" name="cancel_return" value="https://localhost/E-COMMERCE/vw_cart.php">
                                    <input type="hidden" name="bn" value="PP-BuyNowBF:btn_buynowCC_LG.gif:NonHosted">
                                    <input type="hidden" name="notify_url" value="https://localhost/E-COMMERCE/common/handle_transaction.php">
                                    <input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_buynowCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
                                    <img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
                                    <script>
                                        document.getElementById("prc").value = "19.99";
                                        /* This should be replaced by the sub total value.
                                           Hint: remove the comma thousands separator before pass sub total to price input!
                                        */
                                        /*document.getElementById("prc").value = document.getElementById("st").innerHTML;*/
                                    </script>
                                </form>
                        </div>
                    </div>

                </div>
            </div>
            <img id="image-bck" src="images/zoom-background.png"/>
            <div id="zoomed-image-container">
                <img src="" id="zoomed-image" />
            </div>
        </div>

    </main>
</body>
</html>