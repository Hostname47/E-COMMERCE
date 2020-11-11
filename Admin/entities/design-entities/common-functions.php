<?php

    class CommonFunctionProvider {
        private $link;

        function __construct() {
            $con = new DbConnection();
            $this->link = $con->connect();
            return $this->link;
        }

        function getSuppliersAsDropdownlist() {
            // Here we don't have to pecify aliases beause there's no conflicts between the tables
            $query = $this->link->prepare("SELECT * FROM supplier");
            $query->execute();
    
            $result = $query->fetchAll();
            echo "<select name='suppliers' id='suppliers' class='form-dropDown'>";
            foreach($result as $k => $supplier) {
                echo <<<EOS
                    <option value="{$supplier['supplierID']}">{$supplier['contactFname']} {$supplier['contactLname']} - {$supplier['companyName']}</option>
                EOS;
            }
            echo "</select>";
        }

        function getCategoryById($id) {
            // Here we don't have to pecify aliases beause there's no conflicts between the tables
            $query = $this->link->prepare("SELECT * FROM category WHERE categoryID = :cat");
            $query->bindParam(":cat", $id);
            $query->execute();

            $result = $query->fetch();
            return $result;
        }


        function getCategoriesAsDropDownList($class = "form-dropDown", $value=0, $form="") {
            // Here we don't have to pecify aliases beause there's no conflicts between the tables
            $query = $this->link->prepare("SELECT * FROM category");
            $query->execute();
    
            $result = $query->fetchAll();
            echo "<input type='hidden' id='id' value='$value'>";
            echo "<select name='category' id='category' class='$class' value='{$value}' form='{$form}'>";
            foreach($result as $k => $category) {
                echo <<<EOS
                    <option value="{$category['categoryID']}">{$category['categoryName']}</option>
                EOS;
            }
            echo "</select>";
        }
    }

?>