<?php

    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/JSON");

    // Get the data
    include "../../config/DB.php";
    include_once "../../modules/category.php";

    // The reason why I used plural in naming is because I want to use this object only to get all the categories
    $database = new Database();
    $db = $database->connect();

    $categories = new Category($db);
    
    $result = $categories->read();

    $num = $result->rowCount();

    if($num > 0) {
        $category_arr = array();
        $category_arr['data'] = array();
        while($row=$result->fetch(PDO::FETCH_ASSOC)) {
            extract($row);
            $category_item = array(
                'id'=>$categoryID,
                'name'=>$categoryName,
                'description'=>$description,
                'picture'=>$picture,
                'active'=>$active
            );
            array_push($category_arr['data'], $category_item);
        }

        // Turn categories data to JSON objects and output
        echo json_encode($category_arr);
    } else {
        echo json_encode(array(
            "message"=>"No category found"
        ));
    }

?>