<?php
    include "../design-entities/form-input.php";

    $submitted_company_name 
    = $submitted_contact_firstname 
    = $submitted_contact_lastname 
    = $submitted_contact_address1
    = $submitted_contact_address2 
    = $submitted_email
    = $submitted_postal_code
    = $submitted_city = "";

    $error = ["companyErr"=>"", "contact_firstnameErr"=>"", 
    "contact_lastnameErr"=>"", "contact_address1Err"=>"", 
    "contact_address2Err"=>"", "cityErr"=>"", 
    "postal_codeErr"=>"", "emailErr"=>""];
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

            <div class="admin-main-layout" style="display: flex; flex-direction: column">
                <!-- container of title and form for add shipper -->
                <h2 class="main-layout-title" style="">Add Supplier</h2>
                <div>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                        <div style="display: flex">
                            <div>
                                <div style="display: flex">
                                    <div  style="margin-bottom: 6px; margin-left: 2px; color: rgb(19, 184, 55);"><?php /*echo $supplier_created*/ ?></div>
                                </div>
                                <div style="display: flex">
                                    <div  style="margin-bottom: 6px; margin-left: 2px; color: rgb(218, 47, 47);"><?php /*echo $err*/ ?></div>
                                </div>
                                
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
                                <?php generateInputText("contact_address1", "Address 1", $error["contact_address1Err"], "text", "contact_address1", "contact_address1", $submitted_contact_address1); ?>

                                <!--  label_for - labe_content - error - type - name - id - input value  >>>> CONTACT ADDRESS2 <<<<-->
                                <?php generateInputText("contact_address2", "Address 2", $error["contact_address2Err"], "text", "contact_address2", "contact_address2", $submitted_contact_address2); ?>
                            </div>
                            <div style="padding-top: 12px; padding-left: 12px">
                                <!--  label_for - labe_content - error - type - name - id - input value  >>>> COMPANY NAME <<<< -->
                                <?php generateInputText("city", "City", $error["cityErr"], "text", "city", "city", $submitted_city); ?>

                                <!--  label_for - labe_content - error - type - name - id - input value  >>>> CONTACT FIRSTNAME <<<< -->
                                <?php generateInputText("postal_code", "Postal Code", $error["postal_codeErr"], "text", "postal_code", "postal_code", $submitted_postal_code); ?>

                                <!--  label_for - labe_content - error - type - name - id - input value  >>>> CONTACT LASTNAME <<<< -->
                                <?php generateInputText("email", "Email", $error["emailErr"], "text", "email", "email", $submitted_email); ?>

                               
                                
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