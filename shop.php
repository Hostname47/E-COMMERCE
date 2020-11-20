<?php
 	
    //Report all errors except warnings.
    error_reporting(E_ALL ^ E_WARNING);

    $submitted_search_keywords = "";
    if(isset($_GET["search_k"])) {
        $submitted_search_keywords = htmlspecialchars(strip_tags($_GET["search_k"]));
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
    <link rel="stylesheet" href="css/shop.css">
    <link rel="stylesheet" href="css/global-styles.css">
    <link rel="stylesheet" href="css/product-style.css">
    <link rel="stylesheet" href="css/footer.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js" defer></script>
    <script src="javascript/header.js" defer></script>
    <script src="javascript/product.js" defer></script>
</head>
<body>
    <?php include "entities/header.php"; ?>
    
    <main>
        <div class="search-strip-after-header">
            <p class="search-result-text">1-16 of over 1,000 results for "<?php echo $submitted_search_keywords ?>"</p>
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
                    /* Rather than using includes inside the api file and getting relative-absolute path problem, 
                    I prefer to include files here instead and avoid the problem (temporarly at least)
                    */
                    include_once "config/DB.php";
                    include_once "modules/category.php";

                    $result = include "api/category/read.php";
                    $result = json_decode($result);

                    foreach($result->data as $dt) {
                        echo $dt->name;
                    }

                ?>

                <div>
                    <p class="left-pannel-section-title">Department</p>
                    <div class="departments-container">
                        <a href="#" class="container-item-link">Video games</a>
                        <a href="#" class="container-item-link">TV & Shows</a>
                        <div class="sub-container-item-links">
                            <a href="#" class="container-item-link">TV shows</a>
                            <a href="#" class="container-item-link">TV</a>
                            <a href="#" class="container-item-link">Movies & films</a>
                        </div>
                        <a href="#" class="container-item-link">Replacement Upright Vacuum Bags</a>
                    </div>
                </div>
            </div>
        </div>
        <div style="height: 400px">

        </div>
    </main>
</body>
</html>