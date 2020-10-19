<?php 

// Check both email/username and password
function check_credentials($username_or_email, $pass) : boolean {
    require "config/dbconnect.php";
    try {
        if(strpos($username_or_email, "@") !== false) {
            $stmt = $conn->prepare("SELECT * FROM user_info WHERE email = :email and password = md5(:password)");
            $stmt->bindParam(":email", $username_or_email);
            $stmt->bindParam(":password", $pass);
            $stmt->execute();
            
            $num = $stmt->numCount();
        } else {
            $stmt = $conn->prepare("SELECT * FROM user_info WHERE user_name = :username and password = md5(:password)");
            $stmt->bindParam(":username", $username_or_email);
            $stmt->bindParam(":password", $pass);
            $stmt->execute();
            
            $num = $stmt->rowCount();
        }

        if($num > 0) {
            return $stmt;
        } else {
            return $stmt;
        }
    } catch(PDOException $ex) {
        echo $ex->getMessage();
    } 
}

// Check only email/username existence
function check_username_email($username_email) {
    require "config/dbconnect.php";
    try {
        if(strpos($username_email, "@") !== false) {
            $stmt = $conn->prepare("SELECT * FROM user_info WHERE email = :email");
            $stmt->bindParam(":email", $username_email);
            $stmt->execute();
            
            $num = $stmt->rowCount();
        } else {
            $stmt = $conn->prepare("SELECT * FROM user_info WHERE user_name = :username");
            $stmt->bindParam(":username", $username_email);
            $stmt->execute();
            $num = $stmt->rowCount();
        }

        return $stmt;
    } catch(PDOException $ex) {
        echo $ex->getMessage();
    } 
}

function cleanData($data) {
    $data = trim($data);
    $data = htmlspecialchars($data);

    return $data;
}

?>