
<?php
    // Usually the session i start in header.php so we need to check it out
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    // if the user is not logged in (because the session user id variable is only set when the user login) we take it to login page
    if(!isset($_SESSION["user_id"])) {
        header("location: login-entities/login.php");
    }

    $userid = $_SESSION["user_id"];
    $username = $_SESSION["username"];
    
    // Use curl to send get request to the api and get the full name by providing the  url with uid query string
    // To get the user info for that id and use it to fill OLD First and last names
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, "http://localhost/E-COMMERCE/api/account/readById.php?uid=$userid");
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

    $result = json_decode(curl_exec($curl));
    curl_close($curl);
    $firstname = trim($result->data[0]->first_name);
    $lastname = trim($result->data[0]->last_name);
    $fullname = $firstname . " " . $lastname;

    if($fullname == " ") {
        $fullname = htmlspecialchars("<empty>");
    }
    
    // IF The user click disconnect we unset all session data and destroy the session and finally
    // redirect the user to the index page
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
                            <p href="#" class="setting-name">Full Name</p>
                            <div class="four-pixels-margin-separator"></div>
                            <p href="#" class="setting-current-data"><?php echo $fullname; ?></p>
                            <a href="" class="edit-setting-data">Edit</a>
                        </div>
                        <div class="setting-section">
                            <p class="data-style">Old: <span><?php echo $fullname; ?></span></p>
                            <form action="http://localhost/E-COMMERCE/api/account/EditFullName.php" method="POST">
                                <input type="hidden" name="userid" id="userid" value="<?php echo $userid ?>">
                                <label for="firstname" class="label">Firstname <span class="mandatory">*</span></label>    
                                <input type="text" name="firstname" id="firstname" class="user-input" placeholder="Firstname" value="<?php echo $firstname; ?>">
                                <label for="lastname" class="label">Lastname <span class="mandatory">*</span></label>    
                                <input type="text" name="lastname" id="lastname" class="user-input" placeholder="Lastname" value="<?php echo $lastname; ?>">
                                <div id="buttons-container">
                                    <input type="submit" name="save-name" class="setting-button" id="sv-account" value="Save">
                                    <a href="" class="setting-button cancel-button">cancel</a>
                                    <p id="account-save-message"></p>
                                </div>
                            </form>
                        </div>
                    </div> <!-- END setting item -->
                    <div class="setting-items-separator"></div>
                    <div class="setting-item">
                        <div class="setting-credential-container">
                            <p href="#" class="setting-name">Username</p>
                            <div class="four-pixels-margin-separator"></div>
                            <p href="#" class="setting-current-data">Hostname47</p>
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
                            <p href="#" class="setting-name">Add email</p>
                            <div class="four-pixels-margin-separator"></div>
                            <p class="setting-current-data">Used: <span>mouadstev1@gmail.com</span></p>
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
                            <p href="#" class="setting-name">Add email</p>
                            <div class="four-pixels-margin-separator"></div>
                            <p href="#" class="setting-current-data">Used: <span>mouadstev1@gmail.com</span></p>
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
