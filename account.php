
<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    if(!isset($_SESSION["user_id"])) {
        header("location: login-entities/login.php");
    }

    if(isset($_POST["disconnect"])) {
        echo $_SESSION["user_id"];

        session_unset();
        session_destroy();

        header("location: index.php");
    }



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Cache-control" content="no-cache">
    <title>Your Cart</title>
    
    <link rel="icon" href="images/favicon.ico">
    
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/global-styles.css">
    <link rel="stylesheet" href="css/product-style.css">
    <link rel="stylesheet" href="css/shop.css">
    <link rel="stylesheet" href="css/cart.css">
    <link rel="stylesheet" href="css/account.css">
    <link rel="stylesheet" href="css/footer.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js" defer></script>
    <script src="javascript/cookie.js" defer></script>
    <script src="javascript/header.js" defer></script>
    <script src="javascript/product.js" defer></script>
    <script src="javascript/account.js" defer></script>
    
</head>
<body>
    <?php include "entities/header.php"; ?>
    
    <main>
        <div style="margin: 12px">
            <div>
                <p class="title">GENERAL ACCOUNT SETTINGS</p>
            </div>
            <div style="display: flex; font-size: 15px">
                <div class="settings">
                    <div class="setting-item"> <!-- Setting item -->
                        <div class="setting-credential-container">
                            <a href="#" class="setting-name">Full Name</a>
                            <div class="four-pixels-margin-separator"></div>
                            <a href="#" class="setting-current-data">Mouad Nassri</a>
                            <a href="" class="edit-setting-data">Edit</a>
                        </div>
                        <div class="setting-section">
                            <p class="data-style">Old: <span>Mouad</span> <span>Nassri</span></p>
                            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                                <label for="firstname" class="label">Firstname <span class="mandatory">*</span></label>    
                                <input type="text" name="firstname" id="firstname" class="user-input" placeholder="Firstname">
                                <label for="lastname" class="label">Lastname <span class="mandatory">*</span></label>    
                                <input type="text" name="lastname" id="lastname" class="user-input" placeholder="Lastname">
                                <div id="buttons-container">
                                    <input type="submit" name="save-name" class="setting-button" value="Save">
                                    <a href="#" class="setting-button cancel-button">cancel</a>
                                </div>
                            </form>
                        </div>
                    </div> <!-- END setting item -->
                    <div class="setting-items-separator"></div>
                    <div class="setting-item">
                        <div class="setting-credential-container">
                            <a href="#" class="setting-name">Username</a>
                            <div class="four-pixels-margin-separator"></div>
                            <a href="#" class="setting-current-data">Hostname47</a>
                            <a href="" class="edit-setting-data">Edit</a>
                        </div>
                        <div class="setting-section">
                            <p>This is username section data</p>
                            <p>This is username section data</p>
                        </div>
                    </div>
                    <div class="setting-items-separator"></div>
                    <div class="setting-item">
                        <div class="setting-credential-container">
                            <a href="#" class="setting-name">Add email</a>
                            <div class="four-pixels-margin-separator"></div>
                            <a href="#" class="setting-current-data">Used: <span>mouadstev1@gmail.com</span></a>
                            <a href="" class="edit-setting-data">Edit</a>
                        </div>
                        <div class="setting-section">
                            <p>This is username section data</p>
                            <p>This is username section data</p>
                        </div>
                    </div>
                    <div class="setting-items-separator"></div>
                    <div class="setting-item">
                        <div class="setting-credential-container">
                            <a href="#" class="setting-name">Add email</a>
                            <div class="four-pixels-margin-separator"></div>
                            <a href="#" class="setting-current-data">Used: <span>mouadstev1@gmail.com</span></a>
                            <a href="" class="edit-setting-data">Edit</a>
                        </div>
                        <div class="setting-section">
                            <p>This is username section data</p>
                            <p>This is username section data</p>
                        </div>
                    </div>
                </div>

                <div>
                    <!-- image section -->
                    <img src="" alt="">
                </div>
            </div>
        </div>
    <?php include "entities/footer.php" ?>
</body>
</html>
