<?php

    $submitted_username = $submitted_email = $submitted_password = $submitted_repassword = $user_created= "";

    $error = ["generalErr"=>"", "usernameErr"=>"", "emailErr"=>"", "passwordErr"=>"", "repasswordErr"=>""];

    if(isset($_POST["create"])) {
        $submitted_username = $_POST["reg-username"];
        $submitted_email = $_POST["reg-email"];
        $submitted_password = $_POST["reg-password"];
        $submitted_repassword = $_POST["reg-re-password"];

        // Clean username and validate
        if(empty($submitted_username)) {
            $error["usernameErr"] = "* This field is required";
        } else {
            $submitted_username = cleanInput($_POST["reg-username"]);

            if(strlen($submitted_username) > 100) {
                $error["usernameErr"] = "* Username is too long";
            }

            if(!preg_match("/^[a-zA-Z][a-zA-Z0-9_]+$/", $submitted_username)) {
                $error["usernameErr"] = "* Username should be alphanumeric(underscore is allowed)";
            }
        }

        // Clean and validate email
        if(empty($submitted_email)) {
            $error["emailErr"] = "* This field is required";
        } else {
            $submitted_email = cleanInput($_POST["reg-email"]);

            if(strlen($submitted_email) > 300) {
                $error["emailErr"] = "* Email is too long";
            }

            // Pattern for email match
            $pattern = "/^[_a-zA-Z0-9-]+(\.[_a-zA-Z0-9-]+)*@[a-zA-Z0-9-]+(\.[a-zA-Z0-9-]+)*(\.[a-zA-Z]{2,})$/";

            if(!preg_match($pattern, $submitted_email)) {
                $error["emailErr"] = "* Invalid email format";
            }
        }

        // Password validation
        if(empty($submitted_password)) {
            $error["passwordErr"] = "* This field is required";
        } else {
            $submitted_password = cleanInput($_POST["reg-password"]);

            if(strlen($submitted_password) > 300) {
                $error["PasswordErr"] = "* Password is too long";
            }

            // Pattern for email match
            $pattern = "/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}$/";

            if(!preg_match($pattern, $submitted_password)) {
                $error["passwordErr"] = "* Password should contains one upper,lower and digit";
            }
        }

        // Verify canfirmation password only when password is correct
        if($error["passwordErr"] === "") {
            if(empty($submitted_repassword)) {
                $error["repasswordErr"] = "* This field is required";
            } else {
                $submitted_repassword = cleanInput($_POST["reg-re-password"]);
    
                if(strlen($submitted_password) > 300) {
                    $error["repasswordErr"] = "* Password is too long";
                }
    
                // Pattern for email match
                $pattern = "/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}$/";
    
                if(!preg_match($pattern, $submitted_password)) {
                    $error["repasswordErr"] = "* Password should contains one upper,lower and digit";
                }
            }
        }
        

        if($error["passwordErr"] === "" && $error["repasswordErr"] === "") {
            if(strcmp($submitted_password, $submitted_repassword) !== 0) {
                $error["passwordErr"] = "Password confirmation dismatch";
            }
        }

        $isEmpty = true;

        foreach($error as $k => $v) {
            if(!empty($v)) {
                $isEmpty = false;
                break;
            }
        }

        // IF EVERYTHING IS RIGHT
        if($isEmpty) {
            require "../config/dbconnect.php";
            
            // Varify username and email if they already exist
            try {
                $stmt = $conn->prepare("SELECT * FROM user_info WHERE (user_name = :u_name)");
                $stmt->bindParam(':u_name', $submitted_username);
                $stmt->execute();
                $usr_numrows = $stmt->rowCount();

                $stmt = $conn->prepare("SELECT * FROM user_info WHERE (email = :u_email)");
                $stmt->bindParam(':u_email', $submitted_email);
                $stmt->execute();
                $eml_numrows = $stmt->rowCount();

            } catch(PDOException $ex) {
                echo $ex->getMessage();
            }

            try {
                // Check username
                if($usr_numrows > 0) {
                    $error["generalErr"] = "* User already existed with this username";
                } // Check email
                else if($eml_numrows > 0) {
                    $error["generalErr"] = "* User already existed with this email";
                } else {
                    $stmt = $conn->prepare("INSERT INTO user_info (user_name, email, password) VALUES (:u_name, :u_email, md5(:u_password))");
                    $stmt->bindParam(':u_name', $submitted_username);
                    $stmt->bindParam(':u_email', $submitted_email);
                    $stmt->bindParam(':u_password', $submitted_password);
    
                    $stmt->execute();
    
                    $conn = null;

                    $user_created = "User created successfully";
                }
            } catch (PDOException $ex) {
                echo $ex->getMessage();
            }
        }
    }

    function cleanInput($data) {
        $data = trim($data);
        $data = htmlspecialchars($data);

        return $data;
    }

?>