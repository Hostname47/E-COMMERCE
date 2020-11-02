
<?php

   include "CategoryManager.php";

   $message = $err = "";
   $edit_id = $edited_cat_name = $edited_cat_desc = $edited_cat_active = $edited_picture = $cat_edited = $c_err = "";
   $error = ["catnameErr"=>"", "descErr"=>"", "pictureErr"=>"", "activeErr"=>""];

   $categories_manager = new CategoryManager();

    if(isset($_POST["delete_cat"])) {
        // This is the id of item that you want to delete
        $id = $categories_manager->cleanData($_POST["deletedId"]);
        if($categories_manager->deleteCategory($id) > 0) {
            $message = "category deleted successfully.";
        } else {
            $err = "There's an error when trying to delete this category";
        }
    }

    if(isset($_POST["edit_category"])) {
        $edit_id = $categories_manager->cleanData($_POST["c_id"]);
        $edited_cat_name = $categories_manager->cleanData($_POST["e_cat_name"]);
        $edited_cat_desc = $categories_manager->cleanData($_POST["e_cat_desc"]);
        $edited_cat_active = $categories_manager->cleanData($_POST["active-inactive"]);
        $edited_picture = $_FILES["e_cat_picture"]["name"];
        $old_image = $categories_manager->cleanData($_POST["c_old_picture"]);
        
        if(!$categories_manager->idExists($edit_id)) {
            $c_err = "Invalid Id.";
        }else if(!isset($edited_cat_name) || empty($edited_cat_name)) {
            $error["catnameErr"] = "A category name is required.";
        }else if(!isset($edited_cat_desc) || empty($edited_cat_desc)) {
            $error["descErr"] = "Description is required.";
        }else if(!isset($_FILES['e_cat_picture']) || $_FILES['e_cat_picture']['error'] == UPLOAD_ERR_NO_FILE) {
            $error["pictureErr"] = "picture is required.";
        }else if(!isset($_POST["active-inactive"])) {
            $error["activeErr"] = "Select status of category";
        } else {

            // Check, if admin select active we insert 1 into database, otherwise 0
            if($edited_cat_active == "active") {
                $edited_cat_active = 1;
            } else
                $edited_cat_active = 0;

            /* picture check */
            $name = $_FILES["e_cat_picture"]["name"];
            $target_dir = "../../assets/images/Categories/";
            $target_file = $target_dir . basename($_FILES["e_cat_picture"]["name"]);
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

            $categories_manager->deleteCatImage($edit_id, $old_image);

            // Check file size
            if ($_FILES["e_cat_picture"]["size"] > 500000) {
                $error["pictureErr"] = "Sorry, your file is too large.";
                $uploadOk = 0;
                // i know it's a dirty solution but it works maaan what the hell is wrong with ya hh
                goto END;
            }

            // Allow certain file formats
            if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                && $imageFileType != "gif" ) {
                $error["pictureErr"] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                $uploadOk = 0;
                goto END;
            }

            // Check if $uploadOk is set to 0 by an error
            if ($uploadOk == 0) {
                $error["pictureErr"] = "Sorry, your file was not uploaded.";
            // if everything is ok, try to upload file
            } else {
                //echo $edit_id . ", name: " . $edited_cat_name . ", desc: " . $edited_cat_desc . ", picture: " . $_FILES["e_cat_picture"]["name"] . ", status" . $edited_cat_active;
                $categories_manager->deleteCatImage($edit_id, $old_image);

                if(move_uploaded_file($_FILES["e_cat_picture"]["tmp_name"], $target_file)) {
                    $categories_manager->editCategory($edit_id, $edited_cat_name, $edited_cat_desc, $_FILES["e_cat_picture"]["name"], $edited_cat_active);
                    $cat_edited = "Category edited successfully";
                } else {
                    $error["pictureErr"] = "Sorry, there was an error uploading your file. (maybe the file name is already exist)";
                }
            }
        }
        END:
    }

    if(isset($_POST["edit_cat"])) {
        $edit_id = $categories_manager->cleanData($_POST["editedId"]);
        $edited_cat_name = $categories_manager->cleanData($_POST["editedName"]);
        $edited_cat_desc = $categories_manager->cleanData($_POST["editedDesc"]);
        $edited_cat_active = $categories_manager->cleanData($_POST["editedActive"]);
        $edited_picture = $categories_manager->cleanData($_POST["editedPicture"]);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Cache-control" content="no-cache">
    <title>Add Category</title>
    <link rel="stylesheet" href="../../css/header.css">
    <link rel="stylesheet" href="../../css/admin-pannel.css">
    <link rel="stylesheet" href="../../css/main-layout.css">
    <link rel="stylesheet" href="../../css/form-entities.css">
    <link rel="stylesheet" href="../../css/table-style.css">
    <link rel="stylesheet" href="../../css/categories.css">

    <style>
        td {
            padding: 2px 5px;
            text-align: center;
        }
        table input {
            margin: 0 auto;
        }
    </style>

    <script type="text/javascript" defer>
        /* 
            Here we try to get the old image of the category to set it as new image if the admin wants to use the older one as category image
        */
        function setOld() {
            // Get image name from hidden input that hold the old category image's name
            let oldImageName = $("#c_old_picture").val();
            let oldImageLabel = $("#old-image-label");
            oldImageLabel.text(oldImageLabel.text() + oldImageName);
            oldImageLabel.css("display", "block");
            
        }
    </script>

    <link rel="icon" href="../../assets/icons/favicon.ico">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="../../js/admin-pannel-dynamics.js" defer></script>
</head>
<body>
    <?php include "../../entities/header.php" ?>
    <main>
        <div class="admin-global-layout">
            <?php include "../../entities/left-pannel.php" ?>

            <div class="admin-main-layout">
                <div>
                    <div style="padding: 12px; width: 100%">
                        <h2 class="main-layout-title">Manage Categories</h2>
                        <p>Available categories : </p>
                        <div style="display: flex">
                            <div  style="margin-bottom: 6px; margin-left: 2px; color: rgb(19, 184, 55);"><?php echo $message; ?></div>
                        </div>
                        <div style="display: flex">
                            <div  style="margin-bottom: 6px; margin-left: 2px; color: rgb(218, 47, 47);"><?php echo $err ?></div>
                        </div>
                        <table style="width: 90%">
                            <tr>
                                <th>ID</th>
                                <th>Picture</th>
                                <th>Category name</th>
                                <th>Description</th>
                                <th>Status</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                            <?php
                                $category_manager = new CategoryManager();
                                $category_manager->getCategoriesAsTableRows();
                            ?>
                        </table>
                    </div>
                    <div style="padding: 12px; width: 100%">
                        <h2 class="main-layout-title">Edit Category section</h2>
                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" enctype="multipart/form-data" style="display: flex;">
                            <div style="margin-right: 22px">
                                <div style="display: flex">
                                    <div style="margin-bottom: 6px; margin-left: 2px; color: rgb(19, 184, 55);"><?php echo $cat_edited ?></div>
                                </div>
                                <div style="display: flex">
                                    <div style="margin-bottom: 6px; margin-left: 2px; color: rgb(218, 47, 47);"><?php echo $c_err; ?></div>
                                </div>
                                <div style="display: flex">
                                    <label style="font-weight: bold; margin-left: 3px;" for="e_cat_id">Category ID</label>
                                </div>
                                <input type="text" name="e_cat_id" id="e_cat_id" class="styled-form-input" value="<?php echo $edit_id ?>" disabled>
                                <input type="hidden" name="c_id" value="<?php echo $edit_id; ?>">
                                <input type="hidden" name="c_old_picture" id="c_old_picture" value="<?php echo $edited_picture; ?>">
                                <div style="display: flex">
                                    <label style="font-weight: bold; margin-left: 3px;" for="e_cat_name">Category name</label>
                                    <div class="invalid-credential"><?php echo $error["catnameErr"]; ?></div>
                                </div>
                                <input type="text" name="e_cat_name" id="e_cat_name" class="styled-form-input" value="<?php echo $edited_cat_name ?>">
                            </div>

                            <div>
                                <div style="display: flex">
                                    <label style="font-weight: bold; margin-left: 3px;" for="e_cat_desc">Description</label>
                                    <div class="invalid-credential"><?php echo $error["descErr"]; ?></div>
                                </div>
                                <textarea type="text" name="e_cat_desc" id="e_cat_desc" class="styled-form-input"><?php echo $edited_cat_desc ?></textarea>

                                <div style="display: flex">
                                    <label style="font-weight: bold; margin-left: 3px; margin-bottom: 8px" for="e_cat_picture">Category picture</label>
                                    <div class="invalid-credential"><?php echo $error["pictureErr"]; ?></div>
                                    <a href="#" id="select-old-image" onclick="setOld(); return false;">-> select the old one</a>
                                </div>
                                <label for="" style="display: none" id="old-image-label">Brows this image name: </label>
                                <input type='file' name='e_cat_picture' id="e_cat_picture">

                                <div style="display: flex">
                                    <label style="font-weight: bold; margin-left: 3px; margin-top: 10px">Category status</label>
                                    <div class="invalid-credential"><?php $error["activeErr"]; ?></div>
                                </div>
                                <div class="active-inactive-container">
                                    <label for="active">Active</label>
                                    <input type="radio" name="active-inactive" value="active" id="active" <?php if($edited_cat_active == 1) {echo "checked";} ?>>
                                    <label for="inactive">InActive</label>
                                    <input type="radio" name="active-inactive" value="inactive" id="inactive" <?php if($edited_cat_active == 0) {echo "checked";} ?>>
                                </div>

                                <input type="submit" name="edit_category" class="styled-button" value="Edit category">
                            </div>
                            <div>
                                <div style="display: flex">
                                    <label style="font-weight: bold; margin-left: 12px; margin-bottom: 14px;" for="e_cat_picture">Old picture</label>
                                    <div class="invalid-credential"><?php  ?></div>
                                </div>
                                <img src="<?php if(isset($edited_picture)) {echo "https://localhost/E-COMMERCE/Admin/assets/Images/Categories/" . $edited_picture; } ?>" alt="" style="height: 120px; margin-left: 26px;">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script>
        $("#manage-category").addClass("selected-option");
        $("#category-related-items").css("display", "flex");
        $("#manage-category").on("click", function() {
            return false;
        })
    </script>
</body>
</html>