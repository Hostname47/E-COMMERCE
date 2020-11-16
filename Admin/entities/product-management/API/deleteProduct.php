<?php

    //Report all errors except warnings.
    error_reporting(E_ALL ^ E_WARNING);

    include "../ProductManager.php";
    include "../../../config/DbConnect.php";

    $product_manag = new ProductManager();

    $submitted_id = $_GET["id"];

    $res = $product_manag->deleteProduct($submitted_id);

    if($res > 0) {
        echo 1;
    } else {
        echo 0;
    }

?>