<?php

    session_start();

    $submitted_emailorusername = "";
    $emailErr = "";

    require "check-credentials.php";

    if(isset($_POST["next"])) {
        $submitted_emailorusername = cleanData($_POST["username-or-email"]);
        
        if(empty($submitted_emailorusername)) {
            $emailErr = "* This field is required";
        }
        else if(strpos($submitted_emailorusername, "@") !== false) {
            if(strlen($submitted_emailorusername) > 300) {
                $emailErr = "* Email is too long";
            }

            // Pattern for email match
            $pattern = "/^[_a-zA-Z0-9-]+(\.[_a-zA-Z0-9-]+)*@[a-zA-Z0-9-]+(\.[a-zA-Z0-9-]+)*(\.[a-zA-Z]{2,})$/";

            if(!preg_match($pattern, $submitted_emailorusername)) {
                $emailErr = "* Invalid email format";
            }
        } else {
            if(strlen($submitted_emailorusername) > 300) {
                $emailErr = "* Username is too long";
            }

            if(!preg_match("/^[a-zA-Z][a-zA-Z0-9_]+$/", $submitted_emailorusername)) {
                $emailErr = "* Username should be alphanumeric(underscore is allowed)";
            }
        }

        if($emailErr === "") {
            $stmt = check_username_email($submitted_emailorusername);
            $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $user = $stmt->fetchAll();

            if($stmt->rowCount() > 0) {
                $_SESSION["user_id"] = $user[0]["user_id"];
                $_SESSION["conf_message"] = sha1(md5(generateRandomString()));
                $random = $_SESSION["conf_message"];

                ini_set("SMTP","ssl://smtp.gmail.com");
                ini_set("smtp_port","465");

                mail("mouadstev1@gmail.com", "Reset your password", $random);
            } else {
                
            }
        }

    }

    function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
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
            <div style="display: flex;">
                <p id="login-title">Forgot password?</p>
                <a href="login.php" style="margin-left: auto; margin-top: 8px; text-decoration: none; color: rgb(31, 128, 255);"><- login</a>
            </div>
        
        <div class="styled-paragraph" style="display: flex;"><img src="images/i.png" style="height: 18px; width: 18px;">Here you can reset your forgotten password and/or</div>
        <div class="styled-paragraph" style="margin-bottom: 8px">unlock your account. Enter your username/or email and click Next</div>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" id="forgot-form">

            <div style="display: flex">
                <label style="font-weight: bold; margin-left: 3px;" for="email-or-username">Email or username</label>
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