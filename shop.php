<?php
 	
    //Report all errors except warnings.
    error_reporting(E_ALL ^ E_WARNING);
    
    include_once "config/DB.php";
    include_once "modules/product.php";

    $database = new Database();
    $db = $database->connect();
    $productManager = new Product($db);

    if(isset($_POST["min-max-go"])) {
        // Sanitize data
        $minmaxgo_min = htmlspecialchars(strip_tags($_POST["min"]));
        $minmaxgo_max = htmlspecialchars(strip_tags($_POST["max"]));

        if(!empty($_GET["search_k"])) {
            $prod_name = isset($_GET["search_k"]) ? htmlspecialchars(strip_tags($_GET["search_k"])) : "";
        } else {
            $prod_name = isset($_POST["search-field"]) ? htmlspecialchars(strip_tags($_POST["search-field"])) : "";
        }
        
        $prod_category = isset($_GET["category"]) ? htmlspecialchars(strip_tags($_GET["category"])) : 0;

        header("location: shop.php?catgeory=$prod_category&search_k=$prod_name&price_min=$minmaxgo_min&price_max=$minmaxgo_max");
    } 

    function listProducts() {

        $database = new Database();
        $db = $database->connect();
        $productManager = new Product($db);
        // Informations neccessary to list products
        if(!empty($_GET["search_k"])) {
            $prod_name = isset($_GET["search_k"]) ? htmlspecialchars(strip_tags($_GET["search_k"])) : "";
        } else {
            $prod_name = isset($_POST["search-field"]) ? htmlspecialchars(strip_tags($_POST["search-field"])) : "";
        }
        /* Here when the min or max is not set we put empty string because in the check function we check by 
            using empty function
        */

        if(isset($_POST["min-max-go"])) {
            $prod_price_min = isset($_POST["min"]) ? htmlspecialchars(strip_tags($_POST["min"])) : "";
            $prod_price_max = isset($_POST["max"]) ? htmlspecialchars(strip_tags($_POST["max"])) : "";
        } else {
            $prod_price_min = isset($_GET["price_min"]) ? htmlspecialchars(strip_tags($_GET["price_min"])) : "";
            $prod_price_max = isset($_GET["price_max"]) ? htmlspecialchars(strip_tags($_GET["price_max"])) : "";
        }

        $prod_category = isset($_GET["category"]) ? htmlspecialchars(strip_tags($_GET["category"])) : 0;

        return $productManager->readFilteredProducts($prod_name, $prod_category, $prod_price_min, $prod_price_max);
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
        <div class="search-strip-after-header">
            <p class="search-result-text">1-16 of over <span id="row-count"></span> results for "<?php echo isset($prod_name) ? $prod_name : "" ?>"</p>
            <div>
                <label for="sorting" class="search-top-strip-label">Sorted by: </label>
                <select name="sorting" id="sorting">
                    <option value="">Price: Low to High</option>
                    <option value="">Price: High to Low</option>
                    <option value="">Avg. Customer Review</option>
                    <option value="">Newest Arrivals</option>
                </select>    
            </div>
        </div>
        <div class="global-container">
            <?php include "entities/shop-left-panel.php" ?>
            <div class="master-section">
                <?php
                    if(isset($_GET["category"]) && $_GET["category"] != 0) {
                        include "../../config/DB.php";
                        include "../../modules/category.php";
                        $res = include "api/category/read_single.php";
                        $res = json_decode($res);
                        echo "<h1 class='shop-res-title'>{$res->data[0]->name}</h1>";
                        echo "<p class='shop-res-phrase'>This is category phrase will be fetched from db and will be shown here !</p>";
                    }else {
                        // DSIPLAY A BANNER OR CATEGORIES GROUP OR SOMETHING in case category is ALL
                    }
                ?>
                
                <div class="products-container">
                    <?php 
                        $row_count = listProducts();
                    ?>
                    <input type="hidden" id="hidden-row-count" value="<?php echo $row_count ?>">
                </div>
                <input type="hidden" id="id-to-delete">

                <div class="semi-black-section-infos" id="product-selected-to-buy">
                    <a href="" class="close-semi-black-section-info" id="close-product-infos-section" onclick="return false;">✖</a>
                    <div class="product-item" id="selected">
                        <img src="images/bvlgary.png" class="selected-product-picture" alt="">
                        <div>
                            <p>Product name: BVLGARY</p>
                            <p>Product name: BVLGARY</p>
                            <p>Product name: BVLGARY</p>
                            <p>Product name: BVLGARY</p>
                            <p>Product name: BVLGARY</p>
                            <p>Product name: BVLGARY</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php include "entities/footer.php" ?>
</body>
</html>