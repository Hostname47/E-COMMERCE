<?php

   include "SupplierManager.php";

   $message = $err = "";
   $edit_id = $edited_cat_name = $edited_cat_desc = $edited_cat_active = $edited_picture = $cat_edited = $c_err = "";
   $error = ["catnameErr"=>"", "descErr"=>"", "pictureErr"=>"", "activeErr"=>""];

   $supplier_manager = new SupplierManager();


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Cache-control" content="no-cache">
    <title>Add Category</title>
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
</head>
<body>
    <?php include "../../entities/header.php" ?>
    <main>
        <div class="admin-global-layout">
            <?php include "../../entities/left-pannel.php" ?>

            <div class="admin-main-layout">
                <div>
                    <div style="padding: 12px; width: 100%">
                        <h2 class="main-layout-title">Manage Suppliers</h2>
                        <div>
                            <div class="available">
                                <p>Available suppliers <span style="opacity: 0.6; color: gray;">-----</span></p>
                                <div class="suppliers-container">
                                    <div class="supplier-item">
                                        
                                    </div>
                                </div>
                            </div>
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