<?php

    session_start();
    
    require "check-credentials.php";

    $submitted_password = $sibmitted_repass = "";
    $error = $updated = "";

    if(isset($_POST["change-pass"])) {
        $submitted_password = cleanData($_POST["change-password"]);
        $submitted_repass = cleanData($_POST["change-repass"]);
    
        if(empty($submitted_password) || empty($submitted_repass)) {
            $error = "* all fields are required";
        } else {
            if(strlen($submitted_password) > 300) {
                $error = "* Password is too long";
            }else if(strlen($submitted_password) > 300) {
                $error = "* Confirmation password is too long";
            }
        }

        if($error === "") {
            if($submitted_password == $submitted_repass) {
                // Chnage passowrd
                require "../config/dbConnect.php";

                try {
                    $stmt = $conn->prepare("UPDATE user_info SET password = :pass WHERE user_id = :id");
                    $stmt->bindParam(":pass", $submitted_password);
                    $stmt->bindParam(":id", $_SESSION["u_id"]);
                    $stmt->execute();

                    $updated = "Password updated successfully";
                } catch(PDOException $ex) {
                    echo $ex->getMessage();
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
    <title>EASY-ECOM Registration</title>

    <link href="https://fonts.googleapis.com/css2?family=Karla&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/login.css"/>
    <link rel="stylesheet" href="../css/footer.css"/>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

</head>
<body>
<main>
    <div id="login-container">
        <div id="login-logo-container">
            <a href="#" style="margin: 0 auto"><img src="../images/logo.png" alt="logo" class="logo"></a>
        </div>    

        <div id="login">
            <div style="display: flex;">
                <p id="login-title">Create account</p>
                <a href="login.php" style="margin-left: auto; margin-top: 8px; text-decoration: none; color: rgb(31, 128, 255);"><- login</a>
            </div>
            
            
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" id="registration-form">

                <div style="display: flex">
                    <div class="invalid-credential" style="margin-bottom: 6px; margin-left: 2px"><?php echo $error; ?></div>
                </div>

                <div style="display: flex">
                    <div  style="margin-bottom: 6px; margin-left: 2px; color: rgb(19, 184, 55);"><?php echo $updated; ?></div>
                </div>

                <!-- NEW PASSWORD -->
                <div style="display: flex;">
                    <label style="font-weight: bold; margin-left: 3px;" for="change-password">New Password</label>
                    <div class="invalid-credential"><?php  ?></div>
                </div>
                <input type="password" placeholder="At least 8 characters" name="change-password" id="change-password" class="styled-form-input">
                <p class="password-form-hint">Password must be at least 8 characters.</p>

                <!-- PASSWORD CONFIRMATION -->
                <div style="display: flex;">
                    <label style="font-weight: bold; margin-left: 3px;" for="change-repass">Re-enter password</label>
                    <div class="invalid-credential"><?php ?></div>
                </div>
                <input type="password" name="change-repass" class="styled-form-input" id="change-repass">

                <!-- CREATE BUTTON -->
                <input type="submit" name="change-pass" id="change-pass" value="Confirm" class="styled-button">
            </form>
        </div>
    </div>
</main>
<!-- Include footer  -->
<?php require "../entities/basic-footer.php"; ?>
<style>
    #basic-footer {
        position: absolute;
        bottom: 0;
        right: 0;
        left: 0;
    }
</style>
</html>