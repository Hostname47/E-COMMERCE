<?php
    include "../../../config/dbConnect.php";

    $link = "";
    $connection = new dbConnection();
    $link = $connection->connect();

    $query = $link->prepare("SELECT * FROM supplier INNER JOIN payment ON paymentMethods = id WHERE supplierID = :id");
    $query->bindParam(":id", $_GET["id"]);
    $query->execute();

    $result = $query->fetchAll();

    foreach($result as $supplier) {
        if($supplier['discountAvailable'] == 1) {
            $disc = "Yes";
        } else
            $disc = "No";
        echo <<<EOS
                <div>
                    <p class="sup-title">Supplier Informations</p>
                </div>
                <div class="flex-center">
                    <p class="supplier-label"><b>Company name</b>: {$supplier['companyName']}</p>
                    <img src="../../assets/images/Suppliers/{$supplier['logo']}" alt="company image" class="supplier-company-logo">
                </div>
                <p class="supplier-label"><b>Supplier name</b>: {$supplier['contactFname']} {$supplier['contactLname']}</p>
                <p class="supplier-label"><b>Address 1</b>: {$supplier['address1']}</p>
                <p class="supplier-label"><b>Address 2</b>: {$supplier['address2']}</p>
                <p class="supplier-label"><b>City</b>: {$supplier['city']}</p>
                <p class="supplier-label"><b>Postal code</b>: {$supplier['postalCode']}</p>
                <p class="supplier-label"><b>Email</b>: {$supplier['email']}</p>
                <p class="supplier-label"><b>Type goods</b>: {$supplier['typeGoods']}</p>
                <p class="supplier-label"><b>Payment method</b>: {$supplier['paymentType']}</p>
                <p class="supplier-label"><b>Available discount</b>: {$disc}</p>
        EOS;
    }
?>