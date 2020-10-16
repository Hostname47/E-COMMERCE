<?php

    $submitted_username = $submitted_email = $submitted_password = $submitted_repassword = "";

    $error = ["usernameErr"=>"", "emailErr"=>"", "passwordErr"=>""];

    if(isset($_POST["create"])) {
        $submitted_username = $_POST["reg-username"];
        $submitted_email = $_POST["reg-email"];

        if(empty($submitted_username)) {
            $error["usernameErr"] = "* Username should not be empty";
        } else {
            $submitted_username = cleanInput($_POST["reg-username"]);

            if(strlen($submitted_username) > 100) {
                $error["usernameErr"] = "* Username is too long";
            }

            if(!preg_match("/^[a-zA-Z]{1}[a-zA-Z0-9_]+$/", $submitted_username)) {
                $error["usernameErr"] = "* Username should be alphanumeric(underscore is allowed)";
            }
        }

        if(empty($submitted_email)) {
            $error["emailErr"] = "* Email should not be empty";
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


    }

    function cleanInput($data) {
        $data = trim($data);
        $data = htmlspecialchars($data);

        return $data;
    }

?>