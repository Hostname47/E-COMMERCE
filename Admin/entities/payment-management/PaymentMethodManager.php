<?php

    include "../../config/DbConnect.php";

    class PaymentManager {
        private $link;

        function __construct() {
            $connection = new dbConnection();
            $this->link = $connection->connect();
            return $this->link;
        }

        function insertPayment($payment, $active) {
            // This means Insert new payment only if the payment is not already exist
            if(!$this->paymentExists($payment)) {
                $query = $this->link->prepare("INSERT INTO payment (paymentType, allowed) VALUES (:payment, :active)");
                $query->bindParam(":payment", $payment);
                $query->bindParam(":active", $active);
                $query->execute();
                
                return $query->rowCount();
            }
        }

        function editPayment($id, $newPayment, $newActiveness) {
            if($this->idExists($id)) {
                $query = $this->link->prepare("UPDATE payment set paymentType = :pt, allowed = :activeness WHERE id = :id");
                $query->bindParam(":id", $id);
                $query->bindParam(":pt", $newPayment);
                $query->bindParam(":activeness", $newActiveness);
                $query->execute();

                return ($query->rowCount() > 0) ? true : false;
            }
        }

        function deletePayment($id) {
            $query = $this->link->prepare("DELETE FROM payment WHERE id = :id");
                $query->bindParam(":id", $id);
                $query->execute();
        }

        function getPaymentAsTableRows() {
            include "../../config/settings.php";
            $query = $this->link->prepare("SELECT * FROM payment");
            $query->execute();

            $result = $query->fetchAll();

            foreach($result as $payment) {
                echo <<<EOS
                    <tr>
                        <td>{$payment["paymentType"]}</td>
                        <td>{$payment["allowed"]}</td>
                        <td>
                            <form action="$path/Admin/entities/payment-management/manage-payment-method.php" method="POST">
                                <input type="submit" name="edit" value="Edit">
                                <input type="hidden" name="idToEdit" value="{$payment["id"]}">
                                <input type="hidden" name="paymentToEdit" value="{$payment["paymentType"]}">
                                <input type="hidden" name="allowedToEdit" value="{$payment["allowed"]}">
                            </form>
                        </td>
                        <td>
                            <form action="$path/Admin/entities/payment-management/manage-payment-method.php" method="POST">
                                <input type="submit" name="delete" value="Delete">
                                <input type="hidden" name="paymentToDelete" value="{$payment["id"]}">
                            </form>
                        </td>
                    </tr>
                EOS;

            }
        }

        function paymentExists($payment) {
            $query = $this->link->prepare("SELECT * FROM payment WHERE paymentType = :payment");
            $query->bindParam(":payment", $payment);
            $query->execute();

            return ($query->rowCount() > 0) ? true : false;
        }

        function idExists($id) {
            $query = $this->link->prepare("SELECT * FROM payment WHERE id = :id");
            $query->bindParam(":id", $id);
            $query->execute();

            return ($query->rowCount() > 0) ? true : false;
        }

    }

?>