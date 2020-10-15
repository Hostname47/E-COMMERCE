<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link href="https://fonts.googleapis.com/css2?family=Karla&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/header.css"/>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script src="javascript/dynamics.js" defer></script>
</head>
<body>
    <header>
        <div class="top-strip">
            <h3>Time will show who's the hardest worker in the room .. MOUAD NASSRI</h3>
            <div class="follow-me">
                <a href="#" id="fb-icon" class="s-m-icon"></a>
                <a href="#" id="reddit-icon" class="s-m-icon"></a>
                <a href="#" id="li-icon" class="s-m-icon"></a>
            </div>
        </div>
        
        <div id="top-menu-strip">
            <a href="#" id="top-logo"><img src="images/logo.png" class="logo"></a>
            <div id="search-container">
                <form action="" id="product-search-form">
                    <select name="container-dropdownlist" id="categories-dropdownlist">
                        <!-- normally w got the categories from database but for symplicity we need to fill some options -->
                        <option value="All" selected>All</option>
                        <option value="arts-and-crafts">Arts & Crafts</option>
                        <option value="computers">Computers</option>
                        <option value="electronics">Electronics</option>
                    </select>
                    <input type="text" name="search-field" id="search-field" placeholder="Search">
                    <input type="submit" value="" name="search" id="search-button">
                </form>
            </div>
            <div id="my-account">
                <a href=""><img src="images/mine.png" alt="" id="account-picture"></a>
                <a href="#" id="account-name">My-account</a>
            </div>

            <nav id="top-nav">
                <ul>
                    <a href="#"><li>Home</li></a>
                    <a href="#"><li>Products</li></a>
                    <a href="#"><li>About</li></a>
                    <a href="#"><li>Account</li></a>
                    <a href="#" id="menu-cart-button"><li>Cart</li></a>
                </ul>
            </nav>
        </div>
    </header>
    <main>
        <section id="featured-product">
            <h1 style="margin: 0; text-align: center; padding-top: 50px; color: white; font-size: 50px">WELCOME BROTHER</h1>
            <p style="text-align: center; color: white; padding: 0px 200px 0px 200px;">Don’t try to plan everything out to the very last detail. I’m a big believer in just getting it out there: create a minimal viable product or website, launch it, and get feedback. ~Neil Patel</p>
        </section>
    </main>
</body>
</html>