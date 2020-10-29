<?php
    include "shipper.php";
    $submitted_company = $submitted_phone = $user_created = $err = "";
    $error = ["companyErr"=>"", "phoneErr"=>""];
    
    if(isset($_POST["add-shipper"])) {
        $submitted_company = $_POST["company-name"];
        $submitted_phone = $_POST["phone-number"];

        
        if(empty($submitted_company)) {
            $error["companyErr"] = "a company name is required.";
        }else if(empty($submitted_phone)) {
            $error["phoneErr"] = "phone number is required.";
        }else {
            $shipper_manager = new ShipperManager();

            // Cleaning data
            $submitted_company = $shipper_manager->cleanData($submitted_company);
            $submitted_phone = $shipper_manager->cleanData($submitted_phone);

            if($shipper_manager->insertShipper($submitted_company, $submitted_phone) == 1) {
                $user_created = "Shipper created successfully.";
            } else {
                $err = "Credentials already exist in our database.";
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
    <title>Add Shipper</title>
    <link rel="stylesheet" href="../../css/header.css">
    <link rel="stylesheet" href="../../css/admin-pannel.css">
    <link rel="stylesheet" href="../../css/main-layout.css">
    <link rel="stylesheet" href="../../css/form-entities.css">
    <link rel="stylesheet" href="../../css/shippers.css">

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
                    <h2 class="main-layout-title">Add Shipper</h2>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                        <div style="display: flex">
                            <div  style="margin-bottom: 6px; margin-left: 2px; color: rgb(19, 184, 55);"><?php echo $user_created ?></div>
                        </div>
                        <div style="display: flex">
                            <div  style="margin-bottom: 6px; margin-left: 2px; color: rgb(218, 47, 47);"><?php echo $err ?></div>
                        </div>
                        <div style="display: flex">
                            <label style="font-weight: bold; margin-left: 3px;" for="company-name">Company name</label>
                            <div class="invalid-credential"><?php echo $error["companyErr"]; ?></div>
                        </div>
                        <input type="text" name="company-name" id="copany-name" class="styled-form-input" value="<?php echo $submitted_company; ?>">

                        <div style="display: flex">
                            <label style="font-weight: bold; margin-left: 3px;" for="phone-number">Phone number</label>
                            <div class="invalid-credential"><?php echo $error["phoneErr"]; ?></div>
                        </div>
                        <input type="text" name="phone-number" id="phone-number" class="styled-form-input" value="<?php echo $submitted_phone; ?>">

                        <input type="submit" name="add-shipper" class="styled-button" value="Add shipper">
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
                            $sm = new ShipperManager(); 
                            $sm->generateShippersRows();
                        ?>
                    </table>
                </div>
            </div>
        </div>
    </main>
    <script>
        $(".add-item").addClass("selected-option");
        $("#shippers-related-items").css("display", "flex");
        $("#add-shipper").on("click", function() {
            return false;
        })
    </script>
</body>
</html>