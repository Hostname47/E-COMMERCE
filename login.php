<?php

    require "login-validation.php";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EASY-ECOM Login</title>

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
        <p id="login-title">Login</p>
        
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" id="login-form">

            <div style="display: flex">
                <label style="font-weight: bold; margin-left: 3px;" for="email-or-phone">Email or username</label>
                <div class="invalid-credential"><?php echo $error["usernameOrEmailErr"]; ?></div>
            </div>
            
            <input type="text" name="log-emailorusername" id="email-or-phone" class="styled-form-input" value="<?php if(isset($_COOKIE["username_or_email"])) { echo $_COOKIE["username_or_email"];} else if(isset($_POST["log"])) echo md5($submitted_usernameoremail); ?>">
            <div id="pass-label-with-forgot">
                <label for="user-password" style="font-weight: bold; margin-left: 3px;">Password</label>
                <a href="login-forgot-password.php" class="its-a-link">Forgot Password</a>
            </div>
            <input type="password" name="log-password" id="user-password" class="styled-form-input" value="<?php if(isset($_COOKIE["user_password"])) { echo md5($_COOKIE["user_password"]);} ?>">
            <input type="submit" name="log" id="login-button" value="Login">
            <div id="remember-me-container">
                <input type="checkbox" name="remember-me" id="remember-me">
                <label for="remember-me">Keep me signed in.</label>
            </div>
        </form>
        <div id="new-user-hint-container">
            <p id="new-to-our-product"><span id="new-to-us-phrase">NEW TO ECOM-EASE</span></p>
        </div>
        <div style="display: flex;">
            <a href="registration.php" id="create-an-account-button" class="styled-form-button">Create a new account</a>
        </div>
    </div>
</div>
</main>
<!-- Include footer  -->
<?php require "basic-footer.php"; ?>
</html>