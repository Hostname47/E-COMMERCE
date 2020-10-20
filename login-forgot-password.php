<?php

    session_start();
    
    $submitted_email = "";
    $emailErr = "";

    require "check-credentials.php";

    if(isset($_POST["next"])) {
        $submitted_email = cleanData($_POST["username-or-email"]);
        
        if(empty($submitted_email)) {
            $emailErr = "* This field is required";
        }
        else if(strpos($submitted_email, "@") !== false) {
            if(strlen($submitted_email) > 300) {
                $emailErr = "* Email is too long";
            }

            // Pattern for email match
            $pattern = "/^[_a-zA-Z0-9-]+(\.[_a-zA-Z0-9-]+)*@[a-zA-Z0-9-]+(\.[a-zA-Z0-9-]+)*(\.[a-zA-Z]{2,})$/";

            if(!preg_match($pattern, $submitted_email)) {
                $emailErr = "* Invalid email format";
            }
        }

        if($emailErr === "") {
            $stmt = check_username_email($submitted_email);
            $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $user = $stmt->fetchAll();

            if($stmt->rowCount() > 0) {
                $_SESSION["user_id"] = $user[0]["user_id"];
                $_SESSION["conf_message"] = generateRandomString();
                $random = $_SESSION["conf_message"];
                
                // Send this random string to user's email to let him confirm his account
                
                header("location: login-forgot-password-confirm.php");
            } else {
                
            }
        }

    }

    function spamcheck($field)
    {
        //filter_var() sanitizes the e-mail
        //address using FILTER_SANITIZE_EMAIL
        $field=filter_var($field, FILTER_SANITIZE_EMAIL);
    
        //filter_var() validates the e-mail
        //address using FILTER_VALIDATE_EMAIL
        if(filter_var($field, FILTER_VALIDATE_EMAIL))
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    
    function sendMail($toEmail, $fromEmail, $subject, $message)
    {
        $validFromEmail = spamcheck($fromEmail);
        if($validFromEmail)
        {
            mail($toEmail, $subject, $message, "From: $fromEmail");
        }
    }

    function generateRandomString($length = 8) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= md5($characters[rand(0, $charactersLength - 1)]);
        }
        return $randomString;
    }
    

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EASY-ECOM Login</title>

    <link href="https://fonts.googleapis.com/css2?family=Karla&display=swap" rel="stylesheet">
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
            <div style="display: flex;">
                <p id="login-title">Forgot password?</p>
                <a href="login.php" style="margin-left: auto; margin-top: 8px; text-decoration: none; color: rgb(31, 128, 255);"><- login</a>
            </div>
        
        <div class="styled-paragraph" style="display: flex;"><img src="images/i.png" style="height: 18px; width: 18px;">Here you can reset your forgotten password and/or</div>
        <div class="styled-paragraph" style="margin-bottom: 8px">unlock your account. Enter your username/or email and click Next</div>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" id="forgot-form">

            <div style="display: flex">
                <label style="font-weight: bold; margin-left: 3px;" for="email-or-username">Email</label>
                <div class="invalid-credential"><?php echo $emailErr; ?></div>
            </div>
            
            <input type="text" name="username-or-email" id="email-or-username" class="styled-form-input" value="<?php ?>">
            
            <input type="submit" name="next" id="next-button" class="styled-button" value="Next">

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