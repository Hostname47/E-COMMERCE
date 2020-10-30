
<?php
    
    include "CategoryManager.php";

    $error = ["catnameErr"=>"", "descErr"=>"", "pictureErr"=>"", "activeErr"=>""];
    $submitted_cat_name = $submitted_desc = $submitted_picture = $submitted_active = $err = $cat_created = "";
    $image_src = "";

    /* code for inserting validated category data*/
    if(isset($_POST["add-category"])) {
        $category_manager = new CategoryManager();

        $submitted_cat_name = $_POST["cat-name"];
        $submitted_desc = $_POST["desc"];
        $submitted_picture = $_FILES["cat_picture"]["name"];

        // Cleaning data
        $submitted_cat_name = $category_manager->cleanData($submitted_cat_name);
        $submitted_desc = $category_manager->cleanData($submitted_desc);
        $submitted_picture = $category_manager->cleanData($submitted_picture);

        if(!isset($_POST["cat-name"]) || empty($_POST["cat-name"])) {
            $error["catnameErr"] = "A category name is required.";
        }else if($category_manager->checkCategoryExists($submitted_cat_name)) {
            $error["catnameErr"] = "This category name is already exists.";
        }else if(!isset($_POST["desc"]) || empty($_POST["desc"])) {
            $error["descErr"] = "Description is required.";
        }else if(!isset($_FILES['cat_picture']) || $_FILES['cat_picture']['error'] == UPLOAD_ERR_NO_FILE) {
            $error["pictureErr"] = "picture is required.";
        }else if(!isset($_POST["active-inactive"])) {
            $error["activeErr"] = "Select status of category";
        } else {

            $submitted_active = $_POST["active-inactive"];
            $submitted_active = $category_manager->cleanData($submitted_active);
            // Check, if admin select active we insert 1 into database, otherwise 0
            if($submitted_active == "active") {
                $submitted_active = 1;
            } else
                $submitted_active = 0;

            /* picture check */
            $name = $_FILES["cat_picture"]["name"];
            $target_dir = "../../assets/images/Categories/";
            $target_file = $target_dir . basename($_FILES["cat_picture"]["name"]);
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
            
            // Check if image file is a actual image or fake image
            $check = getimagesize($_FILES["cat_picture"]["tmp_name"]);
            if($check !== false) {
                //echo "File is an image - " . $check["mime"] . ".";
                $uploadOk = 1;
            } else {
                $err = "File is not an image.";
                $uploadOk = 0;
            }

            if (file_exists($target_file)) {
                $err = "Sorry, file already exists.";
                $uploadOk = 0;
            }

            // Check file size
            if ($_FILES["cat_picture"]["size"] > 500000) {
                $err = "Sorry, your file is too large.";
                $uploadOk = 0;
            }

            // Allow certain file formats
            if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                && $imageFileType != "gif" ) {
                $err = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                $uploadOk = 0;
            }

            // Check if $uploadOk is set to 0 by an error
            if ($uploadOk == 0) {
                echo "Sorry, your file was not uploaded.";
            // if everything is ok, try to upload file
            } else {
                if (move_uploaded_file($_FILES["cat_picture"]["tmp_name"], $target_file)) {
                    $category_manager->insertCategory($submitted_cat_name, $submitted_desc, $name, $submitted_active);
                    $image_src = $target_dir . $target_file;
                    $cat_created = "Category created successfully";
                } else {
                    $err = "Sorry, there was an error uploading your file.";
                }
            }
        }
    }

    /* code for show */
    if(isset($_POST["retrieve"])) {
        $category_manager = new CategoryManager();
        $image_src = $category_manager->categoryPicturesLocation . "4-512.png";
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
    <link rel="stylesheet" href="../../css/categories.css">

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
                <div id="add-cat-container">
                    <h2 class="main-layout-title">Add Category</h2>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" enctype="multipart/form-data">
                        <div style="display: flex">
                            <div  style="margin-bottom: 6px; margin-left: 2px; color: rgb(19, 184, 55);"><?php echo $cat_created; ?></div>
                        </div>
                        <div style="display: flex">
                            <div  style="margin-bottom: 6px; margin-left: 2px; color: rgb(218, 47, 47);"><?php echo $err ?></div>
                        </div>
                        <div style="display: flex">
                            <label style="font-weight: bold; margin-left: 3px;" for="cat-name">Category name</label>
                            <div class="invalid-credential"><?php echo $error["catnameErr"]; ?></div>
                        </div>
                        <input type="text" name="cat-name" id="cat-name" class="styled-form-input" value="<?php echo $submitted_cat_name; ?>">

                        <div style="display: flex">
                            <label style="font-weight: bold; margin-left: 3px;" for="desc">Description</label>
                            <div class="invalid-credential"><?php echo $error["descErr"]; ?></div>
                        </div>
                        <textarea type="text" name="desc" id="desc" class="styled-form-input"><?php echo $submitted_desc ?></textarea>

                        <div style="display: flex">
                            <label style="font-weight: bold; margin-left: 3px;" for="cat_picture">Category picture</label>
                            <div class="invalid-credential"><?php echo $error["pictureErr"]; ?></div>
                        </div>
                        <input type='file' name='cat_picture' id="cat_picture">

                        <div style="display: flex">
                            <label style="font-weight: bold; margin-left: 3px;">Category status</label>
                            <div class="invalid-credential"><?php echo $error["activeErr"]; ?></div>
                        </div>
                        <div class="active-inactive-container">
                            <label for="active">Active</label>
                            <input type="radio" name="active-inactive" value="active" id="active">
                            <label for="inactive">InActive</label>
                            <input type="radio" name="active-inactive" value="inactive" id="inactive">
                        </div>

                        <input type="submit" name="add-category" class="styled-button" value="Add category">
                    </form>
                </div>

                <div id="available-categories-container">
                    <p>Available categories : </p>
                    <div class="cats-container">
                        <?php
                            $category_manager = new CategoryManager();
                            $category_manager->getCategoriesAsComponents();
                        ?>
                    </div>
                </div>
                
            </div>
        </div>
    </main>
    <script>
        $("#add-category").addClass("selected-option");
        $("#category-related-items").css("display", "flex");
        $("#add-category").on("click", function() {
            return false;
        })
    </script>
</body>
</html>