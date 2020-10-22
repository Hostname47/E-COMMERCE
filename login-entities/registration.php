<?php

    require "register-validation.php";

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
                    <div class="invalid-credential" style="margin-bottom: 6px; margin-left: 2px"><?php echo $error["generalErr"]; ?></div>
                </div>

                <div style="display: flex">
                <div  style="margin-bottom: 6px; margin-left: 2px; color: rgb(19, 184, 55);"><?php echo $user_created ?></div>
                </div>

                <!-- USERNAME -->
                <div style="display: flex;">
                    <label style="font-weight: bold; margin-left: 3px;" for="reg-username">Username</label>
                    <div class="invalid-credential"><?php echo $error["usernameErr"]; ?></div>
                </div>
                <input type="text" name="reg-username" id="reg-username" class="styled-form-input" value="<?php if(isset($_POST["create"])) { echo $submitted_username;} ?>">

                <!-- EMAIL -->
                <div style="display: flex;">
                    <label style="font-weight: bold; margin-left: 3px;" for="reg-email">Email</label>
                    <div class="invalid-credential"><?php echo $error["emailErr"]; ?></div>
                </div>
                <input type="text" name="reg-email" id="reg-email" class="styled-form-input" value="<?php if(isset($_POST["create"])) { echo $submitted_email;} ?>">

                <!-- PASSWORD -->
                <div style="display: flex;">
                    <label style="font-weight: bold; margin-left: 3px;" for="reg-password">Password</label>
                    <div class="invalid-credential"><?php echo $error["passwordErr"]; ?></div>
                </div>
                <input type="password" placeholder="At least 8 characters" name="reg-password" id="reg-password" class="styled-form-input">
                <p class="password-form-hint">Password must be at least 8 characters.</p>

                <!-- PASSWORD CONFIRMATION -->
                <div style="display: flex;">
                    <label style="font-weight: bold; margin-left: 3px;" for="re-pass">Re-enter password</label>
                    <div class="invalid-credential"><?php echo $error["repasswordErr"]; ?></div>
                </div>
                <input type="password" name="reg-re-password" class="styled-form-input" id="re-pass">

                <!-- CREATE BUTTON -->
                <input type="submit" name="create" id="create-button" value="Create your account" class="styled-button">
            </form>
            <p style="font-size: 14px;">By creating an account, you agree to ECOM-EASY's <a href="#" class="its-a-link">Conditions of Use</a> and <a href="#" class="its-a-link">Privacy Notice</a></p>
        </div>
    </div>
</main>
<!-- Include footer  -->
<?php require "../entities/basic-footer.php"; ?>
</html>