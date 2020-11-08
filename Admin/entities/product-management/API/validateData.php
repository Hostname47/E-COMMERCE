<?php

    if(isset($_POST["add-product"])) {

        $product_manager = new ProductManager();

        $submitted_product_name = clean($_POST["product_name"]);
        $submitted_sku = clean($_POST["product_sku"]);
        $submitted_desc = clean($_POST["product_desc"]);
        $submitted_supplier = clean($_POST["suppliers"]);
        $submitted_category = clean($_POST["category"]);
        $submitted_unit_price = clean($_POST["product_unit_price"]);
        $submitted_available_sizes = clean($_POST["product_av_sizes"]);
        $submitted_available_colors = clean($_POST["product_av_colors"]);
        $submitted_size = clean($_POST["product_size"]);
        $submitted_color = clean($_POST["product_color"]);
        $submitted_discount = clean($_POST["product_discount"]);
        $submitted_unit_weight = clean($_POST["product_unit_weight"]);
        $submitted_units_in_stock = clean($_POST["product_units_in_stock"]);
        $submitted_units_on_order = clean($_POST["product_units_on_order"]);
        $submitted_product_available = clean($_POST["product_available"]);
        $submitted_keywords = clean($_POST["product_keywords"]);
        $submitted_picture = $_FILES["product_picture"]["name"];

        if(empty($submitted_product_name)) {
            $err = "Product name is required";
            $error["product_nameErr"] = "*";
        }
        else if(!preg_match("/^[a-zA-Z0-9-_'`,&\+()\[\]\s]*$/", $submitted_product_name)) {
            $err = "Product name invalid format";
            $error["product_nameErr"] = "*";
        } 
        else if($product_manager->productNameExists($submitted_product_name)) {
            $err = "Product name already exists ! try another one";
        }

        else if(empty($submitted_sku)) {
            $err = "SKU is required";
            $error["skuErr"] = "*";
        }
        else if(!validName($submitted_sku)) {
            $err = "SKU should be at least 2 chars and accept only (Alphanumerics chars and underscores)";
        }

        else if(empty($submitted_desc)) {
            $err = "Description is required";
            $error["product_descErr"] = "*";
        }
        else if(strlen($submitted_desc) > 2000) {
            $error["product_descErr"] = "*";
            $err = "Address is too long";
        }

        else if(empty($submitted_supplier)) {
            $err = "supplier is required";
            $error["product_supplierErr"] = "*";
        }

        else if(empty($submitted_category)) {
            $err = "category is required";
            $error["product_categoryErr"] = "*";
        }

        else if(!valideDecimal($submitted_unit_price)) {
            $err = "Invalid unit price format";
            $error["product_unit_priceErr"] = "*";
        } 
        else if(empty($submitted_unit_price)) {
            $err = "unit price is required";
            $error["product_unit_priceErr"] = "*";
        }

        else if(strlen($submitted_available_sizes) > 300) {
            $err = "Available sizes is too long";
            $error["product_av_sizesErr"] = "*";
        } 

        else if(strlen($submitted_available_colors) > 300) {
            $err = "Available colors is too long";
            $error["product_av_colorsErr"] = "*";
        }

        else if(!preg_match("/^[a-zA-Z0-9,-_&]*$/", $submitted_size)) {
            $err = "Invalid size format";
            $error["product_sizeErr"] = "*";
        }

        else if(empty($submitted_color)) {
            $err = "Color is required";
            $error["product_colorErr"] = "*";
        }
        else if(!validName($submitted_color)) {
            $err = "Invalid color format";
            $error["product_colorErr"] = "*";
        }

        else if(!valideDecimal($submitted_discount)) {
            $err = "Invalid discount format";
            $error["product_discountErr"] = "*";
        } 
        else if(empty($submitted_discount)) {
            $err = "discount is required";
            $error["product_discountErr"] = "*";
        }
        
        else if(!valideDecimal($submitted_unit_weight)) {
            $err = "Invalid unit weight format";
            $error["product_unit_weightErr"] = "*";
        } 
        else if(empty($submitted_unit_weight)) {
            $err = "Unit weight is required";
            $error["product_unit_weightErr"] = "*";
        }

        else if(!preg_match("/^[0-9]{0,15}$/", $submitted_units_in_stock)) {
            $err = "Invalid unit in stock format";
            $error["product_units_in_stockErr"] = "*";
        } 
        else if($submitted_units_in_stock == "") {
            $err = "Units in stock is required";
            $error["product_units_in_stockErr"] = "*";
        }

        else if(!preg_match("/^[0-9]{0,15}$/", $submitted_units_on_order)) {
            $err = "Invalid unit on order format";
            $error["product_units_on_orderErr"] = "*";
        } 
        else if($submitted_units_on_order == "") {
            $err = "Units on order is required";
            $error["product_units_on_orderErr"] = "*";
        }

        else if(!preg_match("/^[0-9]{0,15}$/", $submitted_product_available)) {
            $err = "Invalid products available format";
            $error["product_availabilityErr"] = "*";
        } 
        else if($submitted_product_available == "") {
            $err = "products available is required";
            $error["product_availabilityErr"] = "*";
        }

        else if(empty($submitted_keywords)) {
            $err = "At least on keyword is required";
            $error["product_keywordsErr"] = "*";
        }
        else if(strlen($submitted_keywords) > 1200) {
            $error["product_keywordsErr"] = "*";
            $err = "Keywords field is too long";
        }
        else if($_FILES['product_picture']["name"] == "") {
            $error["product_pictureErr"] = "*";
            $err = "picture is required";
        }
        else {

            $name = $_FILES["product_picture"]["name"];
            $target_dir = "../../Products/";
            $target_file = $target_dir . $submitted_product_name . "/" . basename($_FILES["product_picture"]["name"]);
            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
            
            // Check if image file is a actual image or fake image
            $check = getimagesize($_FILES["product_picture"]["tmp_name"]);

            // Allow certain file formats
            if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                && $imageFileType != "gif" ) {
                $err = "Sorry, only JPG, JPEG, PNG & GIF pictures are allowed.";
            }
            else if($_FILES["product_picture"]["size"] > 500000) {
                $err = "Sorry, your logo size is too large.";
            }
            else {
                $productFolder = $target_dir . basename($submitted_product_name);
                if(file_exists($productFolder)) {
                    $err = "Sorry, Product already exists with this name";
                    $error["product_pictureErr"] = "*";
                }
                else {
                    $productPicture = $submitted_product_name . "/" . basename($_FILES["product_picture"]["name"]);

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

    }

?>