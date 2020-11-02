<?php

    include "../../config/DbConnect.php";
    class CategoryManager {
        private $link;
        public $categoryPicturesLocation = "https://localhost/E-COMMERCE/Admin/assets/Images/Categories/";
        
        function __construct() {
            $connection = new dbConnection();
            $this->link = $connection->connect();
            return $this->link;
        }
        
        function insertCategory($cat_name, $desc, $picture, $active) {
            if($this->checkCategoryExists($cat_name)) {
                return 0;
            } else {
                $query = $this->link->prepare("INSERT INTO Category (categoryName, description, picture, active) VALUES (:cat_name, :desc, :picture, :active)");
                $query->bindParam(":cat_name", $cat_name);
                $query->bindParam(":desc", $desc);
                $query->bindParam(":picture", $picture);
                $query->bindParam(":active", $active);

                $query->execute();
                $counts = $query->rowCount();
                
                return $counts;
            }
        }

        function deleteCategory($id) {
            if($this->idExists($id)) {
                $query = $this->link->prepare("DELETE FROM Category WHERE categoryID = (:c_id)");
                $query->bindParam(":c_id", $id);
                
                $query->execute();

                $counts = $query->rowCount();

                if($counts > 0) {
                    $path = "../../assets/images/Categories";
                    $filename =  $path . "/" . $_POST['deletedPicture']; // build the full path here
                    if (file_exists($filename)) {
                        unlink($filename);
                    }
                }

                return $counts;
            } else
                return -1;
        }

        function editCategory($id, $cat_name, $cat_desc, $cat_picture, $cat_active) {
            if($this->idExists($id)) {
                $cat_name = $this->cleanData($cat_name);
                $cat_desc = $this->cleanData($cat_desc);
                $cat_picture = $this->cleanData($cat_picture);
                $cat_active = $this->cleanData($cat_active);

                $query = $this->link->prepare("UPDATE Category set categoryName =  :cat_name, description = :desc, picture = :picture, active = :active WHERE categoryId = :id");

                $query->bindParam(":id", $id);
                $query->bindParam(":cat_name", $cat_name);
                $query->bindParam(":desc", $cat_desc);
                $query->bindParam(":picture", $cat_picture);
                $query->bindParam(":active", $cat_active);

                $query->execute();
                $counts = $query->rowCount();
                
                return $counts;
            } else {
                return -1;
            }

        }

        function checkCategoryExists($cat_name) {
            $cat_name = $this->cleanData($cat_name);
            
            $query = $this->link->prepare("Select * FROM Category where categoryName = :cat_name");
            $query->bindParam(":cat_name", $cat_name);
            $query->execute();
            $counts = $query->rowCount();

            if($counts > 0) {
                return true;
            } else
                return false;
        }

        function idExists($id) {
            $id = $this->cleanData($id);
            
            $query = $this->link->prepare("Select * FROM Category where categoryID = :id");
            $query->bindParam(":id", $id);
            $query->execute();
            $counts = $query->rowCount();

            if($counts > 0) {
                return true;
            } else
                return false;
        }

        function getCategoriesAsComponents() {
            $query = $this->link->prepare("SELECT * FROM Category");
            $query->execute();
            $result = $query->fetchAll();

            foreach($result as $k => $v) {
                if($v["active"] == 1) {
                    $status = "active";
                } else {
                    $status = "InActive";
                }

                // Go to manage-credit-card-type and see how I get over this problem of multiple echos bu using herdocs syntax
                echo '<div class="category-item">';
                echo "<img class='cat-picture' src='../../assets/images/Categories/" . $v["picture"] . "' alt='item image'>";
                echo "<div style='margin-left: 12px'>";
                echo "<h2 class='cat-title'>Category name: " . $v['categoryName'] . "</h2>";
                echo "<p class='cat-desc'>Description: " . $v['description'] . "</p>";
                echo "<p class='cat-status'>Status: " . $status . "</p>";
                echo "</div>";
                echo "</div>";
            }
        }

        function getCategoriesAsTableRows() {
            $query = $this->link->prepare("SELECT * FROM Category");
            $query->execute();
            $result = $query->fetchAll();

            foreach($result as $k => $v) {
                if($v["active"] == 1) {
                    $status = "active";
                } else {
                    $status = "InActive";
                }

                echo <<<EOS
                <tr>
                    <td>{$v['categoryID']}</td>
                    <td><img class='cat-picture' style="width: 40px; height: 40px; vertical-align: top;" src='../../assets/images/Categories/{$v['picture']}' alt='item image'></td>
                    <td><p class='cat-title' class="center-it">{$v['categoryName']}</p></td>
                    <td><p class='cat-desc' class="center-it">{$v['description']}</p></td>
                    <td><p class='cat-status'>{$status}</p></td>
                    <td>
                        <form action="https://localhost/E-COMMERCE/Admin/entities/category-management/manage-categories.php" method="POST">
                            <input type="submit" name="edit_cat" value="Edit">
                            <input type="hidden" name="editedId" value="{$v['categoryID']}">
                            <input type="hidden" name="editedName" value="{$v['categoryName']}">
                            <input type="hidden" name="editedDesc" value="{$v['description']}">
                            <input type="hidden" name="editedActive" value="{$v['active']}">
                            <input type="hidden" name="editedPicture" value="{$v['picture']}">
                        </form>
                    </td>
                    <td>
                        <form action="https://localhost/E-COMMERCE/Admin/entities/category-management/manage-categories.php" method="POST">
                            <input type="submit" name="delete_cat" value="Delete">
                            <input type="hidden" name="deletedId" value="{$v['categoryID']}">
                            <input type="hidden" name="deletedPicture" value="{$v['picture']}">
                        </form>
                    </td>
                </tr>
                EOS;
            }
        }

        function deleteCatImage($id, $pict) {
            if($this->idExists($id)) {
                $query = $this->link->prepare("Select * FROM Category WHERE categoryID = (:c_id)");
                $query->bindParam(":c_id", $id);
                
                $query->execute();
                $result = $query->fetchAll();

                $counts = $query->rowCount();

                if($counts > 0) {
                    $path = "../../assets/images/Categories";
                    
                    $filename =  $path . "/" . $pict; // build the full path here
                    if (file_exists($filename)) {
                        unlink($filename);
                    }
                }

                return $counts;
            } else
                return -1;
        }

        function cleanData($data) {
            $data = htmlspecialchars($data);
            $data = trim($data);
    
            return $data;
        }
    }

?>