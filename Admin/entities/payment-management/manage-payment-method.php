<?php

    include "../design-entities/form-input.php";
    include "PaymentMethodManager.php";
    include "../validation/data-validation.php";

    $submitted_payment_method = $submitted_active = $payment_created = $err = $e_err = "";
    $payment_edited = $submitted_edited_id = $submitted_edited_payment = $submitted_edited_activeness = "";
    $deletedId = "";
    $errors = ["paymentErr"=>"", "activeErr"=>"", "idErr"=>""];
    $e_errors = ["idErr"=>"", "epaymentErr"=>"", "eactiveErr"=>""];
    
    if(isset($_POST["edit-payment-method"])) {
        if(empty($_POST["id"])) {
            $e_errors["idErr"] = "Select a payment method to edit it";
        }else if(empty($_POST["new_payment_method"])) {
            $e_errors["epaymentErr"] = "Payment method required";
        } else if(!isset($_POST["new_payment_active"])) {
            $e_errors["eactiveErr"] = "Payment method activeness required";
        } else {
            $act = (clean($_POST["new_payment_active"]) == "active") ? 1 : 0;
            $payment_manager = new PaymentManager();
            if($payment_manager->editPayment(clean($_POST["id"]), clean($_POST["new_payment_method"]), $act)) {
                $payment_edited = "Payment type edited successfully";
            } else {
                $e_err = "Either id doesn't exists or table is empty";
            }
        }
    }
    
    if(isset($_POST["edit"])) {
        $submitted_edited_id = $_POST["idToEdit"];
        $submitted_edited_payment = $_POST["paymentToEdit"];
        $submitted_edited_activeness = $_POST["allowedToEdit"];
    }

    if(isset($_POST["delete"])) {
        $deletedId = clean($_POST["paymentToDelete"]);
        $payment_manager = new PaymentManager();
        $payment_manager->deletePayment($deletedId);
    }

    if(isset($_POST["add-payment-method"])) {
        $submitted_payment_method = $_POST["payment_method"];
        $submitted_active = $_POST["payment_active"];
        if(empty($submitted_payment_method)) {
            $errors["paymentErr"] = "a payment method is required.";
        }else if(empty($submitted_active)) {
            $errors["activeErr"] = "Activeness of P.M is required.";
        }else {
            $payment_manager = new PaymentManager();

            // Cleaning data
            $submitted_payment_method = clean($submitted_payment_method);
            $submitted_active = clean($submitted_active);
            if($submitted_active == "active") {
                $submitted_active = 1;
            } else
                $submitted_active = 0;


            if($payment_manager->insertPayment($submitted_payment_method, $submitted_active) == 1) {
                $payment_created = "Payment method created successfully.";
            } else {
                $err = "Payment method already exist in our database.";
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
    <title>Add Payment Method</title>
    <link rel="stylesheet" href="../../css/header.css">
    <link rel="stylesheet" href="../../css/admin-pannel.css">
    <link rel="stylesheet" href="../../css/main-layout.css">
    <link rel="stylesheet" href="../../css/form-entities.css">
    <link rel="stylesheet" href="../../css/table-style.css">

    <link rel="icon" href="../../assets/icons/favicon.ico">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="../../js/admin-pannel-dynamics.js" defer></script>
</head>
<body>
    <?php include "../../entities/header.php" ?>
    <main>
        <div class="admin-global-layout">
            <?php include "../../entities/left-pannel.php" ?>

            <div class="admin-main-layout" style="flex-wrap: wrap;">
                <div>
                    <h2 class="main-layout-title">Add Payment Method</h2>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                        <div style="display: flex">
                            <div  style="margin-bottom: 6px; margin-left: 2px; color: rgb(19, 184, 55);"><?php echo $payment_created ?></div>
                        </div>
                        <div style="display: flex">
                            <div  style="margin-bottom: 6px; margin-left: 2px; color: rgb(218, 47, 47);"><?php echo $err ?></div>
                        </div>
                        <!--  label_for - labe_content - error - type - name - id - input value  >>>> PAYMENT METHOD <<<< -->
                        <?php generateInputText(
                                    "payment_method", // label for
                                    "Payment Method", // label text
                                    $errors["paymentErr"], // error associated
                                    "text", // input type
                                    "payment_method", // input name
                                    "payment_method", // input id
                                    $submitted_payment_method // input value
                                ); ?>
                        
                        
                        <div style="display: flex">
                            <label style="font-weight: bold; margin-left: 3px;">Payment type activeness</label>
                            <div class="invalid-credential"><?php echo $errors["activeErr"]; ?></div>
                        </div>
                        <div style="margin: 8px 0px 8px 4px">
                            <label for="active">Active</label>
                            <input type="radio" name="payment_active" value="active" id="active" checked>
                            <label for="inactive">InActive</label>
                            <input type="radio" name="payment_active" value="inactive" id="inactive">
                        </div>

                        <input type="submit" name="add-payment-method" class="styled-button" value="Add payment method">
                    </form>
                </div>
                <div style="margin: 0px 45px">
                    <p>All existing payment methods :</p>
                    <table>
                        <tr>
                            <th>Payment method</th>
                            <th>Activeness</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                        <?php
                            $payment_manager = new PaymentManager();
                            $payment_manager->getPaymentAsTableRows();
                        ?>
                    </table>
                </div>
                <div>
                    <h2 class="main-layout-title">Edit Payment Method</h2>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                        <div style="display: flex">
                            <div  style="margin-bottom: 6px; margin-left: 2px; color: rgb(19, 184, 55);"><?php echo $payment_edited ?></div>
                        </div>
                        <div style="display: flex">
                            <div  style="margin-bottom: 6px; margin-left: 2px; color: rgb(218, 47, 47);"><?php echo $e_err ?></div>
                        </div>
                        
                        <?php generateDisabledInputText(
                                    "edited_id", // label for
                                    "Id", // label text
                                    $e_errors["idErr"], // error associated
                                    "text", // input type
                                    "e_id", // input name
                                    "e_id", // input id
                                    $submitted_edited_id // input value
                                ); ?>
                        <!-- We add this hidden input because disabled inputs don't subbmitted with the rest data (and
                             id is necessary to get the id of the aimed record to edit it
                        ) -->
                        <input type="hidden" name="id" value="<?php echo $submitted_edited_id; ?>">

                        <!--  label_for - labe_content - error - type - name - id - input value  >>>> PAYMENT METHOD <<<< -->
                        <?php generateInputText(
                                    "new_payment_method", // label for
                                    "Payment Method", // label text
                                    $e_errors["epaymentErr"], // error associated
                                    "text", // input type
                                    "new_payment_method", // input name
                                    "new_payment_method", // input id
                                    $submitted_edited_payment // input value
                                ); ?>
                        
                        
                        <div style="display: flex">
                            <label style="font-weight: bold; margin-left: 3px;">Payment type activeness</label>
                            <div class="invalid-credential"><?php echo $errors["activeErr"]; ?></div>
                        </div>
                        <div style="margin: 8px 0px 8px 4px">
                            <label for="active">Active</label>
                            <input type="radio" name="new_payment_active" value="active" id="active" checked>
                            <label for="inactive">InActive</label>
                            <input type="radio" name="new_payment_active" value="inactive" id="inactive" <?php if($submitted_edited_activeness == 0) echo "checked"?>>
                        </div>

                        <input type="submit" name="edit-payment-method" class="styled-button" value="Edit payment method">
                    </form>
                </div>
            </div>
            
        </div>
    </main>
    <script>
        $("#payment-types-management-button").addClass("selected-option");
        $("#add-payment").on("click", function() {
            return false;
        })
    </script>
</body>
</html>