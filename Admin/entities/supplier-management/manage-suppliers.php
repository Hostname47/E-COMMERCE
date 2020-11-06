<?php

    include "SupplierManager.php";
    include "../design-entities/form-input.php";
    include "../validation/data-validation.php";

    $supplier_manager = new SupplierManager();

    $submitted_company_name 
    = $submitted_contact_firstname 
    = $submitted_contact_lastname 
    = $submitted_contact_address1
    = $submitted_contact_address2 
    = $submitted_email
    = $submitted_postal_code
    = $submitted_type_goods
    = $submitted_payment_method
    = $submitted_discount_available
    = $submited_logo
    = $supplier_edited
    = $err
    = $submitted_id
    = $submitted_city = "";

   $error = ["companyErr"=>"", "contact_firstnameErr"=>"", 
   "contact_lastnameErr"=>"", "contact_address1Err"=>"", 
   "contact_address2Err"=>"", "cityErr"=>"", 
   "postal_codeErr"=>"", "emailErr"=>"",
   "type_goodsErr"=>"", "payment_methodErr"=>"",
   "discount_availableErr"=>"", "logoErr" =>""];

   if(isset($_POST["edit-supplier"])) {

    $submitted_company_name = clean($_POST["company_name"]);
    $submitted_contact_firstname = clean($_POST["contact_firstname"]);
    $submitted_contact_lastname = clean($_POST["contact_lastname"]);
    $submitted_contact_address1 = clean($_POST["contact_address1"]);
    $submitted_contact_address2 = clean($_POST["contact_address2"]);
    $submitted_city = clean($_POST["city"]);
    $submitted_postal_code = clean($_POST["postal_code"]);
    $submitted_email = clean($_POST["email"]);
    $submitted_payment_method = clean($_POST["payment_method"]);
    $submitted_type_goods = clean($_POST["type_goods"]);
    $submitted_discount_available = clean($_POST["discount_available"]);
    $submitted_id = clean($_POST["id_sup"]);
    $submited_logo = $_FILES["logo"]["name"];

    echo $submitted_id;

    if(empty($_POST["company_name"])) {
        $err = "company name is required";
        $error["companyErr"] = "*";
    }
    else if(!validName($_POST["company_name"])) {
        $err = "Company name should be at least 2 chars and accept only (a to z, A to Z, numbers and underscores";
    }
    
    else if(empty($_POST["contact_firstname"])) {
        $err = "contact firstname is required";
        $error["contact_firstnameErr"] = "*";
    }
    else if(!validName($_POST["contact_firstname"])) {
        $err = "firstname should be at least 2 chars and accept only (a to z, A to Z, numbers and underscores";
    }


    else if(empty($_POST["contact_lastname"])) {
        $err = "contact lastname is required";
        $error["contact_lastnameErr"] = "*";
    }else if(!validName($_POST["contact_lastname"])) {
        $err = "Contact lastname should be at least 2 chars and accept only (a to z, A to Z, numbers and underscores";
    } 
    
    else if(empty($_POST["contact_address1"])) {
        $err = "contact address is required";
        $error["contact_address1Err"] = "*";
    }
    else if(strlen($_POST["contact_address1"]) > 800) {
        $error["contact_address1Err"] = "*";
        $err = "Address is too long";

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
            
            $check = $supplier_manager->editSupplier($submitted_id, $submitted_company_name, $submitted_contact_firstname, $submitted_contact_lastname,
            $submitted_contact_address1, $submitted_contact_address2, $submitted_city,$submitted_postal_code, 
            $submitted_email, $submitted_payment_method, $submitted_type_goods, $submitted_discount_available, $lg);
            $supplier_edited = "Supplier created successfully";

            if($check == -3) {
                $err = "Refresh your selection";
            }
            if($check == -4) {
                $err = "Email already exists";
            }

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
                        $supplier_manager->editSupplier($submitted_id, $submitted_company_name, $submitted_contact_firstname, $submitted_contact_lastname,
                        $submitted_contact_address1, $submitted_contact_address2, $submitted_city,$submitted_postal_code, 
                        $submitted_email, $submitted_payment_method, $submitted_type_goods, $submitted_discount_available, $name);
                        $supplier_edited = "Supplier edited successfully";
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
    <title>Manage Suppliers</title>
    <link rel="stylesheet" href="../../css/header.css">
    <link rel="stylesheet" href="../../css/admin-pannel.css">
    <link rel="stylesheet" href="../../css/main-layout.css">
    <link rel="stylesheet" href="../../css/form-entities.css">
    <link rel="stylesheet" href="../../css/table-style.css">
    <link rel="stylesheet" href="../../css/suppliers.css">

    <style>
        td {
            padding: 2px 5px;
            text-align: center;
        }
        table input {
            margin: 0 auto;
        }
    </style>

    <link rel="icon" href="../../assets/icons/favicon.ico">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="../../js/admin-pannel-dynamics.js" defer></script>
    <script src="../../js/supplier.js" defer></script>

</head>
<body>
    <?php include "../../entities/header.php" ?>
    <main>
        <div class="admin-global-layout">
            <?php include "../../entities/left-pannel.php" ?>

            <div class="admin-main-layout">
                <div>
                    <div style="padding: 12px; box-sizing: border-box">
                        <h2 class="main-layout-title">Manage Suppliers</h2>
                        <div>
                            <div class="available">
                                <div style="display: flex; justify-content: space-between; margin-bottom: 8px">
                                    <p style="margin: 0;">Available suppliers</p>
                                    <a href="#" id="refresh" class="supplier-info-button" onclick="refresh(); return false;">Refresh</a>
                                </div>
                                <div class="suppliers-container" id="supps-block">
                                    <?php  
                                        $supplier_manager->generateSuppliers();
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div id="supplier-infos">
                            <a href="" id="close-supplier-infos" onclick="return false;">✖</a>
                            <div class="supplier-item" id="selected" style="margin: 0 auto; width: 380px">

                            </div>
                        </div>

                        <div>
                            <h2 class="main-layout-title" id="edit-section">Edit Suppliers</h2>
                            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" enctype="multipart/form-data">
                                <div style="display: flex; flex-wrap: wrap">
                                    <div style="padding-right: 25px">
                                        <div style="display: flex">
                                            <div  style="margin-bottom: 6px; margin-left: 2px; color: rgb(19, 184, 55); width: 300px"><?php echo $supplier_edited ?></div>
                                        </div>
                                        <div style="display: flex">
                                            <div  style="margin-bottom: 6px; margin-left: 2px; color: rgb(218, 47, 47); width: 300px"><?php echo $err ?></div>
                                        </div>

                                        <input type="hidden" name="id_sup" id="id_sup">
                                        <!--  label_for - labe_content - error - type - name - id - input value  >>>> COMPANY NAME <<<< -->
                                        <?php generateInputText(
                                            "company_name", // label for
                                            "Company Name", // label text
                                            $error["companyErr"], // error associated
                                            "text", // input type
                                            "company_name", // label for
                                            "company_name", // label for
                                            $submitted_company_name //
                                        ); ?>

                                        <!--  label_for - labe_content - error - type - name - id - input value  >>>> CONTACT FIRSTNAME <<<< -->
                                        <?php generateInputText("contact_firstname", "Contact Firstname", $error["contact_firstnameErr"], "text", "contact_firstname", "contact_firstname", $submitted_contact_firstname); ?>

                                        <!--  label_for - labe_content - error - type - name - id - input value  >>>> CONTACT LASTNAME <<<< -->
                                        <?php generateInputText("contact_lastname", "Contact Lastname", $error["contact_lastnameErr"], "text", "contact_lastname", "contact_lastname", $submitted_contact_lastname); ?>

                                        <!--  label_for - labe_content - error - type - name - id - input value  >>>> CONTACT ADDRESS1 <<<<-->
                                        <?php generateTextArea("contact_address1", "Address 1", $error["contact_address1Err"],"contact_address1", "contact_address1", $submitted_contact_address1) ?>

                                        <!--  label_for - labe_content - error - type - name - id - input value  >>>> CONTACT ADDRESS1 <<<<-->
                                        <?php generateTextArea("contact_address2", "Address 2", $error["contact_address2Err"], "contact_address2", "contact_address2", $submitted_contact_address2) ?>

                                        <!--  label_for - labe_content - error - type - name - id - input value  >>>> COMPANY NAME <<<< -->
                                        <?php generateInputText("city", "City", $error["cityErr"], "text", "city", "city", $submitted_city); ?>

                                        <!-- ////////////////// SUBMIT ////////////////// -->
                                        <input type="submit" name="edit-supplier" class="styled-button" value="Edit supplier">
                                    </div>
                                    <div style="padding-top: 12px; padding-right: 12px">
                                        <!--  label_for - labe_content - error - type - name - id - input value  >>>> CONTACT FIRSTNAME <<<< -->
                                        <?php generateInputText("postal_code", "Postal Code", $error["postal_codeErr"], "text", "postal_code", "postal_code", $submitted_postal_code); ?>

                                        <!--  label_for - labe_content - error - type - name - id - input value  >>>> CONTACT LASTNAME <<<< -->
                                        <?php generateInputText("email", "Email", $error["emailErr"], "text", "email", "email", $submitted_email); ?>

                                        <!-- PAYMENT METHOD DROPDOWN LIST GENERATED BY SupplierManager function -->
                                    <?php 
                                            $supplier_manager = new SupplierManager();
                                            $supplier_manager->generatePaymentMethods($error["payment_methodErr"]);
                                    ?>

                                        <!--  label_for - labe_content - error - type - name - id - input value  >>>> CONTACT LASTNAME <<<< -->
                                        <?php generateInputText("type_goods", "Type Goods", $error["type_goodsErr"], "text", "type_goods", "type_goods", $submitted_type_goods); ?>
                                        
                                        <div style="display: flex">
                                            <label style="font-weight: bold; margin-left: 3px;" for="discount_available">Discount available</label>
                                            <div class="invalid-credential"><?php echo $error["discount_availableErr"] ?></div>
                                        </div>
                                        <select name="discount_available" id="discount_available" class="form-dropDown">
                                            <option value="1">Yes</option>
                                            <option value="0">No</option>
                                        </select>

                                        <div style="display: flex">
                                            <label style="font-weight: bold; margin-left: 3px;" for="logo">Logo</label>
                                            <div class="invalid-credential"><?php echo $error["logoErr"] ?></div>
                                            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" enctype="multipart/form-data" style="display: flex; align-items: center;">
                                                <label style="margin-left: 8px; " for="logo">select companies logo</label>
                                                <select name="logos" id="logos" class="form-dropDown" style="width: 80px; padding: 0">
                                                    <?php
                                                        $supplier_manager = new SupplierManager();
                                                        $supplier_manager->generateLogos();
                                                    ?>
                                                </select>
                                            </form>
                                        </div>
                                        <input type="file" name="logo" id="logo" class="styled-form-input">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script>
        $("#manage-supplier").addClass("selected-option");
        $("#suppliers-related-items").css("display", "flex");
        $("#manage-supplier").on("click", function() {
            return false;
        })
    </script>
</body>
</html>