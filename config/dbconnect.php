<?php
    $servername = "localhost";
    $con_username = "hostname47";
    $con_password = "truestory";
    $dbname = "ECOM";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname;", $con_username, $con_password);
    } catch(PDOException $ex) {
        echo "Error: " . $ex->getMessage() . "<br>";
    }

?>