<?php
    include "../design-entities/form-input.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Cache-control" content="no-cache">
    <title>Add Supplier</title>
    <link rel="stylesheet" href="../../css/header.css">
    <link rel="stylesheet" href="../../css/admin-pannel.css">
    <link rel="stylesheet" href="../../css/main-layout.css">
    <link rel="stylesheet" href="../../css/form-entities.css">
    <link rel="stylesheet" href="../../css/suppliers.css">

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
                <!-- container of title and form for add shipper -->
                <div>
                    <h2 class="main-layout-title">Add Supplier</h2>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                        <div style="display: flex">
                            <div>
                                <div style="display: flex">
                                    <div  style="margin-bottom: 6px; margin-left: 2px; color: rgb(19, 184, 55);"><?php /*echo $supplier_created*/ ?></div>
                                </div>
                                <div style="display: flex">
                                    <div  style="margin-bottom: 6px; margin-left: 2px; color: rgb(218, 47, 47);"><?php /*echo $err*/ ?></div>
                                </div>
                                <div style="display: flex">
                                    <label style="font-weight: bold; margin-left: 3px;" for="supplier-name">Company Name</label>
                                    <div class="invalid-credential"><?php /*echo $error["companyErr"];*/ ?></div>
                                </div>
                                <input type="text" name="supplier-name" id="supplier-name" class="styled-form-input" value="<?php /*echo $submitted_company;*/ ?>">

                                <div style="display: flex">
                                    <label style="font-weight: bold; margin-left: 3px;" for="contact-firstname">Contact Firstname</label>
                                    <div class="invalid-credential"><?php /*echo $error["phoneErr"];*/ ?></div>
                                </div>
                                <input type="text" name="contact-firstname" id="contact-firstname" class="styled-form-input" value="<?php /*echo $submitted_phone;*/ ?>">
                                
                                <div style="display: flex">
                                    <label style="font-weight: bold; margin-left: 3px;" for="contact-firstname">Contact Lastname</label>
                                    <div class="invalid-credential"><?php /*echo $error["phoneErr"];*/ ?></div>
                                </div>
                                <input type="text" name="contact-lastname" id="contact-lastname" class="styled-form-input" value="<?php /*echo $submitted_phone;*/ ?>">

                                <div style="display: flex">
                                    <label style="font-weight: bold; margin-left: 3px;" for="contact-title">Contact Title</label>
                                    <div class="invalid-credential"><?php /*echo $error["phoneErr"];*/ ?></div>
                                </div>
                                <input type="text" name="contact-title" id="contact-title" class="styled-form-input" value="<?php /*echo $submitted_phone;*/ ?>">

                                <div style="display: flex">
                                    <label style="font-weight: bold; margin-left: 3px;" for="contact-address1">Address 1</label>
                                    <div class="invalid-credential"><?php /*echo $error["phoneErr"];*/ ?></div>
                                </div>
                                <input type="text" name="address1" id="address1" class="styled-form-input" value="<?php /*echo $submitted_phone;*/ ?>">

                                <div style="display: flex">
                                    <label style="font-weight: bold; margin-left: 3px;" for="contact-address2">Address 2</label>
                                    <div class="invalid-credential"><?php /*echo $error["phoneErr"];*/ ?></div>
                                </div>
                                <input type="text" name="address2" id="address2" class="styled-form-input" value="<?php /*echo $submitted_phone;*/ ?>">
                                    </div>

                                </div>
                            </div>
                            <div>
                                <!-- Here's my beginning point where i realized to create entities in separate files like components -->
                                <?php generateInput("city", "City", "text", "", "city", "city", "TEST VALUE"); ?>
                                
                                <input type="submit" name="add-shipper" class="styled-button" value="Add shipper">                                
                            </div>
                        </div>
                    </form>
                </div>
                <div class="existing-shippers">
                    <p>All existing shippers :</p>
                    <table>
                        <tr>
                            <th>Company name</th>
                            <th>Phone number</th>
                        </tr>
                        <?php
                            /*$sm = new ShipperManager(); 
                            $sm->generateShippersRows();*/
                        ?>
                    </table>
                </div>
            </div>
        </div>
    </main>
    <script>
        $("#add-supplier").addClass("selected-option");
        $("#suppliers-related-items").css("display", "flex");
        $("#add-supplier").on("click", function() {
            return false;
        })
    </script>
</body>
</html>