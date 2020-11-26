
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Cache-control" content="no-cache">
    <title>Your Cart</title>
    
    <link rel="icon" href="images/favicon.ico">
    
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/global-styles.css">
    <link rel="stylesheet" href="css/product-style.css">
    <link rel="stylesheet" href="css/shop.css">
    <link rel="stylesheet" href="css/cart.css">
    <link rel="stylesheet" href="css/footer.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js" defer></script>
    <script src="javascript/header.js" defer></script>
    <script src="javascript/shop.js" defer></script>
    <script src="javascript/product.js" defer></script>
    <script src="javascript/cart.js" defer></script>
    
</head>
<body>
    <?php include "entities/header.php"; ?>
    
    <main>
    <div class="simple-strip-container">
            <a href="index.php" class="simple-menu-button" id="all-button">All</a>
            <a href="index.php" class="simple-menu-button">Home</a>
            <a href="shop.php" class="simple-menu-button">Today's Deals</a>
            <a href="vw_cart.php" class="simple-menu-button" id="cart-button">Cart</a>
            <a href="index.php" class="simple-menu-button">About</a>
        </div>
        <div class="global-container">
            <div class="master-section">
                <div class="shopping-cart-container">
                    <div class="cart-products-box">
                        <div class="cart-title-and-price-container">
                            <p class="shopping-cart-title">Shopping Cart</9>
                            <p class="shopping-cart-label">Price</p>
                        </div>
                        <div class="line-underneath" style="margin-bottom: 10px"></div>
                        <div class="products-in-cart">
                            <div class="cart-product-item">
                                <div class="cart-product-img-container">
                                    <a href="#"><img src="http://localhost/E-COMMERCE/images/unnamed1.jpg" alt=""></a>
                                </div>
                                <div class="cart-prd-infos-section">
                                    <p class="cart-prd-name">Octo Finissimo Skeleton In Rose Gold With Strap - <span class="normal-p" style="color: rgb(60, 60, 60)">by Mouad Nassri</span></p>
                                    <p class="bold-p cart-prd-category">Video Game</p>
                                    <p class="stock-state">In Stock</p>
                                    <div style="display: flex; align-items: center; margin-top: 5px">
                                        <select name="quantity" id="card-prd-quantity" style="background-color: rgb(240, 240, 240)">
                                            <?php 
                                                for($i=1;$i<=30;$i++) {
                                                    echo "<option value='{$i}'>{$i}</option>";
                                                }
                                            ?>
                                        </select>
                                        <a href="#" id="edit-qte">edit</a>
                                    </div>
                                </div>
                                <div class="price-section">
                                    <p class="cart-prd-price">$37,500.00</p>
                                </div>
                            </div>
                            <div class="line-underneath" style="margin-bottom: 10px"></div>
                            <div class="cart-product-item">
                                <div class="cart-product-img-container">
                                    <a href="#"><img src="http://localhost/E-COMMERCE/images/unnamed1.jpg" alt=""></a>
                                </div>
                                <div class="cart-prd-infos-section">
                                    <p class="cart-prd-name">Octo Finissimo Skeleton In Rose Gold With Strap - <span class="normal-p">by Mouad Nassri</span></p>
                                    <p class="bold-p cart-prd-category">Video Game</p>
                                    <p class="stock-state">In Stock</p>
                                    <div style="display: flex; align-items: center; margin-top: 5px">
                                        <select name="quantity" id="card-prd-quantity" style="background-color: rgb(240, 240, 240)">
                                            <?php 
                                                for($i=1;$i<=30;$i++) {
                                                    echo "<option value='{$i}'>{$i}</option>";
                                                }
                                            ?>
                                        </select>
                                        <a href="#" id="edit-qte">edit</a>
                                    </div>
                                </div>
                                <div class="price-section">
                                    <p class="cart-prd-price">$37,500.00</p>
                                </div>
                            </div>
                            <div class="line-underneath" style="margin-bottom: 10px"></div>
                            <div class="cart-product-item">
                                <div class="cart-product-img-container">
                                    <a href="#"><img src="http://localhost/E-COMMERCE/images/unnamed1.jpg" alt=""></a>
                                </div>
                                <div class="cart-prd-infos-section">
                                    <p class="cart-prd-name">Octo Finissimo Skeleton In Rose Gold With Strap - <span class="normal-p">by Mouad Nassri</span></p>
                                    <p class="bold-p cart-prd-category">Video Game</p>
                                    <p class="stock-state">In Stock</p>
                                    <div style="display: flex; align-items: center; margin-top: 5px">
                                        <select name="quantity" id="card-prd-quantity" style="background-color: rgb(240, 240, 240)">
                                            <?php 
                                                for($i=1;$i<=30;$i++) {
                                                    echo "<option value='{$i}'>{$i}</option>";
                                                }
                                            ?>
                                        </select>
                                        <a href="#" id="edit-qte">edit</a>
                                    </div>
                                </div>
                                <div class="price-section">
                                    <p class="cart-prd-price">$37,500.00</p>
                                </div>
                            </div>
                            <div class="line-underneath" style="margin-bottom: 10px"></div>
                            <div style="display: flex">
                                <p class="cart-sub">Subtotal (<span>39</span> items): <span class="cart-prd-price">$4,238.65<span></p>
                            </div>
                        </div>
                    </div>
                    <div class="sub-and-checkout-container">
                        <div class="sub-total-and-checkout">
                            <div>
                                <p class="cart-sub">Subtotal (<span>39</span> items): <span class="cart-prd-price">$4,238.65<span></p>
                                <a href="#" id="cart-checkout-button">Proceed to checkout</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php include "entities/footer.php" ?>
</body>
</html>