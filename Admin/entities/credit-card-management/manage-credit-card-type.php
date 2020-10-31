
<?php
    
    include "CreditcardManager.php";
    $submitted_c_c_type = $err = $c_c_type_created = "";

    /* code for inserting validated category data*/
    if(isset($_POST["add-c-c-type"])) {
        $c_c_type_manager = new CreditcardManager();

        $submitted_c_c_type = $_POST["c_c_type"];

        // Cleaning data
        $submitted_c_c_type = $c_c_type_manager->cleanData($submitted_c_c_type);

        if(!isset($_POST["c_c_type"]) || empty($_POST["c_c_type"])) {
            $err = "A category name is required.";
        }else if($c_c_type_manager->checkCreditCardTypeExistence($submitted_c_c_type)) {
            $err = "This category name is already exists.";
        }else {
            $c_c_type_manager->insertCreditCardType($submitted_c_c_type);
            $c_c_type_created = "Category created successfully";
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
                <div id="add-cat-container">
                    <h2 class="main-layout-title">Add Credit Card Type</h2>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" enctype="multipart/form-data">
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
        $("#add-category").on("click", function() {
            return false;
        })
    </script>
</body>
</html>