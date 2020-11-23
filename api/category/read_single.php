<?php

    include "../../config/DB.php";
    include "../../modules/category.php";

    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/JSON");

    // The reason why I used plural in naming is because I want to use this object only to get all the categories
    $database = new Database();
    $db = $database->connect();

    $categories = new Category($db);

    $id = $_GET["category"];
    
    $result = $categories->read_single($id);

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
        return json_encode($category_arr);
    } else {
        return json_encode(array(
            "message"=>"No category found"
        ));
    }

?>