<?php
    include "../../../config/dbConnect.php";

    /*
        Here we get the intended record and store all data in associative array and return it to send back to the edit
        section to use it to fill the inputs so we can make edit process mush more easier
    */

    $link = "";
    $connection = new dbConnection();
    $link = $connection->connect();

    $query = $link->prepare("SELECT * FROM supplier INNER JOIN payment ON paymentMethods = id WHERE supplierID = :id");
    $query->bindParam(":id", $_GET["id"]);
    $query->execute();

    $result = $query->fetch();

    $supplierInfos = ["sup_id"=>$result["supplierID"] , "companyName"=>$result["companyName"], "contactFname"=>$result["contactFname"], 
    "contactLname"=>$result["contactLname"], "address1"=>$result["address1"], 
    "address2"=>$result["address2"], "city"=>$result["city"], 
    "postalCode"=>$result["postalCode"], "email"=>$result["email"], "typeGoods"=>$result["typeGoods"],
    "paymentMethods"=>$result["paymentMethods"], "discountAvailable"=>$result["discountAvailable"]];

    echo json_encode($supplierInfos);

?>