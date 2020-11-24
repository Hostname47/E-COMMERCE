<?php

    if(isset($_POST["search"])) {
        // Sanitize data
        $submitted_category = htmlspecialchars(strip_tags($_POST["category"]));
        $submitted_input = htmlspecialchars(strip_tags($_POST["search-field"]));

        header("location: shop.php?category=$submitted_category&search_k=$submitted_input");
    }

?>

<header>

    <div id="top-menu-strip">
        <a href="http://localhost/E-COMMERCE/index.php" id="top-logo"><img src="images/logo.png" class="logo"></a>
        <div class="search-container">
            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" class="product-search-form" id="search-form" method="POST">
                <select name="category" class="categories-dropdownlist" value="<?php echo isset($submitted_category) ? $submitted_category : 0 ?>">
                    <!-- normally w got the categories from database but for symplicity we need to fill some options -->
                    <?php include "entities/get-categories.php"?>
                </select>
                <input type="text" name="search-field" class="search-field" id="search-field" placeholder="Search" value="<?php echo isset($_GET["search_k"]) ? $_GET["search_k"] : "" ?>">
                <input type="submit" value="" name="search" class="search-button">
            </form>
        </div>
        <div id="my-account">
            <a href=""><img src="images/account.png" alt="NOT FOUND" id="account-picture"></a>
            <a href="#" id="account-name">My-account</a>
        </div>

        <div id="search-and-menu-container">
            <a href="#" class="mobile-search-top"></a>
            <a href="#" class="menu-top"></a>
        </div>

        <nav id="top-nav">
            <ul>
                <a href="index.php" class="top-menu-btn"><li>Home</li></a>
                <a href="shop.php" id="top-nav-shop" class="top-menu-btn"><li>Shop</li></a>
                <a href="#" class="top-menu-btn"><li>About</li></a>
                <a href="" class="menu-cart-button top-menu-btn"><li>Cart</li></a>
                <div class="cart-container">
                    <div class="close-container">
                        <p class="cart-title">Your Cart</p>
                        <a href="#" id="close-cart-button">✖</a>
                    </div>
                    <div class="arrow_box">
                    </div>
                    <div class="cart-products">
                        <div class="cart-product-item">
                            <div class="img-container">
                                <img src="images/headphone.webp" class="cart-product-image" alt="">
                            </div>
                            <div style="width: 800px;">
                                <p class="cart-product-info">Product name</p>
                                <p class="cart-product-info"><span class="gray-font">qte <span style="font-size: 11px">✖</span></span> <span>price</span></p>
                            </div>
                            <div class="delete-product-container">
                                <a href="#" class="delete-cart-product-button">✖</a>
                            </div>
                        </div>
                    </div>
                    <div class="line-underneath"></div>
                    <div class="cart-products">
                        <div class="cart-product-item">
                            <div class="img-container">
                                <img src="images/headphone.webp" class="cart-product-image" alt="">
                            </div>
                            <div style="width: 800px;">
                                <p class="cart-product-info">Product name</p>
                                <p class="cart-product-info"><span class="gray-font">qte <span style="font-size: 11px">✖</span></span> <span>price</span></p>
                            </div>
                            <div class="delete-product-container">
                                <a href="#" class="delete-cart-product-button">✖</a>
                            </div>
                        </div>
                    </div>
                    <div class="line-underneath"></div>
                    <div class="cart-products">
                        <div class="cart-product-item">
                            <div class="img-container">
                                <img src="images/headphone.webp" class="cart-product-image" alt="">
                            </div>
                            <div style="width: 800px;">
                                <p class="cart-product-info">Product name</p>
                                <p class="cart-product-info"><span class="gray-font">qte <span style="font-size: 11px">✖</span></span> <span>price</span></p>
                            </div>
                            <div class="delete-product-container">
                                <a href="#" class="delete-cart-product-button">✖</a>
                            </div>
                        </div>
                    </div>
                    <div>SubTotal: $37,700.00</div>
                    <div>
                        <a href="#">VIEW CART</a>
                    </div>
                    <div>
                        <a href="#">CHECKOUT</a>
                    </div>
                </div>
            </ul>
        </nav>
    </div>
    <nav id="top-small-device-nav">
        <ul>
            <a href="index.php" class="menu-button-style white-home"><li id="home">Home</li></a>
            <a href="#" class="menu-button-style white-cart"><li id="home">My Cart</li></a>
            <a href="#" class="menu-button-style white-shop"><li>Shop</li></a>
            <a href="#" class="menu-button-style white-account"><li>Account</li></a>
            <a href="#" class="menu-button-style white-about"><li>About</li></a>
        </ul>
    </nav>

    <div class="search-mobile-container">
        <select name="category" class="categories-dropdownlist" id="mobile-category-dropdownlist" form="small-search-form">
            <!-- normally w got the categories from database but for symplicity we need to fill some options -->
                <?php include "entities/get-categories.php" ?>
        </select>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" class="product-search-form" id="small-search-form" method="POST">
            <input type="text" name="search-field" class="search-field" placeholder="Search">
            <input type="submit" value="" name="search" class="search-button">
        </form>
    </div>
</header>

    