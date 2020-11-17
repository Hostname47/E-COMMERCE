<?php

    include_once "config/dbconnect.php";

    $database = new Database();
    $db = $database->connect();

    $stmt = $db->prepare("SELECT * FROM category");
    $stmt->execute();

    $result = $stmt->fetchAll();
    
    foreach($result as $k => $category) {
        echo <<<EOS
            <option value="{$category['categoryID']}">{$category['categoryName']}</option>
        EOS;
    }

?>