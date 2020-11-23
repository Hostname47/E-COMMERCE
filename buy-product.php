<?php

    $product_id = $_GET["id"];

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

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js" defer></script>
    <script src="javascript/header.js" defer></script>
    <script src="javascript/shop.js" defer></script>
    <script src="javascript/product.js" defer></script>
</head>
<body>
    <?php include "entities/header.php"; ?>

    <main>
        <div class="simple-strip-container">
            <a href="index.php" class="simple-menu-button" id="all-button">All</a>
            <a href="index.php" class="simple-menu-button">Home</a>
            <a href="shop.php" class="simple-menu-button">Shop</a>
            <a href="index.php" class="simple-menu-button">About</a>
            <a href="index.php" class="simple-menu-button">Home</a>
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
                        <img src="images/bvlgary.png" alt="" class="product-image-info">
                    </div>
                    <div class="product-asset-container">
                        <img src="images/headphone.webp" alt="" class="product-image-info">
                    </div>
                    <div class="product-asset-container">
                        <img src="images/bvlgary.png" alt="" class="product-image-info">
                    </div>
                    <div class="product-asset-container">
                        <video class="product-video-asset" controls>
                            <source src="movie.mp4" type="video/mp4" class="product-video-asset">
                            <source src="movie.ogg" type="video/ogg" class="product-video-asset">
                            Your browser does not support the video tag.
                        </video>
                    </div>
                </div>
                <div class="asset-demo">
                    <img src="images/bvlgary.png" id="image-demo" alt="">
                </div>
                <div class="text-infos">
                    <p class="text-info-name">BVLGARY - Octo Finissimo Skeleton In Rose Gold With Strap</p>
                    <div class="flex-center">
                        <p class="normal-text" style="margin-right: 10px; font-size: 15px">by <a href="" class="text-info-author">Mouad Nassri</a></p>
                        <p class="normal-text"><span class="text-label">Category:</span> Watches</p>
                    </div>
                    <div class="rate-section">
                        <div class="rate-color-container">
                            
                        </div>
                        <img src="images/product-assets/rate.png" alt="rate" class="rate-stars-container">
                        <p class="product-number-of-rates">(32)</p>
                    </div>

                    <div>
                        <p class="normal-text" style="margin-top: 6px"><span class="text-label" style="font-weight: bold;">Price:</span> <span class="text-info-price">$37,700.00</span> <span class="text-label">+$15.55 shipping</span></p>
                    </div>
                    <div>
                        <p class="normal-text"><span class="text-label" style="font-weight: bold">Color:</span> Gold</p>
                    </div>
                    <div>
                        <p class="normal-text" style="margin-top: 8px; line-height: 1.4">
                        Born to exude understated everyday elegance, the Octo Roma watch is a unique expression of discreet luxury. Focusing on essentials with undeniable style, the timepiece is highly contemporary for the linearity of its contours and its measured aesthetics, offering a soft interpretation of the round and squared shapes. With its unparalleled combination of striking aesthetics and pioneering mechanics, the watch perfectly encapsulates the modern spirit of Octo.
                        Octo Roma watch with mechanical manufacture movement, automatic winding, date window, 41 mm stainless steel case, 18 kt rose gold octagon, blue dial, 18 kt rose gold crown set with ceramic, blue alligator bracelet and stainless steel folding buckle. Water resistant up to 50 metres.
                        </p>
                    </div>
                </div>
                <div class="cart-section">
                    <div>
                        <p class="text-info-price" style="margin: 4px; color: rgb(31, 31, 31)">$37,700.00</p>
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
                    </div>
                    <div style="margin-top: 14px">
                        <div>
                            <a href="#" class="buy-product-button" id="add-to-cart">Add to Cart</a>
                        </div>
                        <div>
                            <a href="#" class="buy-product-button" id="buy-now">Buy Now</a>
                        </div>
                    </div>

                </div>

            </div>
        </div>

    </main>
</body>
</html>