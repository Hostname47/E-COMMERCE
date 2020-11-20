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
            <div class="left-side-panel">
                <?php
                    $categories = include "api/category/read.php";

                    echo $categories;
                ?>
            </div>
            <div class="master-section">

            </div>
        </div>
    </main>
</body>
</html>