<?php

    if(isset($_POST["search"])) {
        // Sanitize data
        $submitted_category = htmlspecialchars(strip_tags($_POST["category"]));
        $submitted_input = htmlspecialchars(strip_tags($_POST["search-field"]));

        header("location: shop.php?category=$submitted_category&search_k=$submitted_input");
    }

?>

<header>
    <input type="hidden" id="isRegistred" value="<?php echo $isRegistred ?>">
    <div id="top-menu-strip">
        <a href="http://localhost/E-COMMERCE/index.php" id="top-logo"><img src="http://localhost/E-COMMERCE/images/logo.png" class="logo"></a>
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
            <div id="account-picture-container">
                <a href="#" class="close-section">✖</a>
                <img id="account-image" src="http://localhost/E-COMMERCE/images/account.png" alt="">
                <a href="#" id="edit-profile-image">▸ Edit profil picture</a>
            </div>
            <a href="#" id="acc-p"><img src="http://localhost/E-COMMERCE/images/account.png" alt="NOT FOUND" id="account-picture"></a>
            <a href="#" class="account-name"><?php if(isset($username)) echo $username; else echo "Unknown"; ?></a>
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
                    <div id="empty-message-box">
                        <div class="line-underneath"></div>
                        <h2 style="width: 100%; text-align: center">YOUR CART IS EMPTY ..</h2>
                        <div class="line-underneath"></div>
                    </div>
                    <div id="cart-products">
                        <input type="hidden" id="products-ids">
                        <div id="c-prds">
                        
                        </div>
                        
                    </div>
                    
                    <div id="remaining-cart-info">
                        <div class="line-underneath"></div>
                        <input type="hidden" id="hidden-sub-total" value="0">
                        <div id="sub-total"><span style="color: rgb(40, 40, 40); font-size: 17px">Subtotal:</span> <span id="sub"></span></div>
                        <div class="line-underneath"></div>
                        <div style="margin-top: 6px">
                            <a href="vw_cart.php" class="cart-button">VIEW CART</a>
                        </div>
                        <div>
                            <a href="#" class="cart-button" style="margin-bottom: 0">CHECKOUT</a>
                        </div>
                    </div>
                </div>
            </ul>
        </nav>
    </div>
    <nav id="top-small-device-nav">
        <ul>
            <a href="index.php" class="menu-button-style white-home"><li id="home">Home</li></a>
            <a href="vw_cart.php" class="menu-button-style white-cart"><li id="home">My Cart</li></a>
            <a href="shop.php" class="menu-button-style white-shop"><li>Shop</li></a>
            <a href="account.php" class="menu-button-style white-account"><li>Account</li></a>
            <a href="about.php" class="menu-button-style white-about"><li>About</li></a>
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

    