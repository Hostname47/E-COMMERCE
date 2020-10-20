<?php
    session_start();

    $submitted_confirmation_code = "";
    $confirmationErr = "";

    require "check-credentials.php";

    if(isset($_POST["check"])) {
        $submitted_confirmation_code = cleanData($_POST["conf-code"]);

        

        if(/*$_SESSION["conf_message"] == $submitted_confirmation_code*/true) {
            header("location: login-forgot-password-confirm-change-pass.php");
        } else {
            $confirmationErr = "Invalid confirmation code";
        }
    }
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

    <style>
        .styled-paragraph {
            margin: 4px 0px 2px 0;
            font-size: 14px; 
        }
    </style>

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
            <div style="display: flex; ">
                <p id="login-title">Confirmation Code</p>
                <a href="login.php" style="margin-left: auto; margin-top: 8px; text-decoration: none; color: rgb(31, 128, 255);"><- login</a>
            </div>
        
        <div class="styled-paragraph" style="display: flex; margin-bottom: 8px"><img src="images/i.png" style="height: 18px; width: 18px;">We'll send a confirmation code to your email</div>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" id="forgot-form">

            <div style="display: flex">
                <label style="font-weight: bold; margin-left: 3px;" for="conf-code">Confirmation code</label>
                <div class="invalid-credential"><?php echo $confirmationErr; ?></div>
            </div>
            
            <input type="text" name="conf-code" id="conf-code" class="styled-form-input" value="<?php if(isset($_POST["check"])) {echo $submitted_confirmation_code;} ?>">
            
            <input type="submit" name="check" id="check-button" class="styled-button" value="Check">

        </form>
    </div>
</div>
</main>
<!-- Include footer  -->
</div>
<?php require "basic-footer.php"; ?>
<style>
    
    #basic-footer {
        position: absolute;
        bottom: 0;
        right: 0;
        left: 0;
    }
</style>
</body>
</html>