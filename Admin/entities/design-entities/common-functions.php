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

        function getCategoriesAsDropDownList() {
            // Here we don't have to pecify aliases beause there's no conflicts between the tables
            $query = $this->link->prepare("SELECT * FROM category");
            $query->execute();
    
            $result = $query->fetchAll();
            echo "<select name='category' id='category' class='form-dropDown'>";

            foreach($result as $k => $category) {
                echo <<<EOS
                    <option value="{$category['categoryID']}">{$category['categoryName']}</option>
                EOS;
            }
            echo "</select>";
        }
    }

?>