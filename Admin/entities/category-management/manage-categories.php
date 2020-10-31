
<?php
    
   include "CategoryManager.php";

   $message = $err = "";

    if(isset($_POST["delete_cat"])) {
        // This is the id of item that you want to delete
        $categories_manager = new CategoryManager();
        $id = $categories_manager->cleanData($_POST["deletedId"]);
        if($categories_manager->deleteCategory($id) > 0) {
            $message = "category deleted successfully.";
        } else {
            $err = "There's an error when trying to delete this category";
        }
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
                <div style="padding: 12px; width: 100%">
                    <h2 class="main-layout-title">Manage Categories</h2>
                    <p>Available categories : </p>
                    <div style="display: flex">
                        <div  style="margin-bottom: 6px; margin-left: 2px; color: rgb(19, 184, 55);"><?php echo $message; ?></div>
                    </div>
                    <div style="display: flex">
                        <div  style="margin-bottom: 6px; margin-left: 2px; color: rgb(218, 47, 47);"><?php echo $err ?></div>
                    </div>
                    <table style="width: 100%">
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