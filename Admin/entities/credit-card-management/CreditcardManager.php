<?php

    include "../../config/DbConnect.php";
    class CreditCardManager {
        private $link;
        
        function __construct() {
            $connection = new dbConnection();
            $this->link = $connection->connect();
            return $this->link;
        }
        
        function insertCreditCardType($c_c_type) {
            if($this->checkCreditCardTypeExistence($c_c_type)) {
                return 0;
            } else {
                $query = $this->link->prepare("INSERT INTO creditcardtype (creditCardType) VALUES (:c_c_type)");
                $query->bindParam(":c_c_type", $c_c_type);

                $query->execute();
                $counts = $query->rowCount();
                
                return $counts;
            }
        }

        function checkCreditCardTypeExistence($c_c_type) {
            $cat_name = $this->cleanData($c_c_type);
            
            $query = $this->link->prepare("Select * FROM creditcardtype where creditCardType = :c_c_type");
            $query->bindParam(":c_c_type", $c_c_type);
            $query->execute();
            $counts = $query->rowCount();

            if($counts > 0) {
                return true;
            } else
                return false;
        }

        function getCreditCardTypesAsComponents() {
            $query = $this->link->prepare("SELECT * FROM creditcardtype");
            $query->execute();
            $result = $query->fetchAll();

            foreach($result as $k => $v) {
                echo <<<EOF
                    <tr>
                    <td>{$v['id']}</td>
                    <td>{$v['creditCardType']}</td>
                    <td><form action="<?php echo htmlspecialchars({$_SERVER["PHP_SELF"]});?>"><input type="submit" value="edit" class="table-form-button"></form></td>
                    <td><form action='<?php echo htmlspecialchars({$_SERVER["PHP_SELF"]}); ?>'><input type="submit" value="delete" class="table-form-button"></form></td>
                    </tr>
                EOF;
            }
        }

        function cleanData($data) {
            $data = htmlspecialchars($data);
            $data = trim($data);
    
            return $data;
        }
    }

?>