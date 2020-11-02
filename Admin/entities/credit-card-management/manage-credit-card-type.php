
<?php
    include "CreditcardManager.php";
    $submitted_c_c_type = $err = $c_c_type_created = $c_c_type_edited = $err = $e_err = "";

    if(!isset($editedid)) {
        $editedid = "";
    }
    if(!isset($editedcctype)) {
        $editedcctype = "";
    }

    if(isset($_POST["edit"])) {
        // This is the id of item that you want to edit
        $c_c_type_manager = new CreditcardManager();
        $editedid = $c_c_type_manager->cleanData($_POST["editedId"]);
        $editedcctype = "---> " . $c_c_type_manager->cleanData($_POST["editedName"]) . " <---";
    }

    if(isset($_POST["delete"])) {
        // This is the id of item that you want to delete
        $c_c_type_manager = new CreditcardManager();
        $id = $c_c_type_manager->cleanData($_POST["deletedId"]);
        $c_c_type_manager->deleteCreditCard($id);
    }

    /* code for inserting validated credit card type data*/
    if(isset($_POST["add-c-c-type"])) {
        $c_c_type_manager = new CreditcardManager();

        $submitted_c_c_type = $_POST["c_c_type"];

        // Cleaning data
        $submitted_c_c_type = $c_c_type_manager->cleanData($submitted_c_c_type);

        if(!isset($_POST["c_c_type"]) || empty($_POST["c_c_type"])) {
            $err = "A credit card name is required.";
        }else if($c_c_type_manager->checkCreditCardTypeExistence($submitted_c_c_type)) {
            $err = "This credit card name is already exists.";
        }else {
            $c_c_type_manager->insertCreditCardType($submitted_c_c_type);
            $c_c_type_created = "Credit card type created successfully";
            $submitted_c_c_type = "";
        }
    }

    if(isset($_POST["edit-c-c-type"])) {
        if(empty($_POST["e-id"])) {
            $e_err = "Select one of the credit card types to edit it";
        }else if(!isset($_POST["e_c_c_type"]) || empty($_POST["e_c_c_type"])) {
            $e_err = "Please enter the new name of the selected credit card type.";
        } else {
            $c_c_type_manager = new CreditcardManager();
            $id = $c_c_type_manager->cleanData($_POST["e-id"]);
            $new_name = $c_c_type_manager->cleanData($_POST["e_c_c_type"]);

            if($c_c_type_manager->editCreditCardType($id, $new_name) > 0) {
                $c_c_type_edited = "Credit card type edited successfully";
            } else
                $e_err = "There's a problem.";
            
        }
    }
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
    <link rel="stylesheet" href="../../css/credit-card-type.css">
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

            <div class="admin-main-layout">
            <div style="width: 350px">
                <div id="add-c-c-type-container">
                    <h2 class="main-layout-title">Add Credit Card Type</h2>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                        <div style="display: flex">
                            <div  style="margin-bottom: 6px; margin-left: 2px; color: rgb(19, 184, 55);"><?php echo $c_c_type_created; ?></div>
                        </div>
                        <div style="display: flex">
                            <div  style="margin-bottom: 6px; margin-left: 2px; color: rgb(218, 47, 47);"><?php echo $err ?></div>
                        </div>
                        <div style="display: flex">
                            <label style="font-weight: bold; margin-left: 3px;" for="c_c_type">Credit card type</label>
                        </div>
                        <input type="text" name="c_c_type" id="c_c_type" class="styled-form-input" value="<?php echo $submitted_c_c_type; ?>">

                        <input type="submit" name="add-c-c-type" class="styled-button" value="Add credit card type">
                    </form>
                </div>
                <div id="edit-c-c-type-container">
                        <h2 class="main-layout-title">Edit Credit Card Type</h2>
                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                            <div style="display: flex">
                                <div  style="margin-bottom: 6px; margin-left: 2px; color: rgb(19, 184, 55);"><?php echo $c_c_type_edited; ?></div>
                            </div>
                            <div style="display: flex">
                                <div  style="margin-bottom: 6px; margin-left: 2px; color: rgb(218, 47, 47);"><?php echo $e_err ?></div>
                            </div>
                            <div style="display: flex">
                                <label style="font-weight: bold; margin-left: 3px;" for="c_c_type">ID</label>
                            </div>
                            <input type="text" name="e_c_c_id" id="e_c_c_id" class="styled-form-input" value="<?php echo $editedid;?>" disabled>
                            <input type="hidden" name="e-id" value="<?php echo $editedid; ?>">
                            <div style="display: flex">
                                <label style="font-weight: bold; margin-left: 3px;" for="c_c_type">New Credit Card Type Name</label>
                            </div>
                            <input type="text" name="e_c_c_type" id="e_c_c_type" class="styled-form-input" value="<?php echo $editedcctype;?>">

                            <input type="submit" name="edit-c-c-type" class="styled-button" value="Edit credit card type">
                        </form>
                    </div>
                </div>

                <div id="available-c-c-types-container">
                    <p>Available Credit card types : </p>
                    <div class="c-c-t-container">
                        <table>
                            <tr>
                                <th>ID</th>
                                <th>Credit card type</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                            <?php
                                $c_c_type_Manager = new CreditcardManager();
                                $c_c_type_Manager->getCreditCardTypesAsComponents();
                            ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script>
        $("#credit-card-management-button").addClass("selected-option");
        $("#credit-card-management-button").on("click", function() {
            return false;
        })
    </script>
</body>
</html>