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

    $product_manager = new ProductManager();

    if(isset($_GET["id"])) {
        // Fill-in the data of the selected item into fields

        $pr = $product_manager->getProductById($_GET['id']);

        $submitted_product_name = $pr["productName"];
        $submitted_desc = $pr["productDescription"];
        $submitted_sku = $pr["SKU"];
        $submitted_supplier = $pr["supplierID"];
        $submitted_category = $pr["categoryID"];
        $submitted_unit_price = $pr["unitPrice"];
        $submitted_available_sizes = $pr["availableSizes"];
        $submitted_available_colors = $pr["availableColors"];
        $submitted_size = $pr["size"];
        $submitted_color = $pr["color"];
        $submitted_discount = $pr["discount"];
        $submitted_unit_weight = $pr["unitWeight"];
        $submitted_units_in_stock = $pr["UnitsInStock"];
        $submitted_units_on_order = $pr["UnitsOnOrder"];
        $submitted_product_available = $pr["productAvailable"];
        $submitted_keywords = $pr["keywords"];
        $submitted_id = $_GET["id"];
    }



    if(isset($_POST["edit-product"])) {
        $submitted_id = $_POST["edited-id"];
        if(!isset($submitted_id)) {
            $err = "you should go back and select the product to edit it";
        } else {
            require "API/validateEdit.php";
            if (isset($ok)){
                $productPicture = $submitted_product_name . "/" . $_FILES["product_picture"]["name"];
    
                $old = $product_manager->getProductById($submitted_id);
                $old_product_directory_name = $target_dir . $old["productName"];
                $new_product_directory_name = $target_dir . $submitted_product_name;
                // delete the older image
                //rename($old_product_directory_name, $new_product_directory_name);

                if(file_exists($old_product_directory_name)) {
                    emptyDir($old_product_directory_name);
                    rmdir($old_product_directory_name);
                }
                
                mkdir($new_product_directory_name);
    
                if (move_uploaded_file($_FILES["product_picture"]["tmp_name"], $target_file)) {
                    $product_manager->editProduct($_POST["edited-id"], $submitted_product_name, $submitted_sku, $submitted_desc, $submitted_supplier, 
                    $submitted_category, $submitted_available_sizes, $submitted_available_colors, $submitted_size, $submitted_color,
                    $submitted_unit_price, $submitted_discount, $submitted_unit_weight, $submitted_units_in_stock, $submitted_units_on_order,
                    $submitted_product_available, $submitted_keywords, $productPicture);
                    
                    $product_created = "Product edited successfully";
                }
            }
        }
    }

    function emptyDir($dir) {
        if (is_dir($dir)) {
            $scn = scandir($dir);
            foreach ($scn as $files) {
                if ($files !== '.') {
                    if ($files !== '..') {
                        if (!is_dir($dir . '/' . $files)) {
                            unlink($dir . '/' . $files);
                        } else {
                            emptyDir($dir . '/' . $files);
                            rmdir($dir . '/' . $files);
                        }
                    }
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
    <title>Edit product</title>
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
                <h2 class="main-layout-title" style="">Edit Product: <?php echo $submitted_product_name; ?></h2>
                <div>
                    <?php include "API/product-data-fields.php" ?>
                    <input type="hidden" name="edited-id" value="<?php echo $submitted_id; ?>" form="product-data-field">
                    <input type="submit" name="edit-product" class="styled-button" value="Edit Product" form="product-data-field">
                </div>
            </div>
        </div>
    </main>
    <script>
        $("#edit-product").addClass("selected-option");
        $("#product-related-items").css("display", "flex");
        $("#edit-product").on("click", function() {
            return false;
        })
    </script>
</body>
</html>