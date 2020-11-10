<?php
    include "../design-entities/form-input.php";
    include "ProductManager.php";
    include "../validation/data-validation.php";

    $submitted_product_name
    = $submitted_sku 
    = $submitted_desc
    = $submitted_supplier
    = $submitted_category
    = $submitted_available_sizes
    = $submitted_available_colors
    = $submitted_size
    = $submitted_color
    = $submitted_picture
    = $submitted_keywords
    = $product_created
    = $err = "";

    $submitted_unit_price = $submitted_discount = $submitted_unit_weight = "0.00";
    $submitted_units_in_stock = $submitted_units_on_order = $submitted_product_available = "0";

    $error = ["skuErr"=>"", "product_nameErr"=>"", 
    "product_descErr"=>"", "product_supplierErr"=>"",
    "product_categoryErr"=>"", "product_unit_priceErr"=>"",
    "product_av_sizesErr"=>"", "product_av_colorsErr"=>"", 
    "product_sizeErr"=>"", "product_colorErr"=>"",
    "product_discountErr"=>"", "product_unit_weightErr"=>"",
    "product_units_in_stockErr"=>"", "product_units_on_orderErr" =>"",
    "product_availabilityErr"=>"", "product_pictureErr"=>"",
    "product_keywordsErr"=>""];

    if(isset($_POST["add-product"])) {
        include "API/validateData.php";
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

            <div class="admin-main-layout" style="flex-direction: column; background-color: yellow">
                <div style="background-color: gray">
                    <h2 class="main-layout-title" style="">Products Management</h2>
                </div>
                <div style="background-color: gray">
                    <div style="display: flex; margin-left: auto">
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