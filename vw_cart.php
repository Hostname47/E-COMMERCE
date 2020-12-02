
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
    <script src="javascript/cookie.js" defer></script>
    <script src="javascript/header.js" defer></script>
    <script src="javascript/cart.js" defer></script>
    <script src="javascript/product.js" defer></script>
    
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
                        <div id="products-in-cart">
                            <input type="hidden" value="0" id="total-qte">
                            <input type="hidden" value="0" id="total-price">
                            <h1 class="shopping-cart-title empty-cart">YOUR CART IS EMPTY</h1>
                        </div>
                    </div>
                    <div class="sub-and-checkout-container">
                        <div class="sub-total-and-checkout">
                            <div>
                                <p class="cart-sub">Subtotal (<span class="number-of-items"></span> items): <span class="cart-prd-price sb-total" id="st"><span></p>
                                <a href="#" id="cart-checkout-button">Proceed to checkout</a>
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
            </div>
        </div>
    <?php include "entities/footer.php" ?>
</body>
</html>
