<?php

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
            /* This validation match only string which contain upper and lower case usernames you 
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

            // Pattern for email match
            $pattern = "/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}$/";

            if(!preg_match($pattern, $submitted_password)) {
                $error["usernameOrEmailErr"] = "* Password should contains one upper,lower and digit";
            }
        }
    }

    if($error["usernameOrEmailErr"] === "") {
        require "config/dbconnect.php";

        try {
            if(strpos($submitted_usernameoremail, "@") !== false) {
                $stmt = $conn->prepare("SELECT * FROM user_info WHERE email = :email");
                $stmt->bindParam(":email", $submitted_usernameoremail);
                $stmt->execute();

                $num = $stmt->numCount();
            } else {
                $stmt = $conn->prepare("SELECT * FROM user_info WHERE user_name = :username");
                $stmt->bindParam(":username", $submitted_usernameoremail);
                $stmt->execute();

                $num = $stmt->rowCount();
            }

            if($num > 0) {
                // CHECK REMEMBER ME FEATURE

                header("location: index.php");
            } else {
                $error["usernameOrEmailErr"] = "Invalid credentials";
            }
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
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