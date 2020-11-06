<?php
     	
    //Report all errors except warnings.
    error_reporting(E_ALL ^ E_WARNING);
    
    include "../SupplierManager.php";
    include "../../../config/DbConnect.php";

    $supplier_manag = new SupplierManager();

    echo $supplier_manag->generateSuppliers();
    
?>