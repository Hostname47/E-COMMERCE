<?php
    include "../../config/DbConnect.php";

    class ShipperManager {
        private $link;
        
        function __construct() {
            $connection = new dbConnection();
            $this->link = $connection->connect();
            return $this->link;
        }
        
        function insertShipper($company_name, $phone) {
            if($this->checkCompanyExists($company_name)) {
                return 0;
            } else {
                $query = $this->link->prepare("INSERT INTO Shippers (companyName, phone) VALUES (:companyName, :phone)");
                $query->bindParam(":companyName", $company_name);
                $query->bindParam(":phone", $phone);
                $query->execute();
                $counts = $query->rowCount();
                
                return $counts;
            }
        }

        function checkCompanyExists($companyName) {
            $companyName = $this->cleanData($companyName);
            
            $query = $this->link->prepare("Select * FROM Shippers where companyName = :compName");
            $query->bindParam(":compName", $companyName);
            $query->execute();
            $counts = $query->rowCount();

            if($counts > 0) {
                return true;
            } else
                return false;
        }

        function generateShippersRows() {
            $query = $this->link->prepare("Select * FROM Shippers");
            $query->execute();
            $result = $query->fetchAll(PDO::FETCH_ASSOC);

            foreach($result as $k => $v) {
                echo  "<tr><td>". $v['companyName'] . "</td>";
                echo  "<td>" . $v['phone'] . "</td>";
                echo  "</tr>";
            }
        }

        function cleanData($data) {
            $data = htmlspecialchars($data);
            $data = trim($data);
    
            return $data;
        }
    }

?>