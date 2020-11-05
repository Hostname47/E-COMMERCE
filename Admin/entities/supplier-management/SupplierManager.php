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
                    <option value="{$value['id']}">{$value['paymentType']}</option>
                EOS;
            }

            echo "</select>";
        }

        function addSupplier($company_name, $contact_firstname, 
            $contact_lastname, $address1, $address2="", 
            $city, $postal_code, $email, $payment_method, $type_goods, $discount_available, $logo) {
                if(!$this->emailExists($email)) {
                    $query = $this->link->prepare("INSERT INTO `supplier`(`companyName`, `contactFname`,
                    `contactLname`, `address1`, `address2`, `city`, `postalCode`, `email`, `typeGoods`,
                    `discountAvailable`, `logo`, `paymentMethods`) VALUES 
                    (:comp_name, :contact_fn, :contact_ln, :addr1, :addr2, :city, :postal_code, :email, :type_goods, :disc_av, :logo, :payment_m)");
                    $query->bindParam(":comp_name", $company_name);
                    $query->bindParam(":contact_fn", $contact_firstname);
                    $query->bindParam(":contact_ln", $contact_lastname);
                    $query->bindParam(":addr1", $address1);
                    $query->bindParam(":addr2", $address2);
                    $query->bindParam(":city", $city);
                    $query->bindParam(":postal_code", $postal_code);
                    $query->bindParam(":email", $email);
                    $query->bindParam(":type_goods", $type_goods);
                    $query->bindParam(":disc_av", $discount_available);
                    $query->bindParam(":logo", $logo);
                    $query->bindParam(":payment_m", $payment_method);
    
                    $query->execute();
                    return $query->rowCount();
                } else
                    return -1;
        }

        function emailExists($email) {
            $query = $this->link->prepare("SELECT * FROM supplier where email = :email");
            $query->bindParam(":email", $email);

            $query->execute();

            if($query->rowCount() > 0) {
                return true;
            } else 
                return false;
        }

        function generateLogos() {
            $query = $this->link->prepare("SELECT * FROM supplier");
                                
            $query->execute();
            $result = $query->fetchAll();
            echo "<option value='0'>-- Select --</option>";
            foreach($result as $k => $v) {
                include "../../config/settings.php";
                echo <<<EOS
                    <option value="{$v['supplierID']}">{$v['companyName']}</option>
                EOS;
            }
        }

        function getLogoById($id) {
            $query = $this->link->prepare("SELECT logo FROM supplier WHERE supplierID = :id");
            $query->bindParam(":id", $id);

            $query->execute();

            return $query->fetch();
        }

        function generateSuppliers() {
            // Here we don't have to pecify aliases beause there's no conflicts between the tables
            $query = $this->link->prepare("SELECT * FROM supplier INNER JOIN payment ON paymentMethods = id");
            $query->execute();

            $result = $query->fetchAll();

            foreach($result as $supplier) {
                echo <<<EOS
                        <div class="supplier-item">
                            <div class="flex-center">
                                <p class="supplier-label">Company name: {$supplier['companyName']}</p>
                                <img src="../../assets/images/Suppliers/{$supplier['logo']}" alt="company image" class="supplier-company-logo">
                            </div>
                            <p class="supplier-label">Supplier name: {$supplier['contactFname']} . ' ' . {$supplier['contactLname']}</p>
                            <p class="supplier-label">Type goods: {$supplier['typeGoods']}</p>
                            <p class="supplier-label">Payment method: {$supplier['paymentType']}</p>
                            <a href="" class="see-more-supplier-info" onclick="printSupplierInfos({$supplier['supplierID']}); return false;">See more ▶</a>
                        </div>
                EOS;
                /* 
                    Hint: Here we pass supplier id to print Method to work with it in back end by pass it to other
                    PHP file and get all the other informations without refreshing the page using AJAX
                */
            }
        }
    }

?>