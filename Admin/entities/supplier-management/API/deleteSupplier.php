<?php

    include "../SupplierManager.php";
    include "../../../config/DbConnect.php";

    $supplier_manag = new SupplierManager();

    $submitted_id = $_GET["id"];

    $supplier_manag->deleteSupplier($submitted_id);

?>