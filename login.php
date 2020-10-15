<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link href="https://fonts.googleapis.com/css2?family=Karla&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/header.css"/>
    <link rel="stylesheet" href="css/footer.css"/>
    <link rel="stylesheet" href="css/register.css"/>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script src="javascript/dynamics.js" defer></script>
</head>
<body>
<?php require "header.php" ?>

<main>
<div id="login-container">
    <div id="reg-logo-container">
        <a href="#" style="margin: 0 auto"><img src="images/logo.png" alt="logo" class="logo"></a>
    </div>    

    <div id="login">
        <p id="login-title">Login</p>
        
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" id="registration-form">
            <label style="font-weight: bold; margin-left: 3px;" for="email-or-phone">Email or mobile phone number</label>
            <input type="text" name="user-email-or-phone" id="email-or-phone">
            <div id="pass-label-with-forgot">
                <label for="user-password" style="font-weight: bold; margin-left: 3px;">Password</label>
                <a href="#" style="text-decoration: none; color: rgb(31, 128, 255);">Forgot Password</a>
            </div>
            <input type="password" name="user-password" id="user-password">
            <input type="submit" name="login" id="login-button" value="Login">
            <div id="remember-me-container">
                <input type="checkbox" name="remember-me" id="remember-me">
                <label for="remember-me">Keep me signed in.</label>
            </div>
        </form>
        <div id="new-user-hint-container">
            <p id="new-to-our-product"><span id="new-to-us-phrase">NEW TO ECOM-EASE</span></p>
        </div>
        <div style="display: flex;">
            <a href="#" id="create-an-account-button">Create a new account</a>
        </div>
    </div>
</div>
</main>
<!-- Include footer  -->
<?php require "footer.php"; ?>
</html>