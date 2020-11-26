<?php

    require "../config/DB.php";
try {
    $link;

    $connection = new Database();
    $link = $connection->connect();

    $id = $_GET["id"];
    $id = substr($id, 1, -1);
    $id = preg_split("/\,/", $id);

    $query = $link->prepare("SELECT productID, `SKU`, `productName`, `productDescription`, `supplierID`, 
        products.categoryID, `unitPrice`, `availableSizes`, `availableColors`, `size`, `color`, `discount`, `unitWeight`, 
        `UnitsInStock`, `UnitsOnOrder`, `productAvailable`, products.picture AS pic, `keywords`, category.categoryID FROM `products`
        INNER JOIN category ON products.categoryID = category.categoryID WHERE productID = :id");

    $query->bindParam(":id", $id[0]);
    $query->execute();
    $result = $query->fetch();
    $result["qte"] = $id[1];

    $res = json_encode($result);
    echo $res;

} catch(PDOException $ex) {
    echo $ex->getMessage();
}
?>