<?php

    if(isset($_POST["add-product"])) {



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
        else if(!validName($submitted_product_name)) {
            $err = "Product name should be at least 2 chars and accept only (Alphanumerics chars and underscores)";
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
        else if(strlen($submitted_desc) > 800) {
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

        else if(empty($submitted_unit_price)) {
            $err = "unit price is required";
            $error["product_unit_priceErr"] = "*";
        }
        else if(!valideDecimal($submitted_unit_price)) {
            $err = "Invalid unit price format";
        } 

        else if(strlen($_POST["contact_address2"]) > 800) {
            $error["contact_address2Err"] = "*";
            $err = "Address is too long";
        }
        else if(empty($_POST["city"])) {
            $err = "city is required";
            $error["cityErr"] = "*";
        }
        else if(!valideCity($_POST["city"])) {
            $err = "Invalid city name";
        } 

        else if(empty($_POST["postal_code"])) {
            $err = "postal code is required";
            $error["postal_codeErr"] = "*";
        } else if(!validePostalCode($_POST["postal_code"])) {
            $err = "Invalid postal code";
        }

        else if(empty($_POST["email"])) {
            $err = "email is required";
            $error["emailErr"] = "*";
        } else if(!valideEmail($_POST["email"])) {
            $err = "Invalid email format";
        } else if(empty($_POST["payment_method"])){
            $err = "payment method is required";
            $error["payment_mathodErr"] = "*";
        } 
        
        else if(empty($_POST["type_goods"])) {
            $err = "type goods is required";
            $error["type_goodsErr"] = "*";
        } else if(!preg_match("/^[\sa-zA-Z0-9_'-]+$/", $_POST["type_goods"])) {
            $err = "Invalid type goods name";
        } else if((!isset($_FILES['logo']) || $_FILES['logo']['error'] == UPLOAD_ERR_NO_FILE) && $_POST["logos"] == 0) {
            $err = "picture is required.";
            $error["logoErr"] = "*";
        } 
        else {
            if($_POST["logos"] != 0) {
                $supplier_manager = new SupplierManager();
                $lg = $supplier_manager->getLogoById($_POST["logos"])['logo'];
                
                if(!$supplier_manager->emailExists($submitted_email)) {
                    $supplier_manager->addSupplier($submitted_company_name, $submitted_contact_firstname, $submitted_contact_lastname,
                    $submitted_contact_address1, $submitted_contact_address2, $submitted_city,$submitted_postal_code, 
                    $submitted_email, $submitted_payment_method, $submitted_type_goods, $submitted_discount_available, $lg);
                    $supplier_created = "Supplier created successfully";
                }
                else
                    $err = "email already exists";
            } else {
                /* picture check */
                $name = $_FILES["logo"]["name"];
                $target_dir = "../../assets/images/Suppliers/";
                $target_file = $target_dir . basename($_FILES["logo"]["name"]);
                $uploadOk = 1;
                $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
                
                // Check if image file is a actual image or fake image
                $check = getimagesize($_FILES["logo"]["tmp_name"]);
                if($check == false) {
                    $error["logoErr"] = "*";
                    $err = "logo is not an image";
                } // Check log existance
                else if (file_exists($target_file)) {
                    $err = "Sorry, this logo is already exists.";
                } // check size
                else if($_FILES["logo"]["size"] > 500000) {
                    $err = "Sorry, your logo size is too large.";
                }
                // Allow certain file formats
                else if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                    && $imageFileType != "gif" ) {
                    $err = "Sorry, only JPG, JPEG, PNG & GIF logo are allowed.";
                } else {
                    if (move_uploaded_file($_FILES["logo"]["tmp_name"], $target_file)) {
                        $supplier_manager = new SupplierManager();
                        if(!$supplier_manager->emailExists($submitted_email)) {
                            $supplier_manager->addSupplier($submitted_company_name, $submitted_contact_firstname, $submitted_contact_lastname,
                            $submitted_contact_address1, $submitted_contact_address2, $submitted_city,$submitted_postal_code, 
                            $submitted_email, $submitted_payment_method, $submitted_type_goods, $submitted_discount_available, $name);
                            $supplier_created = "Supplier created successfully";
                        }
                        else
                            $err = "email already exists";

                    } else {
                        $err = "Sorry, there was an error uploading your logo.";
                    }
                }
            }
        }
    }

?>