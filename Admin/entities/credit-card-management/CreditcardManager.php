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

        function deleteCreditCard($id) {
            $query = $this->link->prepare("DELETE FROM creditcardtype WHERE id = (:c_c_id)");
            $query->bindParam(":c_c_id", $id);

            $query->execute();
        }

        function editCreditCardType($id, $newName) {
            if($this->idExists($id)) {
                $query = $this->link->prepare("UPDATE creditcardtype SET creditCardType = (:c_c_type) where id = :id");
                $query->bindParam(":id", $id);
                $query->bindParam(":c_c_type", $newName);

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

        function idExists($id) {
            $query = $this->link->prepare("SELECT * FROM creditcardtype WHERE id = (:id)");
            $query->bindParam(":id", $id);

            $query->execute();
            $counts = $query->rowCount();
            
            return ($counts > 0) ? true : false;
        }

        function getCreditCardTypesAsComponents() {
            $query = $this->link->prepare("SELECT * FROM creditcardtype");
            $query->execute();
            $result = $query->fetchAll();
            
            // The syntax used in the body of foreach called herdocs syntax
            foreach($result as $k => $v) {
                echo <<<EOF
                    <tr>
                        <td>{$v['id']}</td>
                        <td>{$v['creditCardType']}</td>
                        <td>
                            <form action="https://localhost/E-COMMERCE/Admin/entities/credit-card-management/manage-credit-card-type.php" method="POST">
                                <input type="hidden" name="editedId" value="{$v['id']}">
                                <input type="hidden" name="editedName" value="{$v['creditCardType']}">
                                <input type="submit" name="edit" value="edit" class="table-form-button">
                            </form>
                        </td>
                        <td>
                            <form action="https://localhost/E-COMMERCE/Admin/entities/credit-card-management/manage-credit-card-type.php" method="POST">
                                <input type="hidden" name="deletedId" value="{$v['id']}">
                                <input type="submit" name="delete" value="delete" class="table-form-button">
                            </form>
                        </td>
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