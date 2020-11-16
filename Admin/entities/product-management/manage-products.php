<?php
    include "../design-entities/form-input.php";
    include "ProductManager.php";
    include "../validation/data-validation.php";

    $submitted_filter_category = 0;
    $submitted_search_field  = $submitted_filter_min = $submitted_filter_max = "";

    if(isset($_POST["product-search"])) {
        $submitted_search_field = clean($_POST["search-field"]);
        $submitted_filter_category = clean($_POST["category"]);
        $submitted_filter_min = clean($_POST["low-price"]);
        $submitted_filter_max = clean($_POST["high-price"]);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Cache-control" content="no-cache">
    <title>Manage product</title>
    <link rel="stylesheet" href="../../css/header.css">
    <link rel="stylesheet" href="../../css/admin-pannel.css">
    <link rel="stylesheet" href="../../css/main-layout.css">
    <link rel="stylesheet" href="../../css/form-entities.css">
    <link rel="stylesheet" href="../../css/products.css">

    <link rel="icon" href="../../assets/icons/favicon.ico">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="../../js/admin-pannel-dynamics.js" defer></script>
    <script src="../../js/product.js" defer></script>
</head>
<body>
    <?php include "../../entities/header.php" ?>
    <main>
        <div class="admin-global-layout">
            <?php include "../../entities/left-pannel.php" ?>

            <div class="admin-main-layout">
                <div>
                    <div class="flex-row">
                        <h2 class="main-layout-title">Products Management</h2>
                        <div class="currency-container">
                            <div style="display: flex">
                                <label style="font-weight: bold; margin-left: 3px; font-size: 14px" for="currency">Currency</label>
                                <div class="invalid-credential"><?php //echo $error["currency"]; ?></div>
                            </div>
                            <select name="currency" id="currency">
                                <option value="dollar">$usd</option>
                                <option value="dollar">€euro</option>
                                <option value="dollar">£pound</option>
                                <option value="dollar">MAD</option>
                            </select>
                        </div>
                    </div>
                </div>
                <!-- search and filters container -->
                <div>
                    <div style="display: flex width: 300px; flex-wrap: no-wrap">
                        <p class="para basic-label">● Search for a product</p>
                        <p class="para">Notice: allowed chars: a-z, A-Z, 0-9 -,[](), no apostrophes</p>
                    </div>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" class="flex-row" id="search-form">
                        <input type="text" name="search-field" placeholder="Search .." class="search-field" id="search-field" value="<?php echo $submitted_search_field; ?>">
                        <input type="submit" value="search" name="product-search" class="search-button">
                    </form>
                    
                    <div class="flex-row" style="margin: 14px 0">
                        <div class="category-filter flex-row">
                            <p class="para basic-label">Category</p>
                            <?php
                                include "../design-entities/common-functions.php";
                                $comm = new CommonFunctionProvider();
                                $comm->getCategoriesAsDropDownList("basic-dropdownlist", $submitted_filter_category, "search-form");
                            ?>
                        </div>

                        <div class="flex-row" style="margin-left: 12px">
                            <p class="para basic-label">Price</p>
                            <div class="flex-row">
                                <input type="text" name="low-price" placeholder="min" class="text-field min-max" form="search-form" value="<?php echo $submitted_filter_min; ?>">
                                <input type="text" name="high-price" placeholder="max" class="text-field min-max" form="search-form" value="<?php echo $submitted_filter_max; ?>">
                            </div>
                        </div>
                    </div>
                    
                    <!-- PRODUCT SECTION -->
                    <div>
                        <h3 class="result-title" id="res-title">Result: </h3>
                        <div id="products-container">
                            <?php
                                // Show products depends on search and filters - if search is empty all product will be shown
                                $product_manager = new ProductManager();
                                $product_manager->getFilteredProducts($submitted_search_field, $submitted_filter_category, $submitted_filter_min, $submitted_filter_max);
                                
                            ?>
                        </div>
                    </div>
                </div>

                <!-- Id of the selected item to delete -->
                <input type="hidden" id="id-to-delete">

                <div class="semi-black-section-infos" id="product-selected-to-manage">
                    <a href="" class="close-semi-black-section-info" id="close-product-infos-section" onclick="return false;">✖</a>
                    <div class="product-item" id="selected" style="margin: 0 auto; width: 80%">

                    </div>
                </div>

                <div class="semi-black-section-infos" id="product-selected-to-delete">
                    <a href="" class="close-semi-black-section-info" id="close-product-delete-section" onclick="return false;">✖</a>
                    <div class="product-item" id="selected" style="margin: 0 auto; width: 80%">
                        <h4 style="margin: 10px">Are you sure you want to delte this product ?</h4>
                        <p style="margin: 0; padding: 4px 4px 10px 12px;" id="delete-result"></p>
                        <div style="margin: 0 auto; padding: 25px 0">
                            <a href="" class="styled-button" id="sure">I'm sure</a>
                            <a href="" class="styled-button" id="not-sure">No</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script>
        $("#manage-product").addClass("selected-option");
        $("#product-related-items").css("display", "flex");
        $("#manage-product").on("click", function() {
            return false;
        })
    </script>
</body>
</html>