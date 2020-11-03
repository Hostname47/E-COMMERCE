<?php
    include "../../config/DbConnect.php";

    class SupplierManager {
        private $link;

        function __construct() {
            $connection = new dbConnection();
            $this->link = $connection->connect();
            return $this->link;
        }

        function generatePaymentMethods($err) {
            echo <<<EOS
                <div style="display: flex">
                    <label style="font-weight: bold; margin-left: 3px;" for="">Payment methods</label>
                    <div class="invalid-credential">{$err}</div>
                </div>
                <select name="payment_method" id="payment_method" class="form-dropDown">
            EOS;

            $query = $this->link->prepare("SELECT * FROM payment");
            $query->bindParam(":companyName", $company_name);
            $query->bindParam(":phone", $phone);
            $query->execute();
            
            $result = $query->fetchAll();

            foreach($result as $key => $value) {
                echo <<<EOS
                    <option value="{$value['allowed']}">{$value['paymentType']}</option>
                EOS;
            }

            echo "</select>";
        }
    }

?>