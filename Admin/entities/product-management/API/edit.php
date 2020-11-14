<?php
   include "../../../config/dbConnect.php";

   try {
        $link = "";
        $connection = new dbConnection();
        $link = $connection->connect();

        $query = "SELECT productName FROM products WHERE productID = :id";
        $statement = $link->prepare($query);
        $statement->bindParam(":id", $_GET["id"]);
        $statement->execute();

        $result = $statement->fetchAll();

        $id = $_GET["id"];

        if(isset($ok)) {
            $productPicture = $submitted_product_name . "/" . $_FILES["product_picture"]["name"];

            $old = $product_manager->getProductById($id);
            $old_product_directory_name = $target_dir . $old["productName"];
            $new_product_directory_name = $target_dir . $submitted_product_name;
            // delete the older image
            rename($old_product_directory_name, $new_product_directory_name);

            echo "old: " . $old_product_directory_name . ", new: " . $new_product_directory_name;

            /*foreach($target_file as $file){ // iterate files
                if(is_file($file)) {
                    unlink($file); // delete file
                }
            } // I think it's a good idea to keep the older image there, and just change the path in the database to the new image

            if (move_uploaded_file($_FILES["product_picture"]["tmp_name"], $target_file)) {
                $product_manager->editProduct($_POST["edited-id"], $submitted_product_name, $submitted_sku, $submitted_desc, $submitted_supplier, 
                $submitted_category, $submitted_available_sizes, $submitted_available_colors, $submitted_size, $submitted_color,
                $submitted_unit_price, $submitted_discount, $submitted_unit_weight, $submitted_units_in_stock, $submitted_units_on_order,
                $submitted_product_available, $submitted_keywords, $productPicture);
                
                $product_created = "Product edited successfully";
            }*/
        }
    } catch(PDOException $ex) {
        echo "Connection error";
    }

?>