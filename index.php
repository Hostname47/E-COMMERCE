<?php
    require "config/DBConnection.php";

    session_start();

    if(!isset($_SESSION["user_id"])) {
        header("location: login-entities/login.php");
    }

    if(isset($_POST["logout"])) {
        unset($_SESSION['user_id']);
        session_destroy();
        header("location: login-entities/login.php");
    }


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Cache-control" content="no-cache">
    <title>Dashboard</title>
    
    <link rel="icon" href="images/favicon.ico">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/featured-product.css">
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/footer.css">

    <style>
        #go-to-ftr {
            transition: all 0.4s ease;
        }
    </style>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js" defer></script>
    <script src="javascript/index.js" defer></script>
    <script src="javascript/header.js" defer></script>
</head>
<body>
    <?php include "entities/header.php"; ?>
    <main>
        <?php include "entities/featured-product.php"; ?>

        <div class="our-services-containers">
            <div class="service-item">
                <img src="images/our-services/priority-shipping.png" alt="not found">
                <p class="service-title">Priority Shipping</p>
                <p class="service-description">Priority Mail is a quick, affordable service that ships domestically within 1-3 business days and internationally within 6-10 business days. </p>
            </div>
            <div class="service-item">
                <img src="images/our-services/fuss.png" alt="not found">
                <p class="service-title">Priority Shipping</p>
                <p class="service-description">Priority Mail is a quick, affordable service that ships domestically within 1-3 business days and internationally within 6-10 business days. </p>
            </div>
            <div class="service-item">
                <img src="images/our-services/in-home.png" alt="not found">
                <p class="service-title">Priority Shipping</p>
                <p class="service-description">Priority Mail is a quick, affordable service that ships domestically within 1-3 business days and internationally within 6-10 business days. </p>
            </div>
        </div>

        <div class="featuring-products">
            <p style="text-align: center; margin: 25px 0 8px 0;">FEATURING</p>
            <h3 style="text-align: center; letter-spacing: 2px">OUR BEST SELLERS</h3>

            <div class="best-seller-global">
                <a href="#" class="b-s-product-previous"></a>
                <div class="best-sellers-container">
                    <div class="best-seller-product">
                        <a href="#" style="margin: 0 auto"><img src="images/iphone.png" alt=""></a>
                        <p class="b-s-product-category">Category: Phones</p>
                        <p class="b-s-product-name">IPhone X</p>
                        <p class="b-s-product-price"><span class="b-s-product-discount">$800</span>$600.00</p>
                        <a href="#" class="b-s-product-add-to-cart">ADD TO CART</a>
                    </div>
                    <div class="best-seller-product">
                        <img src="images/headphone.webp" alt="">
                        <p class="b-s-product-category">Category: Phones</p>
                        <p class="b-s-product-name">IPhone X</p>
                        <p class="b-s-product-price"><span class="b-s-product-discount"></span>$200.00</p>
                        <a href="#" class="b-s-product-add-to-cart">ADD TO CART</a>
                    </div>
                    <div class="best-seller-product">
                        <img src="images/headphone.webp" alt="">
                        <p class="b-s-product-category">Category: Phones</p>
                        <p class="b-s-product-name">IPhone X</p>
                        <p class="b-s-product-price"><span class="b-s-product-discount"></span>$400.00</p>
                        <a href="#" class="b-s-product-add-to-cart">ADD TO CART</a>
                    </div>
                    <div class="best-seller-product">
                        <img src="images/headphone.webp" alt="">
                        <p class="b-s-product-category">Category: Phones</p>
                        <p class="b-s-product-name">IPhone X</p>
                        <p class="b-s-product-price"><span class="b-s-product-discount"></span>$55.00</p>
                        <a href="#" class="b-s-product-add-to-cart">ADD TO CART</a>
                    </div>
                </div>
                <a href="#" class="b-s-product-next"></a>
            </div>    
        </div>

        <div class="news-letter-container">
            <img src="images/newsletter.png" alt="" id="news-image">
            <p class="news-letter-title">SUBSCRIBE TO OUR NEWSLETTER</p>
            <p class="news-letter-desc">Join our subscribers list to get the latest news, updates and special offers directly in your box.</p>
            <form action="#" method="POST" class="newsletter-container">
                <input type="text" name="user-news-subscribe-email" id="user_news_subscribe_email" placeholder="Enter your email">
                <input type="submit" name="user-subscribe-button" value="Subscribe" id="user-subscribe-button">
            </form>
            <p class="news_thank">Thnank you ! you have been subscribed.</p>
        </div>

        <!--<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <input type="submit" name="logout" id="logout" value="logout">
        </form>-->
    <?php include "entities/footer.php"; ?>
</body>
</html>