<?php

session_start();

// First check whether the user is already connected witout logging out if so redirect him directly to dashboard
if(isset($_SESSION["user_id"])) {
    header("location: index.php");
}
// Else verify cookies, if user click remember me before and cookies are valid and he press login then redirect him to dashboard
else {
    if(/* verify login button pressed just fill in inputs */ isset($_POST["log"]) and isset($_COOKIE["username_or_email"]) and isset($_COOKIE["user_password"])) {
        $count = check_credentials($_COOKIE["username_or_email"], $_COOKIE["user_password"])->rowCount();
        echo $count;
        if($count > 0) {
            header("location: index.php");
        }
    }
}

$submitted_usernameoremail = $submitted_password = "";

$error = ["generalErr"=>"", "usernameOrEmailErr"=>""];

if(isset($_POST["log"])) {
    $submitted_usernameoremail = $_POST["log-emailorusername"];
    $submitted_password = $_POST["log-password"];


    if(empty($submitted_usernameoremail)) {
        $error["usernameOrEmailErr"] = "* This field is required";
    } else {
        $submitted_usernameoremail = cleanInput($_POST["log-emailorusername"]);
        if (!(strpos($submitted_usernameoremail, "@") !== false)){
            if(strlen($submitted_usernameoremail) > 300) {
                $error["usernameOrEmailErr"] = "* username is too long";
            }
            
            //  -------------- NOTICE --------------
            /* This validation match only string which contain upper and lower case usernames (maybe you should use some other technique than regex) you 
               should fix this as soon as you can - MOUAD NASSRI
            */

            if(!preg_match("/^[a-zA-Z][a-zA-Z0-9_]+$/", $submitted_usernameoremail)) {
                $error["usernameOrEmailErr"] = "* Invalid credentials";
            }
        } else{
            // Pattern for email match
            $pattern = "/^[_a-zA-Z0-9-]+(\.[_a-zA-Z0-9-]+)*@[a-zA-Z0-9-]+(\.[a-zA-Z0-9-]+)*(\.[a-zA-Z]{2,})$/";
            if(strlen($submitted_usernameoremail) > 300) {
                $error["usernameOrEmailErr"] = "* email is too long";
            }
            if(!preg_match($pattern, $submitted_usernameoremail)) {
                $error["usernameOrEmailErr"] = "* Invalid email format";
            }
        }
    }

    if($error["usernameOrEmailErr"] === "") {
        // Password validation
        if(empty($submitted_password)) {
            $error["usernameOrEmailErr"] = "* Password required";
        } else {
            $submitted_password = cleanInput($_POST["log-password"]);

            if(strlen($submitted_password) > 300) {
                $error["usernameOrEmailErr"] = "* Password is too long";
            }
        }
    }

    if($error["usernameOrEmailErr"] === "") {
        require "config/dbconnect.php";

        try {
            $stmt = check_credentials($submitted_usernameoremail, $submitted_password);

            if($stmt->rowCount() > 0) {
                $user_data = $stmt->fetchAll();
                // CHECK REMEMBER ME FEATURE

                // Preserve user_id in a session variable for remember me feature use later
                $_SESSION["user_id"] = $user_data[0]['user_id'];
                if(isset($_POST["remember-me"])) {
                    
                    // Here you have to encrypt password, don't try to send it directly to cookie
                    setcookie("username_or_email", $submitted_usernameoremail, time()+3600*24*30);  /* expire in 30 days */
                    setcookie("user_password", $submitted_password, time()+3600*24*30);  /* expire in 30 days */
                } else{
                    setcookie("username_or_email", "", time() - 3600);  /* expire in 30 days */
                    setcookie("user_password", "", time() - 3600);  /* expire in 30 days */
                }

                header("location: index.php");
            } else {
                $error["usernameOrEmailErr"] = "Invalid credentials";
            }
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
    }

    
}

function check_credentials($username_or_email, $pass) {
    require "config/dbconnect.php";
    try {
        if(strpos($username_or_email, "@") !== false) {
            $stmt = $conn->prepare("SELECT * FROM user_info WHERE email = :email and password = :password");
            $stmt->bindParam(":email", $username_or_email);
            $stmt->bindParam(":password", $pass);
            $stmt->execute();
            
            $num = $stmt->rowCount();
        } else {
            $stmt = $conn->prepare("SELECT * FROM user_info WHERE user_name = :username and password = :password");
            $stmt->bindParam(":username", $username_or_email);
            $stmt->bindParam(":password", $pass);
            $stmt->execute();
            
            $num = $stmt->rowCount();
        }

        return $stmt;
    } catch(PDOException $ex) {
        echo $ex->getMessage();
    } 
}

function validate_username($str) {

  // each array entry is an special char allowed
  // besides the ones from ctype_alnum
  $allowed = array(".", "-", "_");

  if (ctype_alnum(str_replace($allowed, '', $str ) ) ) {
    return $str;
  } else {
    $str = "Invalid Username";
    return $str;
  }
}

function cleanInput($data) {
    $data = trim($data);
    $data = htmlspecialchars($data);

    return $data;
}

?>