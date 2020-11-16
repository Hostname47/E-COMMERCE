<?php
    include "../design-entities/form-input.php";
    include "ProductManager.php";
    include "../validation/data-validation.php";

    $submitted_product_name
    = $submitted_sku 
    = $submitted_desc
    = $submitted_available_sizes
    = $submitted_available_colors
    = $submitted_size
    = $submitted_color
    = $submitted_picture
    = $submitted_keywords
    = $product_created
    = $err = "";

    $submitted_unit_price = $submitted_discount = $submitted_unit_weight = "0.00";
    $submitted_units_in_stock = $submitted_units_on_order = $submitted_product_available = $submitted_supplier = $submitted_category = "0";

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
        if(isset($ok)) {
            if(file_exists($productFolder)) {
                $err = "Sorry, Product already exists with this name";
                $error["product_pictureErr"] = "*";
            }
            else { 
                $productPicture = $submitted_product_name . "/" . $_FILES["product_picture"]["name"];
                mkdir($productFolder);

                if (move_uploaded_file($_FILES["product_picture"]["tmp_name"], $target_file)) {
                    $product_manager->addProduct($submitted_product_name, $submitted_sku, $submitted_desc, $submitted_supplier, 
                    $submitted_category, $submitted_available_sizes, $submitted_available_colors, $submitted_size, $submitted_color,
                    $submitted_unit_price, $submitted_discount, $submitted_unit_weight, $submitted_units_in_stock, $submitted_units_on_order,
                    $submitted_product_available, $submitted_keywords, $productPicture);
                    
                    $product_created = "Product created successfully";
                }
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Cache-control" content="no-cache">
    <title>Add product</title>
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

            <div class="admin-main-layout" style="display: flex; flex-direction: column">
                <!-- container of title and form for add shipper -->
                <h2 class="main-layout-title" style="">Add Product</h2>
                <div>
                    <?php include "API/product-data-fields.php" ?>
                    <!-- ////////////////// SUBMIT ////////////////// -->
                    <input type="submit" name="add-product" class="styled-button" value="Add Product" form="product-data-field">
                </div>
            </div>
        </div>
    </main>
    <script>
        $("#add-product").addClass("selected-option");
        $("#product-related-items").css("display", "flex");
        $("#add-product").on("click", function() {
            return false;
        })
    </script>
</body>
</html>