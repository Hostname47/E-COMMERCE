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
    <link rel="stylesheet" href="css/header.css"/>
    <link rel="stylesheet" href="css/login.css"/>
    <link rel="stylesheet" href="css/footer.css"/>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script src="javascript/dynamics.js" defer></script>
</head>
<body>

<main>
<div id="login-container">
    <div id="login-logo-container">
        <a href="#" style="margin: 0 auto"><img src="images/logo.png" alt="logo" class="logo"></a>
    </div>    

    <div id="login">
        <p id="login-title">Create account</p>
        
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" id="registration-form">
            <label for="usr_type" style="font-weight: bold; margin-left: 3px;">User type</label>
            <div id="user-type-container">
                <input type="radio" name="user-type" id="reg-admin-user" style="margin-right: 8px;"><label for="reg-admin-user" style="margin-top: 3px; margin-right: 10px;">Admin</label>
                <input type="radio" name="user-type" id="reg-normal-user" style="margin-right: 8px;" checked><label for="reg-normal-user" style="margin-top: 3px;">Normal User</label>
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

            <label style="font-weight: bold; margin-left: 3px;" for="reg-password">Password</label>
            <input type="password" placeholder="At least 8 characters" name="reg-password" id="reg-password" class="styled-form-input">
            <p class="password-form-hint">Password must be at least 8 characters.</p>
            <label style="font-weight: bold; margin-left: 3px;" for="re-pass">Re-enter password</label>
            <input type="password" name="reg-re-password" class="styled-form-input" id="re-pass">
            <input type="submit" name="create" id="create-button" value="Create your account" class="styled-form-button">
        </form>
        <p style="font-size: 14px;">By creating an account, you agree to ECOM-EASY's <a href="#" class="its-a-link">Conditions of Use</a> and <a href="#" class="its-a-link">Privacy Notice</a></p>
    </div>
</div>
</main>
<!-- Include footer  -->
<?php require "basic-footer.php"; ?>
</html>