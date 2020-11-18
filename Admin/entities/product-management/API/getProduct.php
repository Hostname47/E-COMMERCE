<?php
    include "../../../config/dbConnect.php";

    try {
    $link = "";
    $connection = new dbConnection();
    $link = $connection->connect();

    $query = "SELECT `productID`, `SKU`, `productName`, `contactFname`, `contactLname`, `productDescription`, products.supplierID, 
    products.categoryID, `unitPrice`, `availableSizes`, `availableColors`, `size`, `color`, `discount`, `unitWeight`, 
    `UnitsInStock`, `UnitsOnOrder`, `productAvailable`, products.picture AS pic, `categoryName`, `keywords`, category.categoryID, category.picture FROM `products`
    INNER JOIN category ON products.categoryID = category.categoryID INNER JOIN supplier ON products.supplierid = supplier.supplierID WHERE productID = :prodid";
    $statement = $link->prepare($query);
    $statement->bindParam(":prodid", $_GET["id"]);
    $statement->execute();

    $result = $statement->fetchAll();

    foreach($result as $product) {
        $discountedPrice = $product['unitPrice'] - (($product['discount'] * $product['unitPrice']) / 100.00);
        echo <<<EOS
                <div>
                    <p class="prod-title">Product Informations</p>
                </div>
                <div style="display: flex">
                    <div style="width: 70%">
                        <div style="display: flex;">
                            <p class="selected-product-label"><b>Product image</b>: </p>
                            <img src="../../Products/{$product['pic']}" alt="product image not found" class="prod-picture">
                        </div>
                        <p class="selected-product-label"><b>Product name</b>: {$product['productName']}</p>
                        <p class="selected-product-label"><b>Description</b>: {$product['productDescription']}</p>
                        <p class="selected-product-label"><b>product</b>: {$product['contactFname']} {$product['contactLname']}</p>
                        <p class="selected-product-label"><b>Category</b>: {$product['categoryName']}</p>
                        <p class="selected-product-label"><b>Discount</b>: {$product['discount']}%</p>
                        <p class="selected-product-label"><b>Unit price</b>: {$product['unitPrice']}$</p>
                        <p class="selected-product-label"><b>Discounted price</b>: {$discountedPrice}$</p>
                        <p class="selected-product-label"><b>Available sizes</b>: {$product['availableSizes']}</p>
                        <p class="selected-product-label"><b>Size</b>: {$product['size']}</p>
                        <p class="selected-product-label"><b>Color</b>: {$product['color']}</p>
                        <p class="selected-product-label"><b>Unit weight</b>: {$product['unitWeight']}</p>
                        <p class="selected-product-label"><b>Units in stock</b>: {$product['UnitsInStock']}</p>
                        <p class="selected-product-label"><b>Unit on order</b>: {$product['UnitsOnOrder']}</p>
                        <p class="selected-product-label"><b>Products available</b>: {$product['productAvailable']}</p>
                        <p class="selected-product-label" style="padding-bottom: 14px"><b>keywords</b>: {$product['keywords']}</p>
                    </div>
                    <div>
                        <div>
                            <p class="prod-title">Operations on product</p>
                        </div>
                        <div class="selected-product-operation-container">
                            <a href="edit-product.php?id={$product['productID']}" class="product-info-button" id="edit-product">Edit product</a>
                            <a href="" class="product-info-button" id="delete-product" onclick="deleteProduct(); return false;">Delete product</a>
                            <a href="#" class="product-info-button" id="analyse-product">See analysis</a>
                        </div>
                    </div>
                </div>
        EOS;
    }
    } catch (PDOException $ex) {
        echo $ex->getMessage();
    }
?>